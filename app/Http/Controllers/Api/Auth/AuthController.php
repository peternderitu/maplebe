<?php

namespace App\Http\Controllers\Api\Auth;

use App\Notifications\PasswordResetEmail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Mail\UserPasswordResetEmail;
use Illuminate\Support\Facades\DB;
use Resend\Laravel\Facades\Resend;
use App\Mail\VerifyStudentEmail;
use Illuminate\Validation\Rule;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ZAccessToken;
use App\Models\User;


class AuthController extends Controller
{

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'message' => 'Credentials do not match'
            ]);
        }

        $user = User::where('email', $request-> email)->first();
        return response()->json([
            'message' => 'User logged in', 
            'user' => $user,
            'token' => $user->createToken('API Token', ['role:user'])->plainTextToken
        ]);
    }

    public function register(Request $request) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        $user = User::create([
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
            'first_name' =>$request->first_name,
            'last_name' =>$request->last_name,
        ]);
        return response()->json([
            'message' => 'Created user',
            'user' => $user,
            'token' => $user->createToken('API Token',['role:user'])->plainTextToken
        ]) ;
    }

    public function storeStudentEmail(Request $request, $id) {
        try {
            // todo: check if user exists
            $user = User::where('id', $id)->first();

            $request->validate([
                'studentEmail' => ['required','email', Rule::unique('users')->ignore($user->id),],
            ]);            

            // get a random value
            $otpValue = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            cache(['user'.$user->id => $otpValue], 36000);
            $value = cache('user'.$user->id);
            
            // send an email to that student email
            // Mail::to($request->studentEmail)->send(new VerifyStudentEmail($otpValue, $user->id));
            Resend::emails()->send([
                'from' => 'WhizDeals <info@whizdeals.ca>',
                'to' => [$request->studentEmail],
                'subject' => 'Verify Student Email',
                'html' => (new VerifyStudentEmail($otpValue, $user->id))->render(),
            ]);
            
            $user->studentEmail = $request->studentEmail;
            $user->save();
            return response()->json([
                'message' => 'Added student email to user',
                'user' => $user
            ]);            
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not store student email',
            ]);
        }
    }
    
    public function verifyStudentEmail(Request $request) {
        // I need 2 things here
        // 1. id
        // 2. otp code
        try {
            $user = User::where('id', $request->id)->first();
            $value = cache('user'.$user->id);
            
            if($value === $request->otpCode){
                $user->studentEmailVerified = true;
                $user->save();
                return response()->json([
                    'message' => 'Verified student email',
                    'data' => $user
                ]);
            } else {
                return response()->json([
                    'message' => 'Could not verify student email',
                ]);
            }
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'OTP code expired or wrong OTP code'
            ]);
        }
    }

    public function resendOTPCode(Request $request) {
        $user = User::where('id', $request->id)->first();
        $otpValue = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        cache(['user'.$user->id => $otpValue], 36000);
        $value = cache('user'.$user->id);

        Mail::to($user->studentEmail)->send(new VerifyStudentEmail($otpValue, $user->id));
        return response()->json([
            'message' => 'Resent otp code',
            'data' => $user
        ]);
    }

    public function logout() {
        return 'This is my logout method';
    }

    public function sendPasswordResetLinkEmail(Request $request) {
        try {
            if ($request->has('email')) {
                if ($user = User::where('email', $request->email)->first()) {
                    $token = Str::random(60);
                    DB::table('password_resets')->insert([
                        'email' => $user->email,
                        'token' => $token,
                        'created_at' => now(),
                    ]);
                    // $user->notify(new PasswordResetEmail($token));
                    Resend::emails()->send([
                        'from' => 'info@whizdeals.ca',
                        'to' => [$user->email],
                        'subject' => 'Reset Password',
                        'html' => (new UserPasswordResetEmail($token))->render(),
                    ]);

                    return response()->json([
                        'message' => "Please check your email address to reset your password",
                    ], 200);
                } else {
                    return response()->json([
                        'message' => "Account does not exist",
                    ], 404);
                }
            } else {
                return response()->json([
                    'message' => "Please provide an email address",
                ], 404);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => "Could not send reset link",
                'error_message' => $exception->getMessage()
            ], 500);
        }
    }

    private function cleanupExpiredTokens() {
        // Delete records older than a specific time
        DB::table('password_resets')->where('created_at', '<', now()->subHours(1))->delete();
    }

    public function resetPassword(Request $request) {
        try {
            $request->validate([
                'password' => 'required',
                'token' => 'required'
            ],
            [
                'password.required' => 'Please provide password',
            ]); 
            $this->cleanupExpiredTokens();
            $email = PasswordReset::where('token', $request->token)->first();
            $user = User::where('email', $email->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            DB::table('password_resets')->where('token', $request->token)->delete();
            return response()->json([
                'message' => "Password changed successfully!",
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => "Could not reset pasword",
                'error_message' => $exception->getMessage()
            ], 500);
        }
    }

    public function update (Request $request, $id) {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
            ]);

            $user = User::where('id', $id)->first();
            // if($request->hasFile('profile_picture')) {
            //     if($user->profile_picture) {
            //         $fileName = 'storage/microblogs/'.$user->image_url;
            //         unlink(realpath($fileName));
            //     }
            //     $file = $request->file('profile_picture');
            //     $extension = $file->extension();
            //     $name = 'Micro_blog_'.time().'.'.$extension;

            //     $destination = './storage/microblogs';
            //     $file->move($destination, $name);
            //     $microblog->image_url = $name;
            // }

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;            
            $user->save();

            return response()->json([
                'message' => 'Updated user details successfully',
                'data' => $user
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not update user details',
                'error' => $exception->message
            ], 404);
        }

    }

    public function verifyInboundEmail ($id) {
        // first we need to find a user with the above user id - done
        // then we need to fetch all the emails from zoho 
        // then we filter to see if there is a blank email coming from the student email in the db.
        // if we find, we verify student and we send a response of student verified
        // if we don't find we send a response of email not yet found
        
        try {
            $student = User::where('id', $id)->first();
            $zAccessToken = ZAccessToken::where('id', 1)->first(); 
            if($student) {
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Zoho-oauthtoken '.$zAccessToken->access_token
                ])
                ->get('https://mail.zoho.com/api/accounts/8950314000000008002/messages/search?searchKey=newMails&start=1&limit=10&includeto=true');
                // the response is an array of emails
                $res = json_decode($response, true);
                $filteredArray = array_filter($res['data'], function ($item) use ($student) {
                    // \Log::info($student->studentEmail);
                    return $item['fromAddress'] === $student->studentEmail;
                });
                // dd($filteredArray);
                if(empty($filteredArray)) {
                    return response()->json([
                        'message' => 'Email not found',
                    ]);
                } else {
                    $student->studentEmailVerified = 1;
                    $student->save();
                    return response()->json([
                        'message' => 'Student verified',
                        'student' => $student
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'Could not find student with this id',
                    'error' => $exception->message
                ], 404);
            }
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $exception->message
            ], 404);
        }
    }

    public function getStudentEmailById ($id) {
        $student = User::where('id', $id)->first();
        if($student){
            return response()->json([
                'message' => 'Found student email',
                'student' => $student
            ]);
        } else {
            return response()->json([
                'message' => 'Could not find student email',
            ]);
        }
    }
}

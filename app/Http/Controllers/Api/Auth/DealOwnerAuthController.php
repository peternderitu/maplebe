<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DealOwner;

class DealOwnerAuthController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::guard('deal_owner')->attempt($request->only(['email', 'password']))){
            return response()->json([
                'message' => 'Credentials do not match'
            ]);
        }
        $deal_owner = DealOwner::where('email', $request->email)->first();
        return response()->json([
            'message' => 'Deal owner logged in',
            'deal_owner' => $deal_owner,
            'token' => $deal_owner->createToken('API Token', ['role:deal_owner'])->plainTextToken
        ]);
    }

    public function register(Request $request) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:deal_owners,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        $deal_owner = DealOwner::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'message' => 'Registered new deal owner',
            'deal_owner' => $deal_owner,
            'token' => $deal_owner->createToken('API Token', ['role:deal_owner'])->plainTextToken
        ]);
    }
}

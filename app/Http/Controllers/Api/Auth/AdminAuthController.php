<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function login (Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Auth::guard('admin')->attempt($credentials)
        if(!Auth::guard('admin')->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'message' => 'Credentials do not match'
            ]);
        }

        $admin = Admin::where('email', $request->email)->first();
        return response()->json([
            'message' => 'Admin logged in',
            'admin' => $admin,
            'token' => $admin->createToken('API Token', ['role:admin'])->plainTextToken
        ]);
    }    

    public function register (Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $admin = Admin::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name
        ]);
        return response()->json([
            'admin' => $admin,
            'token' => $admin->createToken('API Token', ['role:admin'])->plainTextToken
        ]);
    }    
}

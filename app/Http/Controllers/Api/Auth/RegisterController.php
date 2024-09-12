<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected function create(request $request)
    {
        $user = new User($request->all);
        $user->password = Hash::make($request->password);
        $user->save();
        
    }

}

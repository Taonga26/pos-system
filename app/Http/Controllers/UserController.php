<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function register(Request $request){
        $incomingFields = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'email' => 'required|email',
            'password' => 'required',
            'role'=> 'required|in:Manager, Cashier, Admin'
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = User::create($incomingFields);
        auth()->guard()->login($user);

        return redirect('/');
        
    }

    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginemail' => 'required|email',
            'loginpassword' => 'required'
        ]);

        if (auth()->guard()->attempt(['email' => $incomingFields['loginemail'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/');
        }
    }

    public function logout(){
        auth()->guard()->logout();
        return redirect('/');
    }
}

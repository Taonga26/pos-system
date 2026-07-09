<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $incomingFields = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        User::create($incomingFields);

        return redirect('admin.index')->with('Success', 'User created successfully');
        
    }

    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginemail' => 'required|email',
            'loginpassword' => 'required'
        ]);

        if (Auth::attempt(['email' => $incomingFields['loginemail'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'loginemail' => 'invalid Credentials',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

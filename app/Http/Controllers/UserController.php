<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::with('employee')->latest()->paginate(10);

        $activeUserIds =DB::table('sessions')
        ->whereNotNull('user_id')
        ->where('last_activity', '>=', now()->subMinutes(5)->timestamp)
        ->pluck('user_id');

        $onlineUsers =User::with('employee')->whereIn('id', $activeUserIds)->get();

        return view('admin.users', compact('users','onlineUsers'));
    }


    public function force_logout(){}


    public function destroy(){

    }
}

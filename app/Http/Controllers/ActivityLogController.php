<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = ActivityLog::with('user.employee');

        if($request->filled('module')){
            $logs->where('module',$request->module);
        }
        if($request->filled('action')){
            $logs->where('action', $request->action);
        }
        if($request->filled('user')){
            $logs->where('user_id', $request->user);
        }

        $logs= $logs->latest()->paginate(20);

        return view('activity-logs.index', compact('logs'));
    }
}

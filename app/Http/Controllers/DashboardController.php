<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Report;
use App\Models\Resource;
use Auth;

class DashboardController extends Controller
{
    public function index() {

        $user = Auth::user()->getRoleNames();
        if(Auth::user()->getRoleNames()[0] == "Reporter"){
            $reports = Report::where('id', '>', 0)
                                ->where('fk_users', Auth::user()->id)
                                ->orderBy('id', 'desc')->limit(10)->get();
            $resources = [];
        }else{
            $reports = Report::where('id', '>', 0)->orderBy('id', 'desc')->limit(10)->get();
            $resources = Resource::where('id', '>', 0)->orderBy('id', 'desc')->limit(6)->get();
        }
        
        $date = Carbon::now();
        return view('layouts.dashboard.dashboard', [
            'date' => $date,
            'reports' => $reports,
            'resources' => $resources
        ]);
    }
}

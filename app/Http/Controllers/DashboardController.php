<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Report;
use App\Models\Resource;

class DashboardController extends Controller
{
    public function index() {

        $reports = Report::where('id', '>', 0)->orderBy('id', 'desc')->limit(10)->get();
        $resources = Resource::where('id', '>', 0)->orderBy('id', 'desc')->limit(6)->get();

        $date = Carbon::now();
        return view('layouts.dashboard.dashboard', [
            'date' => $date,
            'reports' => $reports,
            'resources' => $resources
        ]);
    }
}

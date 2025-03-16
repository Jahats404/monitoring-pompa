<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardAdmin()
    {
        return view('dashboard.dashboard-admin');
    }
}
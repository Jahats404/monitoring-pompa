<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\PemeriksaanChargingPump;
use App\Models\PemeriksaanMainPump;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardTeknisi()
    {
        return view('dashboard.dashboard-admin');
    }
    public function dashboardAdmin()
    {
        return view('dashboard.dashboard-admin');
    }
    
    public function dashboardPertamina()
    {
        return view('dashboard.dashboard-admin');
    }
}
<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use App\Models\PemeriksaanChargingPump;
use App\Models\PemeriksaanMainPump;
use App\Models\Pompa;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardTeknisi()
    {
        $totLokasi = Lokasi::count();
        $totPompa = Pompa::count();
        $totPengguna = User::count();
        
        return view('dashboard.dashboard-admin', compact('totLokasi','totPompa','totPengguna'));
    }
    public function dashboardAdmin()
    {
        $totLokasi = Lokasi::count();
        $totPompa = Pompa::count();
        $totPengguna = User::count();
        
        return view('dashboard.dashboard-admin', compact('totLokasi','totPompa','totPengguna'));
    }
    
    public function dashboardPertamina()
    {
        $totLokasi = Lokasi::count();
        $totPompa = Pompa::count();
        $totPengguna = User::count();
        
        return view('dashboard.dashboard-admin', compact('totLokasi','totPompa','totPengguna'));
    }
}
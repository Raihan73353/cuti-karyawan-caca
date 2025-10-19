<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\CutiRequest;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalKaryawan = User::where('role', 'karyawan')->count();
        $totalCuti = CutiRequest::count();
        $cutiApproved = CutiRequest::where('status', 'approved')->count();
        $cutiRejected = CutiRequest::where('status', 'rejected')->count();
        $latestCuti = CutiRequest::with('user')->latest()->take(5)->get();

        return view('index', compact(
            'totalKaryawan',
            'totalCuti',
            'cutiApproved',
            'cutiRejected',
            'latestCuti'
        ));
    }
}

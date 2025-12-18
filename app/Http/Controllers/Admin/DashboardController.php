<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalEmployees' => 0,
            'totalClients' => 0,
            'totalProducts' => 0,
            'totalSales' => 0,
            'totalRevenue' => 0,
            'pendingDeliveries' => 0,
            'lowStockProducts' => 0,
            'overduePayments' => 0,
        ];
        return view('admin.pages.dashboard', compact('data'));
    }
}

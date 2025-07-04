<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Staff;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'serviceCount' => Service::count(),
            'customerCount' => Customer::count(),
            'staffCount'   => Staff::count(),
            'bookingCount' => Booking::count(),
        ]);
    }
}
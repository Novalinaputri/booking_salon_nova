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
        'serviceCount' => \App\Models\Service::count(),
        'customerCount' => \App\Models\Customer::count(),
        'staffCount'   => \App\Models\Staff::count(),
        'bookingCount' => \App\Models\Booking::count(),
        'recentServices' => \App\Models\Service::orderByDesc('id')->limit(5)->get(),
        'recentCustomers' => \App\Models\Customer::orderByDesc('id')->limit(5)->get(),
        'recentStaffs' => \App\Models\Staff::orderByDesc('id')->limit(5)->get(),
        'recentBookings' => \App\Models\Booking::with(['customer','service','staff'])->orderByDesc('id')->limit(5)->get(),
    ]);
}
}
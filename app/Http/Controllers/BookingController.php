<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['customer', 'service', 'staff'])->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
{
    $customers = Customer::all();
    $services = Service::all();
    $staffs = Staff::all();
    return view('admin.bookings.create', compact('customers', 'services', 'staffs'));
}

public function edit(Booking $booking)
{
    $customers = Customer::all();
    $services = Service::all();
    $staffs = Staff::all();
    return view('admin.bookings.edit', compact('booking', 'customers', 'services', 'staffs'));
}

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:nova_customers,id',
            'service_id' => 'required|exists:nova_services,id',
            'staff_id' => 'nullable|exists:nova_staffs,id',
            'booking_time' => 'required|date',
            'status' => 'required'
        ]);
        Booking::create($request->all());
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil ditambahkan!');
    }


    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'customer_id' => 'required|exists:nova_customers,id',
            'service_id' => 'required|exists:nova_services,id',
            'staff_id' => 'nullable|exists:nova_staffs,id',
            'booking_time' => 'required|date',
            'status' => 'required'
        ]);
        $booking->update($request->all());
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil diupdate!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus!');
    }
}
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
        // Cek apakah request dari admin (pakai customer_id) atau user (pakai data pelanggan baru)
        if ($request->has('customer_id')) {
            // Validasi untuk admin
            $request->validate([
                'customer_id' => 'required|exists:nova_customers,id',
                'service_id' => 'required|exists:nova_services,id',
                'staff_id' => 'nullable|exists:nova_staffs,id',
                'booking_time' => 'required|date',
                'status' => 'required'
            ]);

            Booking::create([
                'customer_id' => $request->customer_id,
                'service_id' => $request->service_id,
                'staff_id' => $request->staff_id,
                'booking_time' => $request->booking_time,
                'status' => $request->status
            ]);

            return redirect()->route('bookings.index')->with('success', 'Booking berhasil ditambahkan!');
        } else {
            // Validasi untuk user
            $request->validate([
                'service_id' => 'required|exists:nova_services,id',
                'staff_id' => 'nullable|exists:nova_staffs,id',
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|email|max:255',
                'customer_phone' => 'required|string|max:20',
                'booking_date' => 'required|date|after_or_equal:today',
                'booking_time' => 'required',
                'status' => 'nullable'
            ]);

            // Create or find customer
            $customer = Customer::firstOrCreate(
                ['email' => $request->customer_email],
                [
                    'name' => $request->customer_name,
                    'phone' => $request->customer_phone
                ]
            );

            // Combine date and time
            $bookingDateTime = $request->booking_date . ' ' . $request->booking_time;

            Booking::create([
                'customer_id' => $customer->id,
                'service_id' => $request->service_id,
                'staff_id' => $request->staff_id,
                'booking_time' => $bookingDateTime,
                'status' => 'pending'
            ]);

            session(['user_email' => $request->customer_email]);

            return redirect()->route('user.bookings.history', ['email' => $request->customer_email])
                ->with('success', 'Booking berhasil dibuat! Kami akan menghubungi Anda segera.');
        }
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
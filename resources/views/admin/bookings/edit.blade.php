@extends('layouts.admin')

@section('content')
<h2 class="text-center text-3xl font-semibold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-pink-400 to-pink-600 mb-5 tracking-normal drop-shadow-sm">
    Edit Booking
</h2>

<form method="POST" action="{{ route('bookings.update', $booking) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label text-pink-700">Pelanggan</label>
        <select name="customer_id" class="form-control border-pink-300" required>
            <option value="">Pilih Pelanggan</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" {{ (old('customer_id', $booking->customer_id ?? '') == $customer->id) ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label text-pink-700">Layanan</label>
        <select name="service_id" class="form-control border-pink-300" required>
            <option value="">Pilih Layanan</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}" {{ (old('service_id', $booking->service_id ?? '') == $service->id) ? 'selected' : '' }}>
                    {{ $service->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label text-pink-700">Staff</label>
        <select name="staff_id" class="form-control border-pink-300">
            <option value="">Pilih Staff</option>
            @foreach($staffs as $staff)
                <option value="{{ $staff->id }}" {{ (old('staff_id', $booking->staff_id ?? '') == $staff->id) ? 'selected' : '' }}>
                    {{ $staff->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label text-pink-700">Waktu Booking</label>
        <input type="datetime-local" name="booking_time" class="form-control border-pink-300" value="{{ old('booking_time', isset($booking) ? date('Y-m-d\TH:i', strtotime($booking->booking_time)) : '') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label text-pink-700">Status</label>
        <select name="status" class="form-control border-pink-300" required>
            <option value="pending" {{ (old('status', $booking->status ?? '') == 'pending') ? 'selected' : '' }}>Pending</option>
            <option value="confirmed" {{ (old('status', $booking->status ?? '') == 'confirmed') ? 'selected' : '' }}>Confirmed</option>
            <option value="done" {{ (old('status', $booking->status ?? '') == 'done') ? 'selected' : '' }}>Done</option>
        </select>
    </div>

    <button type="submit" class="btn w-100 text-white" style="background-color: #ec4899;">Simpan Perubahan</button>
    <a href="{{ route('bookings.index') }}" class="btn btn-secondary w-100 mt-2">Kembali</a>
</form>
@endsection

@extends('layouts.admin')

@section('content')
<h2 class="text-center text-3xl font-semibold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-pink-400 to-pink-600 mb-5 drop-shadow">
    Tambah Booking 
</h2>

<form method="POST" action="{{ route('bookings.store') }}" class="bg-white rounded-xl p-4 shadow-md">
    @csrf

    <div class="mb-3">
        <label class="form-label text-pink-700">Pelanggan</label>
        <select name="customer_id" class="form-control border-pink-300 shadow-sm" required>
            <option value="">Pilih Pelanggan</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label text-pink-700">Layanan</label>
        <select name="service_id" class="form-control border-pink-300 shadow-sm" required>
            <option value="">Pilih Layanan</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                    {{ $service->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label text-pink-700">Staff</label>
        <select name="staff_id" class="form-control border-pink-300 shadow-sm">
            <option value="">Pilih Staff</option>
            @foreach($staffs as $staff)
                <option value="{{ $staff->id }}" {{ old('staff_id') == $staff->id ? 'selected' : '' }}>
                    {{ $staff->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label text-pink-700">Waktu Booking</label>
        <input type="datetime-local" name="booking_time" class="form-control border-pink-300 shadow-sm" value="{{ old('booking_time') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label text-pink-700">Status</label>
        <select name="status" class="form-control border-pink-300 shadow-sm" required>
            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
        </select>
    </div>

    <button type="submit" class="btn w-100 text-white mt-3 shadow" style="background-color: #ec4899;">
        💅 Simpan Booking
    </button>
    <a href="{{ route('bookings.index') }}" class="btn btn-secondary w-100 mt-2">Kembali</a>
</form>
@endsection

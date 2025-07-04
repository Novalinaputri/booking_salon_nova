@extends('layouts.admin')

@section('content')
<style>
    .salon-title {
        font-family: 'Segoe Script', cursive;
        color: #ad1457;
        letter-spacing: 1px;
        font-size: 2rem;
    }
    .btn-salon {
        background: linear-gradient(90deg, #f06292 0%, #ba68c8 100%);
        border: none;
        color: #fff;
        font-weight: bold;
        border-radius: 25px;
        transition: background 0.3s;
    }
    .btn-salon:hover {
        background: linear-gradient(90deg, #ba68c8 0%, #f06292 100%);
        color: #fff;
    }
    .table-booking {
        background: #fff0f6;
        border-radius: 16px;
        box-shadow: 0 2px 12px 0 rgba(186, 104, 200, 0.10);
        overflow: hidden;
    }
    .table-booking th {
        background: #f8bbd0;
        color: #ad1457;
        font-weight: 600;
        border: none;
    }
    .table-booking td {
        border: none;
    }
    .btn-warning.btn-sm {
        background: #f8bbd0;
        color: #ad1457;
        border: none;
        font-weight: 500;
        border-radius: 8px;
        transition: background 0.2s;
    }
    .btn-warning.btn-sm:hover {
        background: #ba68c8;
        color: #fff;
    }
    .btn-danger.btn-sm {
        background: #f06292;
        color: #fff;
        border: none;
        font-weight: 500;
        border-radius: 8px;
        transition: background 0.2s;
    }
    .btn-danger.btn-sm:hover {
        background: #ad1457;
        color: #fff;
    }
</style>
<h2 class="salon-title mb-4 text-center">Data Booking</h2>
<div class="mb-3 text-end">
    <a href="{{ route('bookings.create') }}" class="btn btn-salon">+ Tambah Booking</a>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="table-responsive">
    <table class="table table-hover align-middle table-booking">
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Layanan</th>
                <th>Staff</th>
                <th>Waktu Booking</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->customer->name ?? '-' }}</td>
                    <td>{{ $booking->service->name ?? '-' }}</td>
                    <td>{{ $booking->staff->name ?? '-' }}</td>
                    <td>{{ $booking->booking_time }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                    <td>
                        <a href="{{ route('bookings.edit', $booking) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus booking ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada booking.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
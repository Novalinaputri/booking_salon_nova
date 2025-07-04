@extends('layouts.admin')

@section('content')
<h2 class="salon-title mb-4 text-center">Hapus Booking</h2>
<div class="alert alert-danger text-center">
    Apakah Anda yakin ingin menghapus booking oleh <b>{{ $booking->customer->name ?? '-' }}</b> untuk layanan <b>{{ $booking->service->name ?? '-' }}</b>?
</div>
<form method="POST" action="{{ route('bookings.destroy', $booking) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger w-100">Ya, Hapus</button>
    <a href="{{ route('bookings.index') }}" class="btn btn-secondary w-100 mt-2">Batal</a>
</form>
@endsection
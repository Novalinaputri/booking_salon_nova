@extends('layouts.admin')

@section('content')
<h2 class="salon-title mb-4 text-center">Hapus Staff</h2>
<div class="alert alert-warning text-center">
    <p>Apakah Anda yakin ingin menghapus staff berikut?</p>
    <ul class="list-unstyled">
        <li><strong>Nama:</strong> {{ $staff->name }}</li>
        <li><strong>Spesialisasi:</strong> {{ $staff->speciality }}</li>
    </ul>
    <form method="POST" action="{{ route('staffs.destroy', $staff) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Hapus</button>
        <a href="{{ route('staffs.index') }}" class="btn btn-secondary ms-2">Batal</a>
    </form>
</div>
@endsection 
@extends('layouts.admin')

@section('content')
<h2 class="salon-title mb-4 text-center">Hapus Pelanggan</h2>
<div class="alert alert-warning text-center">
    <p>Apakah Anda yakin ingin menghapus pelanggan berikut?</p>
    <ul class="list-unstyled">
        <li><strong>Nama:</strong> {{ $customer->name }}</li>
        <li><strong>Email:</strong> {{ $customer->email }}</li>
        <li><strong>Telepon:</strong> {{ $customer->phone }}</li>
    </ul>
    <form method="POST" action="{{ route('customers.destroy', $customer) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Hapus</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary ms-2">Batal</a>
    </form>
</div>
@endsection 
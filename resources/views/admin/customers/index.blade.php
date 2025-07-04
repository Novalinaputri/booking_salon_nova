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
    .table-customers {
        background: #fff0f6;
        border-radius: 16px;
        box-shadow: 0 2px 12px 0 rgba(186, 104, 200, 0.10);
        overflow: hidden;
    }
    .table-customers th {
        background: #f8bbd0;
        color: #ad1457;
        font-weight: 600;
        border: none;
    }
    .table-customers td {
        border: none;
    }
    .btn-warning {
        background: #f8bbd0;
        color: #ad1457;
        border: none;
        font-weight: 500;
        border-radius: 8px;
        transition: background 0.2s;
    }
    .btn-warning:hover {
        background: #ba68c8;
        color: #fff;
    }
    .btn-danger {
        background: #f06292;
        color: #fff;
        border: none;
        font-weight: 500;
        border-radius: 8px;
        transition: background 0.2s;
    }
    .btn-danger:hover {
        background: #ad1457;
        color: #fff;
    }
</style>
<h2 class="salon-title mb-4 text-center">Data Pelanggan</h2>
<div class="mb-3 text-end">
    <a href="{{ route('customers.create') }}" class="btn btn-salon">+ Tambah Pelanggan</a>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-hover align-middle table-customers">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($customers as $customer)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>
                    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus pelanggan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada pelanggan.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
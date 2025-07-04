@extends('layouts.admin')

@section('content')
<h2 class="salon-title mb-4 text-center">Hapus Layanan</h2>
<div class="alert alert-danger text-center">
    Apakah Anda yakin ingin menghapus layanan <b>{{ $service->name }}</b>?
</div>
<form method="POST" action="{{ route('services.destroy', $service) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger w-100">Ya, Hapus</button>
    <a href="{{ route('services.index') }}" class="btn btn-secondary w-100 mt-2">Batal</a>
</form>
@endsection
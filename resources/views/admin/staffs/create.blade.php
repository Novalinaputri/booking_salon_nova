@extends('layouts.admin')

@section('content')
<h2 class="text-center text-3xl font-semibold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-pink-400 to-pink-600 mb-5 drop-shadow">
    Tambah Staff Baru
</h2>

<form method="POST" action="{{ route('staffs.store') }}" class="bg-white rounded-xl shadow-md p-4">
    @csrf

    <div class="mb-3">
        <label class="form-label text-pink-700">Nama</label>
        <input type="text" name="name" class="form-control border-pink-300 shadow-sm" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label text-pink-700">Spesialisasi</label>
        <input type="text" name="speciality" class="form-control border-pink-300 shadow-sm" value="{{ old('speciality') }}" required>
    </div>

    <button type="submit" class="btn w-100 text-white mt-3 shadow" style="background-color: #ec4899;">
        Simpan Staff
    </button>
    <a href="{{ route('staffs.index') }}" class="btn btn-secondary w-100 mt-2">Kembali</a>
</form>
@endsection

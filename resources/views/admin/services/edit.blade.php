@extends('layouts.admin')

@section('content')
<h2 class="text-center text-3xl font-semibold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-pink-400 to-pink-600 mb-5 drop-shadow">
    Edit Layanan
</h2>

<form method="POST" action="{{ route('services.update', $service) }}" class="bg-white rounded-xl shadow-md p-4" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label text-pink-700">Nama Layanan</label>
        <input type="text" name="name" class="form-control border-pink-300 shadow-sm" value="{{ old('name', $service->name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label text-pink-700">Harga (Rp)</label>
        <input type="number" name="price" class="form-control border-pink-300 shadow-sm" value="{{ old('price', $service->price ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label text-pink-700">Deskripsi</label>
        <textarea name="description" rows="3" class="form-control border-pink-300 shadow-sm">{{ old('description', $service->description ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label text-pink-700">Foto Layanan</label>
        <input type="file" name="photo" class="form-control border-pink-300 shadow-sm" accept="image/*">
        @if($service->photo)
            <img src="{{ asset('storage/' . $service->photo) }}" alt="Foto Layanan" class="img-thumbnail mt-2" style="max-width:120px;">
        @endif
    </div>

    <button type="submit" class="btn w-100 text-white mt-3 shadow" style="background-color: #ec4899;">
         Simpan Perubahan
    </button>
    <a href="{{ route('services.index') }}" class="btn btn-secondary w-100 mt-2">Kembali</a>
</form>
@endsection

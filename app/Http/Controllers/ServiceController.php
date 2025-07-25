<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function create()
{
    return view('admin.services.create');
}

public function edit(Service $service)
{
    return view('admin.services.edit', compact('service'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'description' => 'nullable',
        'photo' => 'nullable|image|max:2048'
    ]);
    $data = $request->all();
    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('services', 'public');
    }
    Service::create($data);
    return redirect()->route('services.index')->with('success', 'Layanan berhasil ditambahkan!');
}

public function update(Request $request, Service $service)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'description' => 'nullable',
        'photo' => 'nullable|image|max:2048'
    ]);
    $data = $request->all();
    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('services', 'public');
    }
    $service->update($data);
    return redirect()->route('services.index')->with('success', 'Layanan berhasil diupdate!');
}

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Layanan berhasil dihapus!');
    }
}
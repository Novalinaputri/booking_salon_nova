<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::all();
        return view('admin.staffs.index', compact('staffs'));
    }

    public function create()
{
    return view('admin.staffs.create');
}

public function edit(Staff $staff)
{
    return view('admin.staffs.edit', compact('staff'));
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'speciality' => 'required',
        ]);
        Staff::create($request->all());
        return redirect()->route('staffs.index')->with('success', 'Staff berhasil ditambahkan!');
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required',
            'speciality' => 'required',
        ]);
        $staff->update($request->all());
        return redirect()->route('staffs.index')->with('success', 'Staff berhasil diupdate!');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staffs.index')->with('success', 'Staff berhasil dihapus!');
    }
}
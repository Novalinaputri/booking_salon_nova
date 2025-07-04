<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }
    
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:nova_customers,email',
            'phone' => 'required',
        ]);
        Customer::create($request->all());
        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:nova_customers,email,'.$customer->id,
            'phone' => 'required',
        ]);
        $customer->update($request->all());
        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil diupdate!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}
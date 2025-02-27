<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        
        
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        // Kiểm tra email đã tồn tại hay chưa
        if (Customer::where('email', $request->email)->exists()) {
            return redirect()->back()->withInput()->withErrors(['email' => 'Email already exists.']);
        }

        try {
            Customer::create($request->all());
            return redirect()->route('customers.index')->with('success', 'Customer created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating customer: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while creating the customer. Please try again.']);
        }
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->except('email'));
        return redirect()->route('customers.index');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer->bookings()->exists()) {
            return redirect()->route('customers.index')->withErrors(['customer' => 'Cannot delete customer with active bookings!']);
        }

        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }

}

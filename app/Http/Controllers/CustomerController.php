<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::with('bookings')->get();

        $query = Customer::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%');
        }
        $customers = $query->paginate(10);
    
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
            'phone' => 'required|regex:/^[0-9]{10,11}$/',
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
        $customer = Customer::with('bookings')->findOrFail($id);

        // Kiểm tra xem khách hàng có booking hay không
        $status = $customer->bookings->isNotEmpty() ? 'Booking' : 'No Booking';

        return view('customers.show', compact('customer', 'status'));
    }


    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::with('bookings')->findOrFail($id);
        if ($customer->bookings()->exists()) {
            return redirect()->back()->with('error', 'Cannot edit customer with active bookings!');
        }
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required|regex:/^[0-9]{10,11}$/',
            'address' => 'required',
        ]);

        $customer = Customer::findOrFail($id);
        // Cập nhật thông tin khách hàng
        $customer->update($request->except('email'));
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer->bookings()->exists()) {
            return redirect()->route('customers.index')->withErrors(['customer_error' => 'Cannot delete customer with active bookings!']);
        }

        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }

}

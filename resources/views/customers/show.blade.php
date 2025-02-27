@extends('layout')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg p-4 rounded-3" style="width: 600px; background: #f8f9fa;">
            <h2 class="text-center mb-4 fw-bold text-primary">👤 Customer Details</h2>

            <div class="bg-white p-4 border rounded-3 shadow-sm">
                <h3 class="text-xl font-semibold text-dark mb-3">Name: <span class="text-primary">{{ $customer->name }}</span>
                </h3>
                <p><strong>Email:</strong> {{ $customer->email }}</p>
                <p><strong>Phone:</strong> {{ $customer->phone }}</p>
                <p><strong>Address:</strong> {{ $customer->address }}</p>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('customers.edit', $customer->id) }}"
                        class="btn btn-primary rounded-pill py-2 px-4 w-45">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('customers.index') }}"
                        class="btn btn-secondary rounded-pill py-2 px-4 w-45">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
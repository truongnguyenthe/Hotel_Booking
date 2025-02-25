@extends('layout')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4 rounded-3" style="width: 500px; background: #f8f9fa;">
        <h3 class="text-center mb-4 fw-bold text-primary">👥 Add New Customer</h3>

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">👤 Name</label>
                <input type="text" name="name" class="form-control rounded-pill px-3" placeholder="Enter customer name" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">📧 Email</label>
                <input type="email" name="email" class="form-control rounded-pill px-3" placeholder="Enter customer email" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">📞 Phone</label>
                <input type="text" name="phone" class="form-control rounded-pill px-3" placeholder="Enter customer phone" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">🏠 Address</label>
                <textarea name="address" class="form-control rounded-3 px-3" rows="3" placeholder="Enter customer address" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-pill shadow-sm">
                ➕ Add Customer
            </button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary w-100 py-2 fw-bold rounded-pill shadow-sm mt-3">
                ↩️ Back
            </a>
        </form>
    </div>
</div>
@endsection

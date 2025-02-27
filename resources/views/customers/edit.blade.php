@extends('layout')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg p-4 rounded-3" style="width: 500px; background: #f8f9fa;">
            <h3 class="text-center mb-4 fw-bold text-primary">✏️ Edit Customer</h3>

            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">👤 Customer Name</label>
                    <input type="text" name="name" id="name" class="form-control rounded-pill px-3"
                        value="{{ $customer->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">📧 Email</label>
                    <input type="text" name="email" id="email" class="form-control rounded-pill px-3"
                        value="{{ $customer->email }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label fw-bold">📞 Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control rounded-pill px-3"
                        value="{{ $customer->phone }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label fw-bold">🏠 Address</label>
                    <textarea name="address" id="address" class="form-control rounded-3 px-3" rows="3"
                        required>{{ $customer->address }}</textarea>
                </div>

                <button type="submit" class="btn btn-success w-100 py-2 fw-bold rounded-pill shadow-sm">
                    <i class="fas fa-save"></i> Update Customer
                </button>
            </form>

            <a href="{{ route('customers.index') }}"
                class="btn btn-secondary w-100 py-2 fw-bold rounded-pill shadow-sm mt-3">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
@endsection
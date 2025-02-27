@extends('layout')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg p-4 rounded-3" style="width: 500px; background: #f8f9fa;">
            <h3 class="text-center mb-4 fw-bold text-primary">👥 Add New Customer</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-triangle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customers.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">👤 Name</label>
                    <input type="text" name="name" id="name"
                        class="form-control rounded-pill px-3 @error('name') is-invalid @enderror"
                        placeholder="Enter customer name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">📧 Email</label>
                    <input type="email" name="email" id="email"
                        class="form-control rounded-pill px-3 @error('email') is-invalid @enderror"
                        placeholder="Enter customer email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label fw-bold">📞 Phone</label>
                    <input type="text" name="phone" id="phone"
                        class="form-control rounded-pill px-3 @error('phone') is-invalid @enderror"
                        placeholder="Enter customer phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label fw-bold">🏠 Address</label>
                    <textarea name="address" id="address"
                        class="form-control rounded-3 px-3 @error('address') is-invalid @enderror" rows="3"
                        placeholder="Enter customer address" required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-pill shadow-sm">
                    <i class="fas fa-plus"></i> Add Customer
                </button>
                <a href="{{ route('customers.index') }}"
                    class="btn btn-secondary w-100 py-2 fw-bold rounded-pill shadow-sm mt-3">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </form>
        </div>
    </div>
@endsection
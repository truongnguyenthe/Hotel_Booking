@extends('layout')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg p-4 rounded-3" style="width: 500px; background: #f8f9fa;">
            <h3 class="text-center mb-4 fw-bold text-primary">✏️ Edit Customer</h3>
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> 
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i> 
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            

            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">👤 Customer Name</label>
                    <input type="text" name="name" id="name" class="form-control rounded-pill px-3"
                        value="{{ $customer->name }}" required>
                    @error('name')
                        <div class="alert alert-danger mt-2 py-1 px-3 rounded-3 d-flex align-items-center">
                            <i class="fas fa-exclamation-circle me-2"></i> 
                            <small>{{ $message }}</small>
                        </div>
                    @enderror    
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
                    @if ($errors->has('phone'))
                        <div class="alert alert-danger d-flex align-items-center mt-2" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <span>{{ $errors->first('phone') }}</span>
                        </div>
                    @endif

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
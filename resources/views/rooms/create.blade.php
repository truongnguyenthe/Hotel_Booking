@extends('layout')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4 rounded-3" style="width: 500px; background: #f8f9fa;">
        <h3 class="text-center mb-4 fw-bold text-primary">🛏️ Add New Room</h3>

        {{-- Hiển thị lỗi chung --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf

            {{-- Room Name --}}
            <div class="mb-3">
                <label class="form-label fw-bold">🏷️ Room Name</label>
                <input type="text" name="name" class="form-control rounded-pill px-3 
                    @error('name') is-invalid @enderror" 
                    placeholder="Enter room name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label class="form-label fw-bold">📝 Description</label>
                <textarea name="description" class="form-control rounded-3 px-3 
                    @error('description') is-invalid @enderror" 
                    rows="3" placeholder="Enter description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Price --}}
            <div class="mb-3">
                <label class="form-label fw-bold">💲 Price ($)</label>
                <input type="number" name="price" class="form-control rounded-pill px-3 
                    @error('price') is-invalid @enderror" 
                    placeholder="Enter price" value="{{ old('price') }}" required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label fw-bold">📌 Status</label>
                <select name="status" class="form-select rounded-pill px-3 
                    @error('status') is-invalid @enderror">
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>✅ Available</option>
                    <option value="booked" {{ old('status') == 'booked' ? 'selected' : '' }}>❌ Booked</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Buttons --}}
            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-pill shadow-sm">
                ➕ Add Room
            </button>
            <a href="{{ route('rooms.index') }}" class="btn btn-secondary w-100 py-2 fw-bold rounded-pill shadow-sm mt-3">
                ↩️ Back
            </a>
        </form>
    </div>
</div>
@endsection

@extends('layout')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg p-4 rounded-3" style="width: 500px; background: #f8f9fa;">
            <h3 class="text-center mb-4 fw-bold text-primary">✏️ Edit Room</h3>

            {{-- Hiển thị lỗi chung --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-triangle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('rooms.update', $room->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Room Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">🏷️ Room Name</label>
                    <input type="text" name="name" id="name"
                        class="form-control rounded-pill px-3 @error('name') is-invalid @enderror"
                        value="{{ old('name', $room->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">📝 Description</label>
                    <textarea name="description" id="description"
                        class="form-control rounded-3 px-3 @error('description') is-invalid @enderror" rows="3"
                        required>{{ old('description', $room->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Price --}}
                <div class="mb-3">
                    <label for="price" class="form-label fw-bold">💲 Price ($)</label>
                    <input type="number" name="price" id="price"
                        class="form-control rounded-pill px-3 @error('price') is-invalid @enderror"
                        value="{{ old('price', $room->price) }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label fw-bold">📌 Status</label>
                    <select name="status" id="status"
                        class="form-select rounded-pill px-3 @error('status') is-invalid @enderror" required>
                        <option value="available" {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>✅
                            Available</option>
                        <option value="booked" {{ old('status', $room->status) == 'booked' ? 'selected' : '' }}>❌ Booked
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Update Button --}}
                <button type="submit" class="btn btn-success w-100 py-2 fw-bold rounded-pill shadow-sm">
                    <i class="fas fa-save"></i> Update Room
                </button>
            </form>

            {{-- Back Button --}}
            <a href="{{ route('rooms.index') }}"
                class="btn btn-secondary w-100 py-2 fw-bold rounded-pill shadow-sm mt-3">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
@endsection
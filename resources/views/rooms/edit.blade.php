@extends('layout')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg p-4 rounded-3" style="width: 500px; background: #f8f9fa;">
            <h3 class="text-center mb-4 fw-bold text-primary">✏️ Edit Room</h3>

            <form action="{{ route('rooms.update', $room->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">🏷️ Room Name</label>
                    <input type="text" name="name" id="name" class="form-control rounded-pill px-3" value="{{ $room->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">📝 Description</label>
                    <textarea name="description" id="description" class="form-control rounded-3 px-3" rows="3" required>{{ $room->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label fw-bold">💲 Price ($)</label>
                    <input type="number" name="price" id="price" class="form-control rounded-pill px-3" value="{{ $room->price }}" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label fw-bold">📌 Status</label>
                    <select name="status" id="status" class="form-select rounded-pill px-3" required>
                        <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>✅ Available</option>
                        <option value="booked" {{ $room->status == 'booked' ? 'selected' : '' }}>❌ Booked</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success w-100 py-2 fw-bold rounded-pill shadow-sm">
                    📝 Update Room
                </button>
            </form>

            <a href="{{ route('rooms.index') }}" class="btn btn-secondary w-100 py-2 fw-bold rounded-pill shadow-sm mt-3">
                ↩️ Back
            </a>
        </div>
    </div>
@endsection

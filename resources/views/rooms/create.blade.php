@extends('layout')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4 rounded-3" style="width: 500px; background: #f8f9fa;">
        <h3 class="text-center mb-4 fw-bold text-primary">🛏️ Add New Room</h3>

        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">🏷️ Room Name</label>
                <input type="text" name="name" class="form-control rounded-pill px-3" placeholder="Enter room name" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">📝 Description</label>
                <textarea name="description" class="form-control rounded-3 px-3" rows="3" placeholder="Enter description"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">💲 Price ($)</label>
                <input type="number" name="price" class="form-control rounded-pill px-3" placeholder="Enter price" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">📌 Status</label>
                <select name="status" class="form-select rounded-pill px-3">
                    <option value="available">✅ Available</option>
                    <option value="booked">❌ Booked</option>
                </select>
            </div>

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

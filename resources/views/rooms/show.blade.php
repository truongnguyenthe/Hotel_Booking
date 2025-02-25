@extends('layout')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-lg p-4 rounded-3" style="width: 600px; background: #f8f9fa;">
            <h2 class="text-center mb-4 fw-bold text-primary">🛏️ Room Details</h2>

            <div class="bg-white p-4 border rounded-3 shadow-sm">
                <h3 class="text-xl font-semibold text-dark mb-3">Room Name: <span class="text-primary">{{ $room->name }}</span></h3>
                <p><strong>Description:</strong> {{ $room->description }}</p>
                <p><strong>Price:</strong> ${{ number_format($room->price, 2) }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge {{ $room->status === 'available' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($room->status) }}
                    </span>
                </p>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-primary rounded-pill py-2 px-4 w-45">
                        ✏️ Edit
                    </a>
                    <a href="{{ route('rooms.index') }}" class="btn btn-secondary rounded-pill py-2 px-4 w-45">
                        ↩️ Back
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

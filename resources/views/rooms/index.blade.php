@extends('layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center fw-bold">🏨 Manage Rooms</h2>

    <!-- Thanh tìm kiếm và nút thêm phòng -->
    <form action="{{ route('rooms.index') }}" method="GET">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="input-group gap-3 w-50">
                <input type="text" class="form-control rounded-start" name="search" placeholder="🔍 Search rooms..." value="{{ request()->search }}">
                <button class="btn btn-primary" style="margin-left: 10px;">Search</button> 
            </div>
            <a href="{{ route('rooms.create') }}" class="btn btn-success px-4 py-2 fw-bold shadow-sm">
                + Add New Room
            </a>
        </div>
    </form>


    <!-- Bảng danh sách phòng -->
    <div class="card shadow-lg rounded">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="bg-dark text-white text-center">
                    <tr>
                        <th>Room Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                        <tr class="text-center">
                            <td class="fw-bold text-primary">{{ $room->name }}</td>
                            <td>{{ $room->description }}</td>
                            <td class="text-success fw-bold">${{ number_format($room->price) }}</td>
                            <td>
                                <span class="badge {{ $room->status === 'available' ? 'bg-success' : 'bg-danger' }} p-2">
                                    {{ ucfirst($room->status) }}
                                </span>
                            </td>
                            <td>
                                {{-- <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-info btn-sm text-white me-2 shadow-sm">
                                    🔍 Show
                                </a> --}}
                                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm text-white me-2 shadow-sm">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Are you sure?')">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

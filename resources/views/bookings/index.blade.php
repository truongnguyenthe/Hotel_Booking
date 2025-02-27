@extends('layout')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-center fw-bold">
            <i class="fas fa-calendar-check"></i> Manage Bookings
        </h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Thanh tìm kiếm -->
        <form action="{{ route('bookings.index') }}" method="GET">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="input-group gap-3 w-50">
                    <input type="text" class="form-control rounded-start" name="search" placeholder="🔍 Search rooms..." value="{{ request()->search }}">
                    <button class="btn btn-primary" style="margin-left: 10px;">Search</button> 
                </div>
                <a href="{{ route('bookings.create') }}" class="btn btn-success px-4 py-2 fw-bold shadow-sm">
                    + Add New Booking
                </a>
            </div>
        </form>

        <div class="card shadow-lg">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Booking ID</th>
                            <th>Customer Name</th>
                            <th>Room</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            {{-- <th>Status</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->customer_name }}</td>
                                <td>{{ $booking->room->name }}</td>
                                <td>{{ $booking->start_date }}</td>
                                <td>{{ $booking->end_date ?? 'N/A' }}</td>
                                
                                <td>
                                    <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>   Show
                                    </a>
                                    
                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>  Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Hiển thị phân trang -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

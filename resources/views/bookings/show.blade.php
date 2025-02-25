@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-primary text-white text-center">
                <h2 class="mb-0"><i class="fas fa-calendar-plus"></i> Booking Detail</h2>
            </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Booking ID</th>
                    <td>{{ $booking->id }}</td>
                </tr>
                <tr>
                    <th>Customer Name</th>
                    <td>{{ $booking->customer_name }}</td>
                </tr>
                <tr>
                    <th>Room Type</th>
                    <td>{{ $booking->room->name }}</td>
                </tr>
                <tr>
                    <th>Start Date</th>
                    <td>{{ $booking->start_date }}</td>
                </tr>
                <tr>
                    <th>End Date</th>
                    <td>{{ $booking->end_date }}</td>
                </tr>
                
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
</div>
@endsection

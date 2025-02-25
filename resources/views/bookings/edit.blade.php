@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-primary text-white text-center">
                <h2 class="mb-0"><i class="fas fa-calendar-plus"></i> Edit Booking</h2>
            </div>
        <div class="card-body">
            <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Chọn phòng --}}
                <div class="mb-3">
                        <label for="room_id" class="form-label font-weight-bold"><i class="fas fa-door-open"></i> Room</label>
                        <select name="room_id" id="room_id" class="form-select" required>
                            <option value="" disabled selected>-- Select a Room --</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" @if(old('room_id') == $room->id) selected @endif>
                                    {{ $room->name }} @if($room->status == 'booked') (Booked) @endif
                                </option>
                            @endforeach
                        </select>

                        {{-- Hiển thị thông báo lỗi nếu phòng đã được đặt --}}
                        @if ($errors->has('room_id'))
                            <div class="alert alert-danger mt-2">
                                <strong>{{ $errors->first('room_id') }}</strong>
                            </div>
                        @endif
                </div>

                {{-- Chọn khách hàng --}}
                    <div class="mb-3">
                        <label for="customer_id" class="form-label font-weight-bold"><i class="fas fa-user"></i> Customer</label>
                        <select name="customer_id" id="customer_id" class="form-select" required>
                            <option value="" disabled selected>-- Select a Customer --</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" @if(old('customer_id') == $customer->id) selected @endif>
                                    {{ $customer->name }} ({{ $customer->email }})
                                </option>
                            @endforeach
                        </select>

                        {{-- Hiển thị thông báo lỗi cho customer_id --}}
                        @if ($errors->has('customer_id'))
                            <div class="alert alert-danger mt-2">
                                <strong>{{ $errors->first('customer_id') }}</strong>
                            </div>
                        @endif
                    </div>

                <div class="mb-3">
                    <label for="start_date" class="form-label font-weight-bold">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $booking->start_date }}" required>
                    {{-- Hiển thị thông báo lỗi cho start_date --}}
                        @if ($errors->has('start_date'))
                            <div class="alert alert-danger mt-2">
                                <strong>{{ $errors->first('start_date') }}</strong>
                            </div>
                        @endif
                </div>

                <div class="mb-3">
                    <label for="end_date" class="form-label font-weight-bold">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $booking->end_date }}" required>
                    {{-- Hiển thị thông báo lỗi cho start_date --}}
                        @if ($errors->has('end_date'))
                            <div class="alert alert-danger mt-2">
                                <strong>{{ $errors->first('end_date') }}</strong>
                            </div>
                        @endif
                </div>

            
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary px-4 py-2 shadow">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <button type="submit" class="btn btn-success px-4 py-2 shadow">
                <i class="fas fa-save"></i> Save Booking
            </button>
        </div>
            </form>
        </div>
    </div>
</div>
@endsection

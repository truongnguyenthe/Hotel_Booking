@extends('layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center fw-bold">👥 Manage Customers</h2>
    {{-- @if (session('customer_error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('customer_error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif --}}
    @if ($errors->has('customer_error'))
        <div class="alert alert-danger">
            {{ $errors->first('customer_error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <!-- Thanh tìm kiếm và nút thêm khách hàng -->
    <form action="{{ route('customers.index') }}" method="GET">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="input-group gap-3 w-50">
                <input type="text" class="form-control rounded-start" name="search" placeholder="🔍 Search customers..." value="{{ request()->search }}">
                <button class="btn btn-primary" style="margin-left: 10px;">Search</button> 
            </div>
            <a href="{{ route('customers.create') }}" class="btn btn-success px-4 py-2 fw-bold shadow-sm">
                + Add New Customer
            </a>
        </div>
    </form>

    <!-- Bảng danh sách khách hàng -->
    <div class="card shadow-lg rounded">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="bg-dark text-white text-center">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr class="text-center">
                            <td class="fw-bold text-primary">{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>
                                <span class="badge {{ $customer->bookings()->exists() ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $customer->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm text-white me-2 shadow-sm">
                                    🔍 Show
                                </a>
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm text-white me-2 shadow-sm">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline">
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

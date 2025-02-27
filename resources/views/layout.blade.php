<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>BNB Manager</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f9;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 16px;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
            border-bottom: 1px solid #495057;
        }

        .sidebar a.active {
            background-color: #007bff;
            color: white;
        }

        .sidebar a:hover:not(.active) {
            background-color: #495057;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .navbar {
            background-color: #343a40;
            color: white;
        }

        .navbar a {
            color: white;
        }

        .navbar a:hover {
            color: #007bff;
        }

        .btn-info {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-info:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        @media screen and (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding-top: 10px;
            }

            .sidebar a {
                text-align: center;
                font-size: 16px;
                padding: 10px;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 p-0">
                <div class="sidebar">
                    <a href="{{url('/customers')}}" class="{{ Request::is('customers') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Customers
                    </a>
                    <a href="{{url('/rooms')}}" class="{{ Request::is('rooms') ? 'active' : '' }}">
                        <i class="fas fa-bed"></i> Rooms
                    </a>
                    <a href="{{url('/bookings')}}" class="{{ Request::is('bookings') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt"></i> Bookings
                    </a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Log out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            <div class="col-md-10">
                <div class="content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
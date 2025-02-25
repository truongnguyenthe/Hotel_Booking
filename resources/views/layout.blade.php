<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 
    <title>BNB Manager</title>
   
    <style>
        /* Sidebar style */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #3c4b64;
            color: white;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Add shadow for better UI */
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 16px;
            text-decoration: none;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .sidebar a.active {
            background-color: #04AA6D;
            color: white;
        }

        .sidebar a:hover:not(.active) {
            background-color: #575757;
            color: white;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        /* Content area */
        .content {
            margin-left: 260px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .navbar {
            margin-bottom: 20px;
        }

        /* On small screens, make sidebar top navigation */
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

        /* Add custom styles to make sidebar and content more attractive */
        .navbar {
            background-color: #3c4b64;
            color: white;
        }

        .navbar a {
            color: white;
        }

        .navbar a:hover {
            color: #04AA6D;
        }

        .btn-info {
            background-color: #04AA6D;
            border-color: #04AA6D;
        }

        .btn-info:hover {
            background-color: #048e56;
            border-color: #048e56;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0">
                <div class="sidebar">
                     <a href="{{url('/customers')}}" class="{{ Request::is('customers') ? 'active' : '' }}">Customers</a>
                    <a href="{{url('/rooms')}}" class="{{ Request::is('rooms') ? 'active' : '' }}">Rooms</a>                   
                    <a href="{{url('/bookings')}}" class="{{ Request::is('bookings') ? 'active' : '' }}">Bookings</a>                    
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            <!-- Main content area -->
            <div class="col-md-9">
                <div class="content">
                    @yield('content')  <!-- Content section for dynamic content -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

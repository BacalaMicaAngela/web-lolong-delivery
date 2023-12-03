<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .schedule-label {
            font-size: 20px;
            font-weight: bold;
            display: flex;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-container img {
            margin-right: 10px; /* Adjust the margin as needed */
        }

        .container-fluid {
        background-color: transparent; /* Set the background color to gray */
    }
    </style>
    </head>
    <body>
        <div id="page-content-wrapper" tyle="background-color: blue;">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="logo-container d-flex align-items-center">
                            <img src="img/lts-logo.png" class="rounded-full w-16 h-16" alt="Logo nueva viscaya">
                            <span class="schedule-label ml-2">LOLONG TRUCKING SERVICES</span>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div id="loader"></div>
            <div class="container-fluid p-3">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center"> 
                        @if ($data->userType == 0)
                        <div class="d-flex" id="wrapper">
                            <!-- Sidebar-->
                            <div class="border-end bg-white-200" id="sidebar-wrapper">
                                <div class="row"></div>
                                <div class="list-group list-group-flush">
                                    <span class="list-group-item list-group-item-light p-3 flex text-center">
                        <center><img src="./uploads/{{ $data->user_avatar }}" 
                        class="rounded-full w-28 h-28 border-2 border-gray-500" alt="avatar"></center> <b>
                            @if ($data->userType == 0)
                                System Administrator <br>
                            @endif
                            {{ $data->u_name }}
                        </b>
                    </span>
                    <a href="/pages" class="list-group-item list-group-item-action list-group-item-light p-3 {{ isset($home) ? $home : '' }}">
                        <i class="fa-solid fa-house-chimney mr-2"></i>Home </a>
                <a href="/driver"
                    class="list-group-item list-group-item-action list-group-item-light p-3 {{ isset($driver) ? $driver : '' }}">
                    <i class="fa-sharp fa-solid fa-user fa-people-roof text-lg mr-2"></i>Driver List</a>

                <a href="/truck"
                    class="list-group-item list-group-item-action list-group-item-light p-3 {{ isset($truck) ? $truck : '' }}">
                    <i class="fa-sharp fa-solid fa-truck fa-people-roof text-lg mr-2"></i> Truck List</a>

                <a href="/records"
                    class="list-group-item list-group-item-action list-group-item-light p-3 {{ isset($records) ? $records : '' }}">
                    <i class="fa-regular fa-file text-lg mr-2"></i>Delivery records</a>

                <a href="/schedule"
                    class="list-group-item list-group-item-action list-group-item-light p-3 {{ isset($schedule) ? $schedule : '' }}"><i
                        class="fa-sharp fa-regular fa-calendar text-lg mr-2"></i>Schedule Management</a>

                <a href="/maintenace"
                    class="list-group-item list-group-item-action list-group-item-light p-3 {{ isset($maintenace) ? $maintenace : '' }}"><i
                        class="fa-sharp fa-solid fa-screwdriver-wrench text-lg mr-2"></i>Maintenance and Repair Management</a>

                <a href="/billingState"
                        class="list-group-item list-group-item-action list-group-item-light p-3 {{ isset($billing) ? $billing : '' }}"><i
                            class="fa-sharp fa-solid fa-file-csv text-lg mr-2"></i> Billing Statement</a>
                
                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ isset($user) ? $user : '' }}"
                    href="/adminUserLists"><i class="fa-solid fa-users text-lg mr-2"></i>Manage Users</a>

                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ isset($recycleBin) ? $recycleBin : '' }}" 
                    href="{{ route('recycleBin') }}"> <i class="fa-solid fa-trash text-lg mr-2"></i>Recycle Bin</a>

                <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ isset($setting) ? $setting : '' }}"
                    href="/adminSettings"><i class="fa-sharp fa-solid fa-gears text-lg mr-2"></i>System Settings</a>
            </div>
        </div>

        
        <!-- Page content wrapper-->
        <div id="page-content-wrapper" >
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-blue border-bottom" style="padding: 14px;">
                <div class="container-fluid">
                    <button class="btn btn-light btn-sm" id="sidebarToggle"><i
                            class="fa-solid fa-bars text-xl"></i></button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><i
                            class="fa-solid fa-ellipsis-vertical"></i></button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="fa-solid fa-user mr-2"></i> Profile </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#manageProfile"><i
                                            class="fa-solid fa-bars text-xl"></i> Manage Profile </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout"><i
                                            class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            @yield('contentAdmin')
        </div>
    </div>
@endif
@include('pages.footer')
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @stack('title')
    <link rel="icon" href="{{url('assets/images/icons.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/vendor.bundle.base.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="{{url('assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/feather.css')}}"> -->

    <script src="{{url('assets/js/dashboard.js')}}"></script>
    <script src="{{url('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{url('assets/js/template.js')}}"></script>
    <script src="{{url('assets/js/vendor.bundle.base.js')}}"></script>
    <script src="{{url('assets/js/off-canvas.js')}}"></script>
    <script src="{{url('assets/js/settings.js')}}"></script>
</head>

<body>
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{{url('/worker/dashboard')}}"><img
                        src="{{url('assets/images/icons.png')}}" class="mr-2" alt="logo" />
                    @php
                    $user_id = session('User_ID');
                    @endphp

                    @foreach ($access_controls2 as $data)
                    <p>{{ $data->room_name  }}</p>
                    @break

                    @endforeach
                </a>


                <a class="navbar-brand brand-logo-mini" href="{{url('/worker/dashboard')}}"><img
                        src="{{url('assets/images/icons.png')}}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class='bx bx-menu'></span>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                <span class="input-group-text" id="search">
                                    <i class='bx bx-search-alt-2'></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
                                aria-label="search" aria-describedby="search">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link " data-bs-toggle="modal" data-bs-target="#myModal" href="">
                            <i class='bx bx-transfer bg-primary w3-circle p-2 text-white'></i>

                        </a>



                    </li>

                    <!------------------------------------ Profile Nav ---------------------------------->
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="{{url('assets/images/icons.png')}}" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{url('/worker/profile')}}">
                                <i class='bx bx-user text-primary'></i>
                                {{Session('name')}}
                            </a>
                            <a class="dropdown-item" href="{{url('/admin/firewinz-rules-regulations/view')}}"
                                data-bs-toggle="modal" data-bs-target="#rulesmodel">
                                <i class='bx bx-receipt text-primary'></i>
                                Rules and Regulations
                            </a>
                            <a class="dropdown-item" href="{{url('/admin/dashboard/logout')}}">
                                <i class='bx bx-log-out-circle text-primary'></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class='bx bx-menu bx-sm mx-0'></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class='bx bx-cog'></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>






            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/worker/dashboard')}}">
                            <i class='bx bxs-grid-alt bx-sm mx-1'></i>

                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/worker/chat')}}">
                            <i class='bx bx-chat bx-sm mx-1'></i>
                            <span class="menu-title">Firewinz Chat</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/worker/shiftreport/create')}}">
                            <i class='bx bxs-report bx-sm mx-1'></i>
                            <span class="menu-title">Shift Report</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/worker/transactions/create')}}">
                            <i class='bx bx-transfer-alt bx-sm mx-1'></i>
                            <span class="menu-title">Create Transactions</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/worker/transactions/view')}}">
                            <i class='bx bx-credit-card-front bx-sm mx-1'></i>
                            <span class="menu-title">View Transactions</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/admin/dashboard/logout')}}">
                            <i class='bx bx-log-out-circle bx-sm mx-1'></i>
                            <span class="menu-title">Logout</span>
                        </a>
                    </li>
                </ul>


            </nav>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Switch Rooms</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">


                            @if($countrooms>=1)
                            <form method="POST" action="{{url('/worker/dashboard')}}">
                                @csrf
                                <input type="hidden" value="{{Session::get('User_ID')}}" name="User_ID" type="text">
                                <select class="form-control" name="room_name">
                                    <option value="">Select an Option</option>
                                    @foreach($access_controls as $data)
                                    <option value="{{$data->room_id}}">{{$data->room_name }}
                                    </option>
                                    @endforeach
                                </select>

                                <br>
                                <button type="submit" class="btn btn-primary mb-2">Switch Room</button><br>

                            </form>
                            @else
                            <h3 class="text-center">You have no rooms</h3>
                            @endif

                        </div>

                    </div>
                </div>
            </div>


            <!--------- Rules and regulations model -------->
            <!-- The Modal -->
            <div class="modal" id="rulesmodel">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Worker rules and regulations</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            @if($rulescount>=1)
                            @foreach($rulesall as $data)
                            {!!$data->rules!!}
                            @endforeach
                            @endif
                            @if($rulescount<=0)<text>
                                There is no rules and regulations for workers currently.
                                </text> @endif </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <!--------- Rules and regulations model -------->
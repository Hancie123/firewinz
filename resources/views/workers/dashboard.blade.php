@include('layouts.workernav')
@push('title')
<title>Firewinz Dashboard</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>


<div class="main-panel">
    <div class="content-wrapper">

        <!-- Check Room Exit Before Clock In -->
        @error('room_id')
        <script>
        toastr.error("{{$message}}")
        </script>
        @enderror

        <!--------------------- The Announcement Modal -------------------->
        @if($countannouncement >=1)
        <div class="modal fade" id="announcementmodel">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        @foreach($announceall as $data)
                        <h4 class="modal-title">{{$data->title}}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <p style="font-size: 20px">{!!$data->announcement!!}</p><br>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <p class="text-start">Posted: {{$data['created_at']->todatestring()}}</p>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        @else
        @endif

        <script type="text/javascript">
        window.onload = function() {
            OpenBootstrapPopup();
        };

        function OpenBootstrapPopup() {
            $("#announcementmodel").modal('show');
        }
        </script>
        <!--------------------- The End Announcement Modal -------------------->





        <!-------------------- The Welcome Message Card ------------------------->
        <div class=" card-deck">
            <div class="card shadow">
                <div class="card-body">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <label alt="Profile" class="w3-circle bg-dark p-3 text-white h3">
                                    <b> <?php $name=Session('name'); echo substr("$name",0,1);?></b>
                                </label>
                            </div>

                            <div class="col-md-10">
                                <h3 style="font-weight: bold;">Welcome, {{Session('name')}}</h3>
                                <a class="text-dark" href="{{url('/admin/dashboard/logout')}}">Sign Out</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <!---------------------------- Clock in and Clock Out Section Card -------------------------->
            <div class="card shadow">
                <div class="card-body">


                    @if($countclockinstatus>=1)
                    <form method='post' action="{{url('/admin/clockout')}}">
                        @if(Session::has('success'))
                        <script>
                        toastr.success("{{Session::get('success')}}")
                        </script>
                        @endif
                        @if(Session::has('fail'))
                        <script>
                        toastr.warning("{{Session::get('fail')}}")
                        </script>
                        @endif
                        @csrf

                        <input type="hidden" name="checkout" value="<?php $timestamp = time();
            echo date('Y-m-d H:i:s', $timestamp); ?>">

                        <input type="hidden" value="{{Session::get('User_ID')}}" name="User_ID" type="text">

                        <input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="date" type="text">

                        @foreach ($access_controls2 as $data)

                        <input type="hidden" value="{{$data->room_id}}" name="room_id" type="text">
                        @break
                        @endforeach

                        <button type="submit" class="btn btn-danger btn-block"
                            style="height: 2.5em; font-size: 1.7rem;">Clock
                            Out <span><i class=' bx bx-right-arrow-alt bx bx-sm bx-fade-right'></i></span></button>



                    </form>
                    @elseif($countclockoutstatus>=1)

                    <form method='post' action="{{url('/admin/clockin')}}">
                        @if(Session::has('success'))
                        <script>
                        toastr.success("{{Session::get('success')}}")
                        </script>
                        @endif
                        @if(Session::has('fail'))
                        <script>
                        toastr.warning("{{Session::get('fail')}}")
                        </script>
                        @endif
                        @csrf

                        <input type="hidden" name="checkin" value="<?php $timestamp = time();
            echo date('Y-m-d H:i:s', $timestamp); ?>">

                        <input type="hidden" value="{{Session::get('User_ID')}}" name="User_ID" type="text">

                        <input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="date" type="text">

                        @foreach ($access_controls2 as $data)

                        <input type="hidden" value="{{$data->room_id}}" name="room_id" type="text">
                        @break
                        @endforeach

                        <button type="submit" class="btn btn-primary btn-block"
                            style="height: 2.5em; font-size: 1.7rem;">Clock
                            In <span><i class=' bx bx-right-arrow-alt bx bx-sm bx-fade-right'></i></span></button>



                    </form>
                    @else

                    <form method='post' action="{{url('/admin/newclockin')}}">
                        @if(Session::has('success'))
                        <script>
                        toastr.success("{{Session::get('success')}}")
                        </script>
                        @endif
                        @if(Session::has('fail'))
                        <script>
                        toastr.warning("{{Session::get('fail')}}")
                        </script>
                        @endif
                        @csrf

                        <input type="hidden" name="checkin" value="<?php $timestamp = time();
            echo date('Y-m-d H:i:s', $timestamp); ?>">

                        <input type="hidden" value="{{Session::get('User_ID')}}" name="User_ID" type="text">

                        <input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="date" type="text">

                        @foreach ($access_controls2 as $data)

                        <input type="hidden" value="{{$data->room_id}}" name="room_id" type="text">
                        @break
                        @endforeach

                        <button type="submit" class="btn btn-primary btn-block"
                            style="height: 2.5em; font-size: 1.7rem;">Clock
                            In <span><i class=' bx bx-right-arrow-alt bx bx-sm bx-fade-right'></i></span></button>



                    </form>
                    @endif



                </div>
            </div>
        </div>



        <br>





        <!-------------------- The Cash Inlow and Outflow Card ------------------------->
        <div class="card-deck">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <h5 class="card-title"><b>Cash In Amount</b></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon bg-primary p-1 rounded-circle d-flex align-items-center">
                                <i class='bx bx-dollar-circle bx-md text-warning'></i>
                            </div>
                            <div class="ps-3">
                                <h3>@if(isset($cashin))
                                    @foreach ($cashin as $payment)
                                    {{ $payment->{'SUM(cash_balance)'} }}
                                    @endforeach
                                    @endif
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <h5 class="card-title"><b>Cash Out Amount</b></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon bg-primary p-1 rounded-circle d-flex align-items-center">
                                <i class='bx bx-dollar-circle bx-md text-warning'></i>
                            </div>
                            <div class="ps-3">
                                <h3>@if(isset($cashout))
                                    @foreach ($cashout as $payment)
                                    {{ $payment->{'SUM(cash_balance)'} }}
                                    @endforeach
                                    @endif
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <h5 class="card-title"><b>Gross Amount</b></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon bg-primary p-1 rounded-circle d-flex align-items-center">
                                <i class='bx bx-dollar-circle bx-md text-warning'></i>
                            </div>
                            <div class="ps-3">
                                <h3>@if(isset($grosscashamount))
                                    @foreach ($grosscashamount as $payment)
                                    {{ $payment->{'gross_cash_amount'} }}
                                    @endforeach
                                    @endif
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-------------------- The End Cash Inlow and Outflow Card ------------------------->
        <br>

        <!-------------------- The Game Data Card ------------------------->
        <div class="row">
            <div class="card-deck">
                @foreach ($gamedata as $data)
                <div class="col-sm-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body">
                                <h5 class="card-title"><b>{{ $data->product_name }}</b></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon bg-primary p-1 rounded-circle d-flex align-items-center">
                                        <i class='bx bx-dollar-circle bx-md text-warning'></i>
                                    </div>
                                    <div class="ps-3">
                                        <h3>{{$data->gross_credit_amount}}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
        <!-------------------- The End Game Data Card ------------------------->





    </div>
</div>

</div>

</body>

</html>
@include('layouts.workernav')
@push('title')
<title>Fire Wins | {{Session('name')}} Profile</title>

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
        <h3><b>{{Session('name')}} Profiles</b></h3><br>

        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <img class="card-img-top img-fluid" src="{{asset('assets/images/profile.webp')}}"
                            alt="Card image">
                        <div class="card-body">
                            <h4 class="card-title text-center">{{Session('name')}}</h4>
                            <hr>
                            <h5 class="card-text text-center">Email: {{Session('email')}}</h5>
                            <h5 class="card-text text-center">Role: {{Session('role')}}</h5>

                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Change password</h3><br><br>
                            @if(Session::has('success'))
                            <div class="alert alert-success w3-display-bottommiddle">
                                <strong>Success!</strong> {{Session::get('success')}}
                            </div>
                            @endif
                            @if(Session::has('error'))
                            <div class="alert alert-danger w3-display-bottommiddle">
                                <strong>Fail!</strong> {{Session::get('error')}}
                            </div>
                            @endif

                            <form action="{{url('/admin/profile/changepassword')}}" method="post"><br>
                                @csrf
                                <label>Current Password</label>
                                <input class="w3-input w3-border w3-round" name="current_password" type="text">
                                <span class="text-danger">
                                    @error('current_password')
                                    {{$message}}
                                    @enderror
                                </span>
                                <br>
                                <label>New Password</label>
                                <input class="w3-input w3-border w3-round" name="new_password" type="text">
                                <span class="text-danger">
                                    @error('new_password')
                                    {{$message}}
                                    @enderror
                                </span>
                                <br>
                                <label>Confirm password</label>
                                <input class="w3-input w3-border w3-round" name="confirm_password" type="text">
                                <span class="text-danger">
                                    @error('confirm_password')
                                    {{$message}}
                                    @enderror
                                </span>
                                <br>
                                <button type="submit" class="btn btn-primary mt-3">Change password</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="container mt-3 border rounded p-3">
            <div class="row">
                <div class="col-sm-4">

                    <div class="card w3-leftbar w3-border-blue shadow  py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class=" h4 text-xs font-weight-bold text-primary">
                                        My Total Customers</div><br>
                                    <h3 class="h4 mb-0 font-weight-bold text-gray-800"> {{$countcustomer}}
                                    </h3>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-sm-4">

                    <div class="card w3-leftbar w3-border-blue shadow  py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class=" h4 text-xs font-weight-bold text-primary">
                                        My Total Cash-In</div><br>
                                    <h3 class="h4 mb-0 font-weight-bold text-gray-800"> {{$sumcheckin}}
                                    </h3>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-sm-4">

                    <div class="card w3-leftbar w3-border-blue shadow  py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class=" h4 text-xs font-weight-bold text-primary">
                                        My Total Cash-Out</div><br>
                                    <h3 class="h4 mb-0 font-weight-bold text-gray-800"> {{$sumcheckout}}
                                    </h3>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>





    </div>
</div>
</div>
</body>

</html>
@include('layouts.adminnav')
@push('title')
<title>Firewinz | {{Session('name')}} Profile</title>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

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





    </div>
</div>
</div>






</body>

</html>
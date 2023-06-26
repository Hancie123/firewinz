@include('layouts.adminnav')
@push('title')
<title>Firewinz | Rules and regulations for workers</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">



<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>


<div class="main-panel">
    <div class="content-wrapper">
        <h3 class="text-center"><b>Firewinz rules and regulations for workers</b></h3><br>
        <br>

        @if(Session::has('success'))

        <div class="alert alert-success w3-display-bottommiddle">
            <strong>Success!</strong> {{Session::get('success')}}
        </div>

        @endif

        @if(Session::has('fail'))
        <div class="alert alert-danger w3-display-bottommiddle">
            <strong>Fail!</strong> {{Session::get('fail')}}
        </div>
        @endif

        @if($rulescount>=1)
        @foreach($rulesall as $data)

        <form action="{{url('/admin/firewinz-rules-regulations/edit')}}/{{$data->rules_id}}" method="post">
            @csrf
            <input type="hidden" value="{{Session::get('User_ID')}}" name="User_ID">
            <input id="x" type="hidden" value="{{ $data->rules }}" name=" content">
            <trix-editor class="trix-content" input="x"></trix-editor>
            <span class="text-danger">
                @error('content')
                {{$message}}
                @enderror
            </span>
            <br>

            <button type="submit" class="btn btn-primary mt-3"><i class='bx bx-edit-alt'></i> Edit</button>
            <a href="{{url('/admin/firewinz-rules-regulations/delete')}}/{{$data->rules_id}}"
                class="btn btn-primary mt-3"><i class='bx bx-message-rounded-x'></i> Delete</a>

        </form><br>




        @endforeach
        @endif







        @if($rulescount<=0) <form action="{{url('/admin/firewinz-rules-regulations/insert')}}" method="post">
            @csrf
            <input type="hidden" value="{{Session::get('User_ID')}}" name="User_ID" type="text">
            <input id="x" type="hidden" name="content">
            <trix-editor class="trix-content" input="x"></trix-editor>
            <span class="text-danger">
                @error('content')
                {{$message}}
                @enderror()
            </span>
            <br>
            <button type="submit" class="btn btn-primary mt-3"><i class='bx bx-edit-alt'></i> Publish</button>


            </form><br>
            @endif






            <style>
            .trix-content {
                height: 300px;
                /* Adjust the height as desired */
            }
            </style>















    </div>
</div>
</div>






<!-- SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
</body>

</html>
@include('layouts.workernav')
@push('title')
<title>Firewinz | Shift Report</title>
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
        <h3><b>Shift Report</b></h3><br>


        @if(Session::has('success'))
        <script>
        toastr.success("{{Session::get('success')}}")
        </script>
        @endif
        @if(Session::has('fail'))
        <script>
        toastr.fail("{{Session::get('fail')}}")
        </script>
        @endif



        <div class="container border p-4 w3-round">


            <form method="POST" action="{{url('/worker/shiftreport/create')}}">
                @csrf
                @foreach ($gamedata as $data)
                <div class="row">
                    <div class="col-md-4 mt-2">
                        <label>Game</label>
                        <input class=" w3-input w3-border w3-round" name="game[]" type="text"
                            value="{{ $data->product_name }}" readonly>
                    </div>
                    <div class="col-md-4 mt-2">
                        <label>Game Balance</label>
                        <input class="w3-input w3-border w3-round" name="gamebalance[]" type="text"
                            value="{{ $data->gross_credit_amount }}" readonly>
                    </div>

                    <div class="col-md-4 mt-2">
                        <label>Game Backend Balance</label>
                        <input class="w3-input w3-border w3-round" name="gamebackendbalance[]" type="text">
                        <span class="text-danger">
                            @error('gamebackendbalance.*')
                            {{$message}}
                            </script>
                            @enderror
                        </span>
                    </div>
                </div><br>
                @foreach ($access_controls2 as $data)
                <input type="hidden" value="{{$data->room_id}}" name="room_id[]" type="text">
                @break
                @endforeach
                <input type="hidden" value="{{Session::get('User_ID')}}" name="User_ID[]" type="text">


                @endforeach

                @if($countgamedata->count() >= 1)
                <button type="submit" class="btn btn-primary mb-2">Save</button><br>
                @else
                <h3 class="text-center">You have no shift report on this room</h3>
                @endif

            </form>


        </div>
        <br>






    </div>
</div>
</div>


</body>

</html>
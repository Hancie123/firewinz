@include('layouts.adminnav')
@push('title')
<title>Firewinz | Cash Data Analytics</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>


<div class="main-panel">
    <div class="content-wrapper">
        <h3><b>Cash-In Amount and Cash-Out Amount Data Analytics</b></h3><br>

        <div class="container border p-3 rounded">
            <form action="{{url('/admin/firewinz-analytics/cashin-cashout-analytics')}}" method="get">
                @csrf
                <div class="row">

                    <div class="col-md-6">
                        <label>Select Room<sup class="text-danger fw-bold">*</sup></label>

                        <select class="select2 form-control" name="room_id">
                            <option value="">Select an Option</option>
                            @foreach($rooms as $room)
                            <option value="{{ $room->room_id }}">{{ $room->room_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('room_id')
                            {{$message}}
                            @enderror
                        </span>


                    </div>
                    <div class="col-md-6">
                        <label>Select no of days<sup class="text-danger fw-bold">*</sup></label>

                        <select class="select2 form-control" name="no_of_days">
                            <option value="">Select an Option</option>
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="60">60</option>
                            <option value="90">90</option>
                            <option value="365">365</option>
                            <option value="all-time">all-time records</option>

                        </select>
                        <span class="text-danger">
                            @error('no_of_days')
                            {{$message}}
                            @enderror
                        </span>


                    </div>

                </div>
                <button class="btn btn-primary mt-3">Search</button>
            </form>
        </div>

        <br>
        @if(empty($fifteendaysChart))
        <h4 class="bold h4 text-center border p-4 m-3 rounded">Please select a room ID and number of days to show data
            analytics.
        </h4>
        @else

        <!------------- Card analytics -------------->
        <div class="container m-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <h4 class="card-title text-primary">{{$days}} days Cash-In</h4>
                            <h4 style="font-weight:bold" class="text-danger">{{$cashin[0]->cash}}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <h4 class="card-title text-primary">{{$days}} days Cash-Out</h4>
                            <h4 style="font-weight:bold" class="text-danger">{{$cashout[0]->cash}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-------------- Graph ------------------->
        <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Date', 'Cash-In Amount', "Cash-Out Amount", "Gross Amount"],
                <?php echo $fifteendaysChart?>
            ]);

            var options = {
                title: 'Showing Last {{$days}} days records',
                hAxis: {
                    title: 'Date',
                    titleTextStyle: {
                        color: '#333'
                    }
                },
                vAxis: {
                    minValue: 0
                }
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
        </script>
        <div id="chart_div" style="width: 100%; height: 70vh;"></div>


        @endif






















    </div>
</div>
</div>







</body>

</html>
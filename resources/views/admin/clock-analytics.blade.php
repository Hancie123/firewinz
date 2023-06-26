@include('layouts.adminnav')
@push('title')
<title>Firewinz | Clock Data Analytics</title>

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
            <h3><b>Clock-In and Clock-Out Data Analytics</b></h3><br>


<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="tab" href="#home">15 days </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#menu1">30 days</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#menu2">All times</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#menu3">Users transaction</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">

  <!-------- 15 days data ------->
    <div id="home" class="container tab-pane active"><br>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Date', 'Check-In',"Check-Out"],
            <?php echo $fifteenchart?>
        ]);

        var options = {
          title: 'Clock analytics of 15 days',
          hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <div id="chart_div" style="width: 100%; height: 70vh;"></div>
    </div>

<!-------- 30 days data ------->
    <div id="menu1" class="container tab-pane fade"><br>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Date', 'Check-In',"Check-Out"],
            <?php echo $thirtychart?>
        ]);

        var options = {
          title: 'Clock analytics of 30 days',
          hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('30days-chart'));
        chart.draw(data, options);
      }
    </script>
    <div id="30days-chart" style="width: 100%; height: 70vh;"></div>
    </div>

<!-------- all time data ------->
    <div id="menu2" class="container tab-pane fade"><br>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Date', 'Check-In',"Check-Out"],
            <?php echo $allTimeChart?>
        ]);

        var options = {
          title: 'Clock analytics of all time',
          hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('all-time'));
        chart.draw(data, options);
      }
    </script>
    <div id="all-time" style="width: 100%; height: 70vh;"></div>
    </div>



    <!-------- worker transaction data ------->
    <div id="menu3" class="container tab-pane fade"><br>

    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Remarks', 'Deposit'],
            <?php echo $workerchart?>
        ]);

        var options = {
          title: 'The total clock-in and clock-out done by workers',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
    <div id="piechart_3d" style="width: 100%; height: 70vh;"></div>
    </div>


    
  </div>


<style>
.tab-content>.tab-pane {
    height: 1px;
    overflow: hidden;
    display: block;
    visibility: hidden;
}

.tab-content>.active {
    height: auto;
    overflow: auto;
    visibility: visible;
}
</style>








  


        


        </div>
    </div>
</div>







</body>

</html>
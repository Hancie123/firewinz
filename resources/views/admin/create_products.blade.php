@include('layouts.adminnav')
@push('title')
<title>Fire Wins | Create Products</title>

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
        <h3><b>Create Products</b></h3><br>



        <div class="container border p-4 w3-round">
            <form method="post" action="{{url('/admin/products/create')}}">
                @csrf

                <input type="hidden" value="{{Session::get('User_ID')}}" name="User_ID" type="text">
                <input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="date" type="text">
                <div class="row">
                    <div class="col-md-6">
                        <label>Product Name</label>
                        <input class="w3-input w3-border w3-round" name="product_name" type="text">
                        <span class="text-danger">
                            @error('name')
                            {{$message}}
                            </script>
                            @enderror
                        </span>
                    </div><br>

                    <div class="col-md-6">
                        <label>Room Name</label>
                        <select class="select2 form-control" name="room_id">
                            @foreach($rooms as $room)
                            <option value="{{ $room->room_id }}">{{ $room->room_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('room_id')
                            {{$message}}
                            </script>
                            @enderror
                        </span>

                    </div><br>
                </div>
                <br>






                <br>

                <button type="submit" class="btn btn-primary mb-2">Create</button><br>


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
            </form>

        </div>
        <br><br>

        <table class="table table-hover table-striped" id="table_data">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Room Name</th>
                    <th>Date</th>
                </tr>
            </thead>
        </table>

        <script>
        $(document).ready(function() {
            $('#table_data').DataTable({
                ajax: '/admin/products/ajax',
                processing: true,
                columns: [{
                        data: 'product_id'
                    },
                    {
                        data: 'product_name'
                    },

                    {
                        data: 'room_name',
                        render: function(data, type, row, meta) {
                            return data ? data : 'N/A';
                        }
                    },
                    {
                        data: 'date'
                    }
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    'print'
                ]
            });
        });
        </script>

        <style>
        .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px) !important;

        }
        </style>


        <style>
        /* Change the background color of the table header */
        #table_data thead {
            background-color: rgb(63, 62, 145);
            color: #fff;
        }

        /* Change the font size and weight of the table header */
        #table_data th {
            font-size: 16px;
            font-weight: bold;
        }

        /* Change the background color and font size of the table rows */
        #table_data tbody tr {
            background-color: #f8f9fa;
            font-size: 14px;
        }

        /* Add hover effect to the table rows */
        #table_data tbody tr:hover {
            background-color: #e2e6ea;
        }

        .dataTables_wrapper .dataTables_filter input {
            font-size: 14px;
            padding: 6px;
            width: 300px;
            border-radius: 5px;
        }

        .dataTables_wrapper .dataTables_filter label {
            font-size: 14px;
            font-weight: bold;
        }

        /* Change the background color of the DataTable buttons */
        .dataTables_wrapper .dt-buttons button {
            background-color: #3f3e91;
            color: white;
        }

        /* Change the background color of the DataTable buttons on hover */
        .dataTables_wrapper .dt-buttons button:hover {
            background-color: #3e8e41;
            color: white;
        }
        </style>
    </div>
</div>
</div>


<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: 'Select an option'
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>





</body>

</html>
@include('layouts.adminnav')
@push('title')
<title>Fire Wins | Expenses</title>
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
        <h3><b>Create Expenses Record</b></h3><br>



        <div class="container border p-4 w3-round">

            <form method="post" action="{{url('/admin/expenses/create')}}">
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
                @csrf

                <input type="hidden" value="{{Session::get('User_ID')}}" name="User_ID" type="text">
                <div class="row">
                    <div class="col-md-6">
                        <label>Date:</label>
                        <input type="date" class="w3-input w3-border w3-round" name="date">
                        <span class="text-danger">
                            @error('date')
                            {{$message}}
                            </script>
                            @enderror
                        </span>
                    </div><br>

                    <div class="col-md-6">
                        <label>Remarks</label>
                        <input class="w3-input w3-border w3-round" name="remarks" type="text">
                        <span class="text-danger">
                            @error('remarks')
                            {{$message}}
                            </script>
                            @enderror
                        </span>
                    </div><br>
                </div>
                <br>


                <div class="row">
                    <div class="col-md-6">
                        <label>Amount</label>
                        <input class="w3-input w3-border w3-round" name="amount" type="text">
                        <span class="text-danger">
                            @error('amount')
                            {{$message}}
                            </script>
                            @enderror
                        </span>
                    </div><br>

                    <div class="col-md-6">

                    </div><br>
                </div>
                <br>


                <br>

                <button type="submit" class="btn btn-primary mb-2">Create</button><br>
            </form>

        </div>
        <br><br>

        <table class="table table-hover table-striped" id="table_data">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Remarks</th>
                    <th>Created By</th>
                </tr>
            </thead>
        </table>

        <script>
        $(document).ready(function() {
            $('#table_data').DataTable({
                ajax: '/admin/expenses/ajaxtable',
                processing: true,
                columns: [{
                        data: 'expenses_id'
                    },
                    {
                        data: 'date'
                    },

                    {
                        data: 'amount',
                        render: function(data, type, row) {
                            // format the amount with comma separators
                            return parseFloat(data).toLocaleString('en-US');
                        }
                    },
                    {
                        data: 'remarks'
                    },
                    {
                        data: 'name'
                    },

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

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: white;
            background-color: #3f3e91;
            border-color: #007bff;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff;
            background-color: #3e8e41;
            border-color: #0056b3;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: white;
            background-color: #3f3e91;
            border-color: #0056b3;
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
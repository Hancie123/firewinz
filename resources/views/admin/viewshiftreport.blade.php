@include('layouts.adminnav')
@push('title')
<title>Firewinz | View All Shift Report</title>

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
        <h3><b>View All Shift Report</b></h3><br>

        <table class="table table-hover table-striped" id="table_data">
            <thead>
                <tr>
                    <th>Shift ID</th>
                    <th>Game Name</th>
                    <th>Game Balance</th>
                    <th>Game Backend Balance</th>
                    <th>Room Name</th>
                    <th>Worker Name</th>
                    <th>Created At</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>



        <script>
        $(document).ready(function() {
            $('#table_data').DataTable({
                "processing": true,
                "ajax": "/admin/shiftreport/ajax",
                "columns": [{
                        "data": "shift_id"
                    },
                    {
                        "data": "gamename"
                    },
                    {
                        "data": "gamebalance"
                    },
                    {
                        "data": "gamebackendbalance"
                    },
                    {
                        "data": "room_name"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "created_at"
                    }
                ],
                "dom": 'Bfrtip',
                "buttons": [{
                        "extend": 'copyHtml5',
                        "title": 'Transaction Records'
                    },
                    {
                        "extend": 'excelHtml5',
                        "title": 'Transaction Records'
                    },
                    {
                        "extend": 'csvHtml5',
                        "title": 'Transaction Records'
                    },
                    {
                        "extend": 'pdfHtml5',
                        "title": 'Transaction Records'
                    },
                    {
                        "extend": 'print',
                        "title": 'Transaction Records'
                    }
                ]
            });
        });

        function deleteAccess(transaction_id) {
            if (confirm('Are you sure you want to delete this transaction record?')) {
                $.ajax({
                    url: '/admin/transactions/delete/' + transaction_id,
                    type: 'GET',
                    data: {
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            $('#table_data').DataTable().ajax.reload();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"
    integrity="sha512-CryKbMe7sjSCDPl18jtJI5DR5jtkUWxPXWaLCst6QjH8wxDexfRJic2WRmRXmstr2Y8SxDDWuBO6CQC6IE4KTA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>




</body>

</html>
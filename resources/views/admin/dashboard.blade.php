@include('layouts.adminnav')
@push('title')
<title>Fire Wins Dashboard</title>
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

        <h3>Hello {{Session('name')}}</h3>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-8 mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Total Workers -->
                            <div class="card w3-leftbar w3-border-blue shadow  py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary">
                                                Total Workers</div><br>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$workerCount}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div><br>



                            <!-- Total Rooms -->
                            <div class="card w3-leftbar w3-border-blue shadow py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary">
                                                Total Rooms</div><br>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countrooms}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div><br>


                            <!-- Total Customers -->
                            <div class="card w3-leftbar w3-border-blue shadow py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary">
                                                Total Customers</div><br>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countcustomer}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div><br>


                            <!-- Total Free Play -->
                            <div class="card w3-leftbar w3-border-blue shadow py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary">
                                                Total Freeplay</div><br>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countfreeplay}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>


                        <div class="col-md-6">
                            <!-- Total Expenses -->

                            <div class="card w3-leftbar w3-border-blue shadow py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary">
                                                Total Expenses</div><br>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo number_format($totalAmount)?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div><br>


                            <!-- Total Games -->
                            <div class="card w3-leftbar w3-border-blue shadow py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary">
                                                Total Games</div><br>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countproducts}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div><br>

                            <!-- Total Transactions -->
                            <div class="card w3-leftbar w3-border-blue shadow py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary">
                                                Total Transactions</div><br>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$counttransactions}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div><br>


                            <!-- Total Referral -->
                            <div class="card w3-leftbar w3-border-blue shadow py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary">
                                                Total Referral</div><br>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countreferral}}
                                            </div>
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



                <div class="col-md-4 mt-2">
                    <!-- Recent Activity -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recent Chats</h5>
                            <div class="activity">
                                @foreach($viewchat as $data)
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action m-1 card bg-light">
                                        <div class="media">
                                            <label alt="Profile"
                                                class="w3-circle bg-primary py-3 px-3 text-white h5 rounded-circle">
                                                <?php $name=$data->name; echo substr("$name",0,1);?>
                                            </label>
                                            <div class="media-body">
                                                <h5 class="mt-0 text-dark px-2 m-0">{{$data->name}}</h5>
                                                <p class="text-dark px-2 m-0">{{$data->message}}</p>
                                                <p class="text-dark px-2 m-0">{{$data['created_at']->diffForHumans()}}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div><!-- End Recent Activity -->

                </div>
            </div>
        </div>



        <br><br>
        <div class="table-responsive">
        <table class="table table-hover table-striped" id="table_data">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Type</th>
                    <th>Note</th>
                    <th>Cash</th>
                    <th>Credit</th>
                    <th>Authorizer</th>
                    <th>Payment Name</th>
                    <th>Date</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </div>






        <script>
        $(document).ready(function() {
            $('#table_data').DataTable({
                "processing": true,
                "ajax": "/admin/transactions/ajax",
                "columns": [{
                        "data": "transaction_id"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "product_name"
                    },
                    {
                        "data": "type"
                    },
                    {
                        "data": "note"
                    },

                    {
                        "data": "cash"
                    },
                    {
                        "data": "Credit"
                    },
                    {
                        "data": "user_name"
                    },
                    {
                        "data": "payment_name"
                    },
                    {
                        "data": "date"
                    }, {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-danger btn-sm" onclick="deleteAccess(' +
                                row.transaction_id + ')">Delete</button>';
                        }
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

</body>

</html>
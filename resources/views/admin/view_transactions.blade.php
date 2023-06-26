@include('layouts.adminnav')
@push('title')
<title>Firewinz | View Transactions</title>

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
        <h3><b>All Transactions</b></h3><br>
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
                        <th>Cash Identifier</th>
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
                        "data": "cash_identifier"
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
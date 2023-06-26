@include('layouts.adminnav')
@push('title')
<title>Fire Wins | Create Worker Accounts</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<div class="main-panel">
    <div class="content-wrapper">
        <h3><b>Create Worker Accounts</b></h3><br>



        <div class="container border p-4 w3-round">
            <form method="post" action="{{url('/admin/workers/create')}}">

                @csrf

                <input type="hidden" value="Active" name="status">
                <div class="row">
                    <div class="col-md-6">
                        <label>Name</label>
                        <input class="w3-input w3-border w3-round" name="name" type="text">
                        <span class="text-danger">
                            @error('name')
                            {{$message}}
                            </script>
                            @enderror
                        </span>
                    </div><br>

                    <div class="col-md-6">
                        <label>Email</label>
                        <input class="w3-input w3-border w3-round" name="email" type="email">
                        <span class="text-danger">
                            @error('email')
                            {{$message}}
                            </script>
                            @enderror
                        </span>
                    </div><br>
                </div>
                <br>


                <div class="row">
                    <div class="col-md-6">
                        <label>Password</label>
                        <input class="w3-input w3-border w3-round" name="password" type="password">
                        <span class="text-danger">
                            @error('password')
                            {{$message}}
                            </script>
                            @enderror
                        </span>
                    </div><br>

                    <div class="col-md-6">
                        <label>Role</label>
                        <input class="w3-input w3-border w3-round" type="text" name="role" value="Worker" readonly>
                    </div><br>
                </div>

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
            <thead class="w3-center">
                <tr>
                    <th>Worker ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be displayed here -->
            </tbody>
        </table>

        <script>
        $(document).ready(function() {
            $('#table_data').DataTable({
                'ajax': '/admin/workers/ajax',
                processing: true,
                'columns': [{
                        'data': 'User_ID'
                    },
                    {
                        'data': 'name'
                    },
                    {
                        'data': 'email'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-danger btn-sm" onclick="deleteAccess(' +
                                row.User_ID + ')">Disable</button>';
                        }
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

        function deleteAccess(User_ID) {
            if (confirm('Are you sure you want to disable this worker account?')) {
                $.ajax({
                    url: '/admin/workers/disableaccount/' + User_ID,
                    type: 'GET',
                    data: {
                        _method: 'PUT'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            $('#table_data').DataTable().ajax.reload(); // Refresh the table
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>
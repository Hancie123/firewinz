@include('layouts.adminnav')
@push('title')
<title>Fire Wins | Create Transactions</title>
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
        <h3><b>Create Transaction</b></h3><br>



        <div class="container border p-4 w3-round">
        <a href="#" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#customermodel"><i
                    class='bx bx-plus'>Create Customer </i></a><br>

            <!-- The Modal -->
            <div class="modal fade" id="customermodel">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Create Customers</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">

                            <form method="post" action="{{url('/admin/customers/create')}}">
                                @csrf

                                <input type="hidden" value="{{Session::get('User_ID')}}" name="User_ID" type="text">
                                <input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="date" type="text">
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
                                        <label>Facebook Link</label>
                                        <input class="w3-input w3-border w3-round" name="facebook_link" type="text">
                                        <span class="text-danger">
                                            @error('facebook_link')
                                            {{$message}}
                                            </script>
                                            @enderror
                                        </span>
                                    </div><br>

                                    <div class="col-md-6">
                                        <label>Mobile No</label>
                                        <input class="w3-input w3-border w3-round" type="text" name="mobile">
                                        <span class="text-danger">
                                            @error('mobile')
                                            {{$message}}
                                            </script>
                                            @enderror
                                        </span>
                                    </div><br>
                                </div>
                                <br>
                                

                                <br>

                                <button type="submit" class="btn btn-primary mb-2">Create</button><br>
                            </form>




                        </div>


                    </div>
                </div>
            </div>
            <!-- ------Create customer account model close ----->


            <form method="post" action="{{url('/admin/transactions/create')}}" class="mt-4">
                @csrf

                <input type="hidden" value="{{Session::get('User_ID')}}" name="User_ID" type="text">
                <input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="date" type="text">



                <div class="row">
                    <div class="col-sm-4">
                        <label>Customer Name <sup class="text-danger fw-bold">*</sup></label>
                        <select class="select2 form-control" name="customer_name">
                            <option value="">Select an Option</option>
                            @foreach($customers as $customer)
                            <option value=" {{ $customer->customer_id }}">{{ $customer->customer_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('customer_name')
                            {{$message}}

                            @enderror
                        </span>
                    </div>


                    <div class="col-sm-4">
                        <label>Game Name <sup class="text-danger fw-bold">*</sup></label>
                        <select class="select2 form-control" name="game_name">
                            <option value="">Select an Option</option>
                            @foreach($games as $game)
                            <option value=" {{ $game->product_id }}">{{ $game->product_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('game_name')
                            {{$message}}
                            @enderror
                        </span>

                    </div>


                    <div class="col-sm-4">
                        <label>Type<sup class="text-danger fw-bold">*</sup></label>
                        <select class="select2 form-control" name="type">
                            <option value="">Select an Option</option>
                            <option value=" Redeem">Redeem</option>
                            <option value="Recharge">Recharge</option>
                            <option value="Freeplay">Freeplay</option>
                            <option value="Referral">Referral</option>
                        </select>
                        <span class="text-danger">
                            @error('type')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Payment Method<sup class="text-danger fw-bold">*</sup></label>
                        <select class="select2 form-control" name="payment_method">
                            <option value="">Select an Option</option>
                            @foreach($payments as $payment)
                            <option value="{{ $payment->payment_id }}">{{ $payment->payment_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('payment_method')
                            {{$message}}
                            @enderror
                        </span>
                    </div>


                    <div class="col-sm-4">
                        <label>Transaction ID/Cash Identifier</label>
                        <input class="w3-input w3-border w3-round" name="cash_identifier" type="text"
                            placeholder="Cash Identifier">
                        <span class="text-danger">
                            @error('cash_identifier')
                            {{$message}}
                            @enderror
                        </span>
                    </div>

                    <div class="col-sm-4">
                        <label>Sender/Receiver ID</label>
                        <input class="w3-input w3-border w3-round" name="sender_receiver_id" type="text"
                            placeholder="Sender $CashTag">
                        <span class="text-danger">
                            @error('sender_receiver_id')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Note<sup class="text-danger fw-bold">*</sup></label>
                        <input class="w3-input w3-border w3-round" name="note" type="text" placeholder="Short Note">
                        <span class="text-danger">
                            @error('note')
                            {{$message}}
                            @enderror
                        </span>
                    </div>

                    <div class="col-sm-4">
                        <label><i class="bi bi-cash"></i> Cash<sup class="text-danger fw-bold">*</sup></label>
                        <input class="w3-input w3-border w3-round" name="cash" type="text" placeholder="Short Note">
                        <span class="text-danger">
                            @error('cash')
                            {{$message}}
                            @enderror
                        </span>
                    </div>

                    <div class="col-sm-4">
                        <label><i class="bi bi-currency-dollar"></i> Credit<sup
                                class="text-danger fw-bold">*</sup></label>
                        <input class="w3-input w3-border w3-round" name="credit" type="text" placeholder="Short Note">
                        <span class="text-danger">
                            @error('credit')
                            {{$message}}
                            @enderror
                        </span>
                    </div>


                </div>

                <br>
                <div class="row">
                    <div class="col-sm-4">
                        <label> Room<sup class="text-danger fw-bold">*</sup></label>
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
                    <div class="col-sm-4">
                        <!-- Column 2 content -->
                    </div>
                    <div class="col-sm-4">
                        <!-- Column 3 content -->
                    </div>
                </div>


                <br> <br>

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
        </script>



    </div>
</div>
</div>

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

<style>
.select2-container .select2-selection--single {
    height: calc(2.25rem + 2px) !important;

}
</style>


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
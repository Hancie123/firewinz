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
                                @foreach ($access_controls2 as $data)

                                <input type="hidden" value="{{$data->room_id}}" name="room_id" type="text">
                                @break
                                @endforeach

                                <br>

                                <button type="submit" class="btn btn-primary mb-2">Create</button><br>
                            </form>




                        </div>


                    </div>
                </div>
            </div>
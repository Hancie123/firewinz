<form  method="post" action="{{url('/admin/transactions/create')}}" class="mt-4">
              @csrf

                <input type="hidden" value="{{Session::get('User_ID')}}" name="User_ID" type="text">
                <input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="date" type="text">



                <div class="row">
                    <div wire:ignore class="col-sm-4">
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


                    <div wire:ignore class="col-sm-4">
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


                    <div wire:ignore class="col-sm-4">
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
                    <div wire:ignore class="col-sm-4">
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
                        <input class="w3-input w3-border w3-round" wire:model="cash_identifier" name="cash_identifier" type="text"
                            placeholder="Cash Identifier">
                        <span class="text-danger">
                            @error('cash_identifier')
                            {{$message}}
                            @enderror
                        </span>
                    </div>

                    <div wire:ignore class="col-sm-4">
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
                    <div wire:ignore class="col-sm-4">
                        <label>Note<sup class="text-danger fw-bold">*</sup></label>
                        <input class="w3-input w3-border w3-round" name="note" type="text" placeholder="Short Note">
                        <span class="text-danger">
                            @error('note')
                            {{$message}}
                            @enderror
                        </span>
                    </div>

                    <div wire:ignore class="col-sm-4">
                        <label><i class="bi bi-cash"></i> Cash<sup class="text-danger fw-bold">*</sup></label>
                        <input class="w3-input w3-border w3-round" name="cash" type="text" placeholder="Short Note">
                        <span class="text-danger">
                            @error('cash')
                            {{$message}}
                            @enderror
                        </span>
                    </div>

                    <div wire:ignore class="col-sm-4">
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



                @foreach ($access_controls2 as $data)

                <input type="hidden" value="{{$data->room_id}}" name="room_id" type="text">
                @break
                @endforeach





                <br> <br>

                <button type="submit" class="btn btn-primary mb-2">Create</button><br>
            </form>
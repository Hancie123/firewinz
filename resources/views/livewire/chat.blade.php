<div wire:poll.1000ms="chatdata" class="container border p-3 overflow-auto" style="height:55vh;">

                @foreach($chat as $data)

                @php
                $i = Session::get('User_ID');

                @endphp
                @if($data->User_ID ==$i)
                <div class="p-2 w3-right-align">
                    <label alt="Profile" class="rounded bg-primary py-2 px-2 text-white h5">
                        <?php     $name = $data->name; 
                        $name_parts = explode(' ', $name);
                        $first_name = $name_parts[0];  
                        echo $first_name; 
                        ?>
                    </label>

                    <label class="p-2 w3-round" id="message720">{{$data->message}}</label><br>
                    <label>{{$data['created_at']->diffForHumans()}}</label>

                </div><br>

                @else

                <div class="p-2 w3-left-align">
                    <label alt="Profile" class="rounded bg-primary py-2 px-2 text-white h5">
                        <?php     $name = $data->name; 
                        $name_parts = explode(' ', $name);
                        $first_name = $name_parts[0];  
                        echo $first_name; 
                        ?>
                    </label>

                    <label class="p-2 w3-round" id="message720">{{$data->message}}</label><br>
                    <label>{{$data['created_at']->diffForHumans()}}</label>

                </div><br>

                @endif

                @endforeach

</div>

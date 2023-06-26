@include('layouts.adminnav')
@push('title')
<title>Fire Winz | Make Announcement</title>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<script src="https://cdn.ckeditor.com/4.16.2/full-all/ckeditor.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>


<div class="main-panel">
    <div class="content-wrapper">
        <h3><b>Make Announcement</b></h3><br>



        <div class="container border p-4 w3-round">

            @if($countannouncement>=1)

            <form action="{{url('/home/dashboard/insertannouncement')}}" method="post">

                @csrf

                <div class="w3-panel w3-pale-blue w3-leftbar w3-rightbar w3-border-amber">
                    <p>To make a new announcement, you should first remove the existing one.</p>
                </div>


                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr class="3-centerw border">
                            <th>Title</th>
                            <th>Announcement</th>
                            <th>Action</th>
                        </tr>
                        @foreach($announceall as $data)
                        <tr>
                            <td>{{$data->title}}</td>
                            <td>{!!$data->announcement!!}</td>

                            <td><a href="{{url('/admin/announcement/delete')}}/{{$data->announcement_id}}">
                                    <i class='bx bx-trash bx-md'></i>
                                </a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </form>
            <style>
            .table td {
                white-space: normal;
                word-wrap: break-word;
            }
            </style>

            @else
            <form method="post" action="{{url('/admin/announcement/create')}}">


                @if(Session::has('success'))
                <script>
                toastr.success("{{Session::get('success')}}")
                </script>
                @endif
                @if(Session::has('fail'))
                <script>
                toastr.warning("{{Session::get('fail')}}")
                </script>
                @endif
                @csrf
                <input type="hidden" value="{{Session::get('User_ID')}}" name="User_ID" type="text">

                <div class="row">

                    <div class="col">
                        <label>Title</label>
                        <input class="w3-input w3-border w3-round" name="title" type="text">
                        <span class="text-danger">
                            @error('title')
                            {{$message}}
                            </script>
                            @enderror
                        </span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <textarea class="w3-input" name="announcement" id="editor" rows="18" cols="50"></textarea>
                        <span class="text-danger">
                            @error('announcement')
                            {{$message}}
                            </script>
                            @enderror
                        </span>
                    </div>
                </div>

                <br>
                <button type="submit" class="btn btn-primary mb-2">Make Announcement</button><br>

            </form>
            @endif



        </div>



        <script>
        CKEDITOR.replace('editor');
        </script>


    </div>
</div>
</div>








</body>

</html>
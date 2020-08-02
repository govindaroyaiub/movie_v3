@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Showtime List for: <label style="color: red;">{{ $md['movie_title'] }}</label>
                <a href="" style="position:absolute; text-decoration: underline; right:2%;" data-toggle="modal"
                        data-target="#date_modal">Update Date Altogether +</a>
                </div>
                <div class="card-body">
                    @include('alert')
                    <div class="table-responsive">
                        <table id="showtime_list" class="table-bordered" width="100%" cellspacing="0">
                            <thead style="text-align:center;">
                                <tr>
                                    <th>#</th>
                                    <th>Theatre</th>
                                    <th>URL</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody style="text-align:center;">
                                <?php $i = 1; ?>
                                @foreach($ms as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->name}} <hr>{{$row->address}}, {{$row->zip}}, {{$row->city}} <br> <b>Phone:</b> {{$row->phone}}</td>
                                    <td style="width:90px;"><a href="https://{{$row->url}}" target="_blank">{{$row->url}}</a></td>
                                    <td style="width:120px;"><b>Start Date:</b><br>{{$row->date}}
                                    <hr>
                                    @if($row->end_date == NULL)
                                    <b style="color:red">No End Date!</b>
                                    @else
                                    <b>End Date:</b><br>{{$row->end_date}}
                                    @endif
                                    </td>
                                    <td>
                                        <a href="/showtimes/edit/{{$row->id}}"><button class="btn btn-primary text-white custom">Edit</button></a><br>
                                        <a href="/showtimes/delete/{{$row->id}}"><button class="btn btn-danger text-white custom">Delete</button></a><br>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="date_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Showtimes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/showtimes/update/{{$id}}">
                    {{ csrf_field() }}
                    <div class="row">
                            <div class="col">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" required>
                            </div>
                            <div class="col">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" required>
                            </div>
                        </div>
                    <br>
                    <div class="modal-footer">
                        <button type="submit" class="form-control-user btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

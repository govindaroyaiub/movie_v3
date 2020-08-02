@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>Showtime List for: <label style="color: red;">{{ $md['movie_title'] }}</label></h2>
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
@endsection

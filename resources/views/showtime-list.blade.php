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
                                    <th>Address & Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody style="text-align:center;">
                                <?php $i = 1; ?>
                                @foreach($ms as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->name}}</td>
                                    <td style="width:90px;"><a href="{{$row->url}}" target="_blank">{{$row->url}}</a></td>
                                    <td style="width:120px;"><b>Start Date:</b><br>{{$row->date}}<hr><b>End Date:</b><br>{{$row->date}}</td>
                                    <td>{{$row->address}}, {{$row->zip}}, {{$row->city}} <hr> <b>Phone:</b> {{$row->phone}}</td>
                                    <td>
                                        
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

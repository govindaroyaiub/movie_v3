@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Showtime List for: <label style="color: red;">{{ $md['movie_title'] }}</label>
                    <a href="" style="position:absolute; text-decoration: underline; right:12%;" data-toggle="modal"
                        data-target="#date_modal">Update Date Altogether +</a>
                    <label style="position:absolute; right:11%;">/</label>
                    <a href="" style="position:absolute; text-decoration: underline; right:2%;" data-toggle="modal"
                        data-target="#add_theatre_modal">Add Theatre +</a>
                </div>
                <div class="card-body">
                    @include('alert')
                    <div class="table-responsive">
                        <table id="datatable" class="table-bordered" width="100%" cellspacing="0">
                            <thead style="text-align:center;">
                                <tr>
                                    <th>#</th>
                                    <th>Theatre</th>
                                    <th>Area</th>
                                    <th>URL</th>
                                    <th>Start Date</th>
                                    <th>Activity</th>
                                    <th>2D</th>
                                    <th>3D</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody style="text-align:center;">
                                <?php $i = 1; ?>
                                @foreach($ms as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                        {{$row->name}}
                                        <hr>
                                        {{$row->address}}, {{$row->zip}} <br> <b>Phone:</b> <br> {{$row->phone}}
                                    </td>
                                    <td>{{$row->city}} <br> <b>{{$row->country}}</b>
                                    </td>
                                    <td><a href="{{$row->url}}" target="_blank"
                                            style="line-break: anywhere;">{{$row->url}}</a></td>
                                    <td>
                                        @if($row->date == date('1971-01-01'))
                                        <label style="color: red;">Date Unknown</label>
                                        @else
                                        {{$row->date}}
                                        @endif
                                    </td>
                                    <td>
                                        <input type="checkbox" class="switch" id="{{ $row->id }}" @if($row->is_active ==
                                        1) checked @else ' ' @endif data-toggle="toggle" data-onstyle="primary"
                                        data-offstyle="secondary">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="2d_switch" id="{{ $row->id }}" @if($row->two_d ==
                                        1) checked @else ' ' @endif data-toggle="toggle" data-onstyle="primary"
                                        data-offstyle="secondary">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="3d_switch" id="{{ $row->id }}" @if($row->three_d
                                        ==
                                        1) checked @else ' ' @endif data-toggle="toggle" data-onstyle="primary"
                                        data-offstyle="secondary">
                                    </td>
                                    <td>
                                        <a href="/showtimes/edit/{{$row->id}}"><button
                                                class="btn btn-primary text-white custom">Edit</button></a><br>
                                        <a href="/showtimes/delete/{{$row->id}}"
                                            onclick="return confirm('Are sure want to delete this showtime?');"><button
                                                class="btn btn-danger text-white custom">Delete</button></a><br>
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
                    <b style="color: red">Use this method to update all the showtimes listed on the table by one single
                        submit</b>
                    <hr>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" required>
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
<div class="modal fade" id="add_theatre_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Theatre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/showtimes/add/{{$id}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="theatre_id">Country List</label>
                        <select class="form-control select2" id="country_id" name="country_id" style="width: 100%;"
                            required>
                            <option value="">Select Country</option>
                            <option value="Netherlands" selected>Netherlands</option>
                            <option value="Belgium">Belgium</option>
                            <option value="all">All Theaters</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="theatre_id">Theatre List</label>
                        <select class="form-control select2" id="theatre_id[]" name="theatre_id" style="width: 100%;"
                            required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="url">Theatre URL</label>
                        <input type="text" class="form-control" name="url" id="theatre_url" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="start_date">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="is_active">Is Active?</label>
                        <select class="form-control select2" id="is_active" name="is_active" style="width: 100%;"
                            required>
                            <option value="">Select Option</option>
                            <option value="1" selected>Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="two_d">Is 2D?</label>
                        <select class="form-control select2" id="two_d" name="two_d" style="width: 100%;"
                            required>
                            <option value="">Select Option</option>
                            <option value="1" selected>Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="three_d">Is 3D?</label>
                        <select class="form-control select2" id="three_d" name="three_d" style="width: 100%;"
                            required>
                            <option value="">Select Option</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="form-control-user btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

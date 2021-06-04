@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Reviews of <b style="color:red">{{$movie_details['movie_title']}}</b> <a href="" style="position:absolute; text-decoration: underline; right:2%;" data-toggle="modal" data-target="#create_user_modal">Create Review +</a></div>

                <div class="card-body">
                    @include('alert')
                    <div class="table-responsive">
                        <table id="datatable" class="table-bordered" width="100%" cellspacing="0">
                            <thead style="text-align:center;">
                                <tr>
                                    <th>#</th>
                                    <th>Review</th>
                                    <th>Source</th>
                                    <th>Source Link</th>
                                    <th>Lanuage</th>
                                    <th>Ratings</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>

                            <tbody style="text-align:center;">
                                <?php $i = 1; ?>
                                @foreach($reviews as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->review_text}}</td>
                                    <td><b>{{$row->source}}</b></td>
                                    <td><a href="{{$row->source_link}}" target="_blank">{{$row->source_link}}</a></td>
                                    <td>
                                    @if($row->language == 'nl') 
                                    <b>NL</b>
                                    @else
                                    <b>EN</b>
                                    @endif
                                    </td>
                                    <td>
                                    @if($row->ratings == 0)
                                    <b style="color:green;">None</b>
                                    @else
                                    {{$row->ratings}}
                                    @endif
                                    </td>
                                    <td>
                                        <a href="/reviews/edit/{{$row->id}}"><button class="btn btn-primary text-white custom">Edit</button></a>
                                        <a href="/reviews/delete/{{$row->id}}" onclick="return confirm('Are sure want to delete this review?');"><button class="btn btn-danger text-white custom">Delete</button></a>
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
<div class="modal fade" id="create_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Review</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/reviews/create/{{$id}}" autocomplete="off">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Enter Review for movie: {{$movie_details['movie_title']}}</label>
                            </div>
                            <div class="form-group">
                                <label for="review_text">Review <b style="color:red;">(No need for: " ")</b></label>
                                <textarea rows="4" cols="50" class="form-control" name="review_text" id="review_text" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="source">Source</label>
                                <input type="text" class="form-control" name="source" id="source" required>
                            </div>
                            <div class="form-group">
                                <label for="source_link">Source Link</label>
                                <input type="text" class="form-control" name="source_link" id="source_link">
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="rating" required>
                                    <option value="">Select Ratings</option>
                                    <option value="3">3</option>
                                    <option value="3.5">3.5</option>
                                    <option value="4">4</option>
                                    <option value="4.5">4.5</option>
                                    <option value="5">5</option>
                                    <option value="0">None</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="language" required>
                                    <option value="">Select Language</option>
                                    <option value="nl">NL</option>
                                    <option value="en">EN</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="form-control-user btn btn-primary">Create</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

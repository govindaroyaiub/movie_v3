@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Reviews <a href="" style="position:absolute; text-decoration: underline; right:2%;" data-toggle="modal" data-target="#create_user_modal">Create Review +</a></div>

                <div class="card-body">
                    @include('alert')
                    <div class="table-responsive">
                        <table id="reviews_list" class="table-bordered" width="100%" cellspacing="0">
                            <thead style="text-align:center;">
                                <tr>
                                    <th>#</th>
                                    <th>Movie</th>
                                    <th>NL Review</th>
                                    <th>EN Review</th>
                                    <th>Source</th>
                                    <th>Date</th>
                                    <th>Ratings</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>

                            <tbody style="text-align:center;">
                                <?php $i = 1; ?>
                                @foreach($reviews as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$row->movie_title}}</td>
                                    <td>{{$row->review_en}}</td>
                                    <td>{{$row->review_nl}}</td>
                                    <td>{{$row->source}}</td>
                                    <td>{{$row->date}}</td>
                                    <td>{{$row->ratings}}</td>
                                    <td>
                                        <a href="/reviews/edit/{{$row->id}}"><button class="btn btn-primary text-white custom">Edit</button></a>
                                        <a href="/reviews/delete/{{$row->id}}"><button class="btn btn-danger text-white custom">Delete</button></a>
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
                        <form method="post" action="/reviews/create">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Select movie from the drop down list</label>
                                <select class="form-control select2" id="movie_id" name="movie_id" style="width: 100%;" required>
                                    <option value="">Select Movie</option>
                                    @foreach($movie_list as $row)
                                    <option value="{{$row->id}}">{{$row->movie_title}} ({{$row->base_url}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="review_nl">Review (NL)</label>
                                <input type="text" class="form-control" name="review_nl" id="review_nl" required>
                            </div>
                            <div class="form-group">
                                <label for="review_en">Review (EN)</label>
                                <input type="text" class="form-control" name="review_en" id="review_en" required>
                            </div>
                            <div class="form-group">
                                <label for="source">Source</label>
                                <input type="text" class="form-control" name="source" id="source" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" name="date" id="date" required>
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

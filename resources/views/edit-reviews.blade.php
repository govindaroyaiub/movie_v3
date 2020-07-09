@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Review: {{ $review_details['movie_title'] }}</div>

                <div class="card-body">
                    @include('alert')

                    <form method="post" action="/reviews/edit/{{$id}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Select movie from the drop down list</label>
                                <select class="form-control select2" id="movie_id" name="movie_id" style="width: 100%;" required>
                                    <option value="">Select Movie</option>
                                    @foreach($movie_list as $row)
                                    <option value="{{$row->id}}" @if($row->id == $review_details['movie_id']) selected @endif)>{{$row->movie_title}} ({{$row->base_url}})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="review_nl">Review (NL)</label>
                                <input type="text" class="form-control" name="review_nl" value="{{ $review_details['review_nl'] }}" id="review_nl" required>
                            </div>
                            <div class="form-group">
                                <label for="review_en">Review (EN)</label>
                                <input type="text" class="form-control" name="review_en" value="{{ $review_details['review_en'] }}" id="review_en" required>
                            </div>
                            <div class="form-group">
                                <label for="source">Source</label>
                                <input type="text" class="form-control" name="source" value="{{ $review_details['source'] }}" id="source" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" name="date" value="{{ $review_details['date'] }}" id="date" required>
                            </div>
                            <div class="form-group">
                            <select class="form-control" name="rating" required>
                                <option value="">Select Ratings</option>
                                <option value="3" @if($review_details['ratings'] == 3) selected @endif)>3</option>
                                <option value="3.5" @if($review_details['ratings'] == 3.5) selected @endif)>3.5</option>
                                <option value="4" @if($review_details['ratings'] == 4) selected @endif)>4</option>
                                <option value="4.5" @if($review_details['ratings'] == 4.5)  selected @endif)>4.5</option>
                                <option value="5" @if($review_details['ratings'] == 5) selected @endif)>5</option>
                                <option value="0" @if($review_details['ratings'] == 0) selected @endif)>None</option>
                            </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="form-control-user btn btn-primary">Update</button>
                                <a href="/reviews"><button type="button" class="btn btn-secondary">Back</button></a>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

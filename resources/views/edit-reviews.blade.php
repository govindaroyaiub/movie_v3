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
                                <label for="review_text">Review</label>
                                <input type="text" class="form-control" name="review_text" value="{{$review_details['review_text']}}" id="review_text" required>
                            </div>
                            <div class="form-group">
                                <label for="source">Source</label>
                                <input type="text" class="form-control" name="source" value="{{$review_details['source']}}" id="source" required>
                            </div>
                            <div class="form-group">
                                <label for="source_link">Source Link</label>
                                <input type="text" class="form-control" name="source_link" value="{{$review_details['source_link']}}" id="source_link">
                            </div>
                            <div class="form-group">
                            <select class="form-control" name="rating" required>
                                <option value="">Select Ratings</option>
                                <option value="3" @if($review_details['ratings'] == 3) selected @endif>3</option>
                                <option value="3.5" @if($review_details['ratings'] == 3.5) selected @endif>3.5</option>
                                <option value="4" @if($review_details['ratings'] == 4) selected @endif>4</option>
                                <option value="4.5" @if($review_details['ratings'] == 4.5)  selected @endif>4.5</option>
                                <option value="5" @if($review_details['ratings'] == 5) selected @endif>5</option>
                                <option value="0" @if($review_details['ratings'] == 0) selected @endif>None</option>
                            </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="language" required>
                                    <option value="">Select Language</option>
                                    <option value="nl" @if($review_details['language'] == 'nl') selected @endif>NL</option>
                                    <option value="en" @if($review_details['language'] == 'en') selected @endif>EN</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="form-control-user btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Back</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

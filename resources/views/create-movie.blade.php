@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Movie Create Page</div>

                <div class="card-body">
                    <form method="post" action="/movielist/create">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="movie_title">Movie Title</label>
                            <input type="text" class="form-control" name="movie_title" id="movie_title" required>
                        </div>
                        <div class="form-group">
                            <label for="director">Director</label>
                            <input type="text" class="form-control" name="director" id="director" required>
                        </div>
                        <div class="form-group">
                            <label for="actors">Actors</label>
                            <input type="text" class="form-control" name="actors" id="actors">
                        </div>
                        <div class="form-group">
                            <label for="writer">Writer</label>
                            <input type="text" class="form-control" name="writer" id="writer">
                        </div>
                        <div class="form-group">
                            <label for="producer">Producer</label>
                            <input type="text" class="form-control" name="producer" id="producer">
                        </div>
                        <div class="form-group">
                            <label for="base_url">Base URL</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" value="https://movie.planetnine.com/"
                                        style="width:120%;" readonly>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="base_url" id="base_url" required>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="google_sheet">Google Sheet URL</label>
                            <input type="text" class="form-control" name="google_sheet" id="google_sheet" required>
                        </div> --}}

                        <div class="form-group">
                            <label for="release_date">Release Date</label>
                            <input type="date" class="form-control" name="release_date" id="release_date" required>
                        </div>
    
                        <div class="form-group">
                            <label for="google_sheet">Select Client</label>
                            <select class="form-control select2" id="client_id" name="client_id" style="width: 100%;"
                                required>
                                <option value="">Select Client</option>
                                @foreach($user_list as $row)
                                <option value="{{$row->id}}" @if($row->id == 2) selected @endif>{{$row->name}} ({{$row->email}})</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="row">
                            <div class="col">
                                <label for="d_id">Distributor</label>
                                <select class="form-control select2" id="d_id" name="d_id" style="width: 100%;" required>
                                    <option value="">Select Distributor</option>
                                    <option value="0">None</option>
                                    @foreach($d_list as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="mp_id">Media Partner</label>
                                <select class="form-control select2" id="mp_id" name="mp_id" style="width: 100%;" required>
                                    <option value="">Select Movie Partner</option>
                                    <option value="0">None</option>
                                    @foreach($mp_list as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
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

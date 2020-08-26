@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Showtime for: <b>{{ $ms['name'] }}</b></div>

                <div class="card-body">
                    @include('alert')

                    <form method="post" action="/showtimes/edit/{{$id}}">
                            {{ csrf_field() }}
                        
                            <div class="form-group">
                                <label for="url">URL <b style="color:red;">(wihtout http/https)</b></label>
                                <input type="text" class="form-control" name="url" value="{{ $ms['url'] }}" id="url" required>
                            </div>

                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" name="start_date" value="{{ $ms['date'] }}" id="url" required>
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

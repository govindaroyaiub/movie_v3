@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @include('alert')

                    <form method="post" action="/upload/{{$id}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <h2>Upload showtimes for movie: {{$movie_details['movie_title']}}</h2l>
                        </div>
                        <div id="infos">
                            <label>&#8226; Please use the Google Sheet from <a href="{{$movie_details['google_sheet']}}" target="_blank">here.</a></label>
                            <br>
                            <label>&#8226; Download the sheet as Xlsx format and upload.</label>
                            <br>
                            <label style="color: red; text-decoration:underline;">&#8226; Please do not delete the previous data from the sheet!!.</label>
                            <br>
                        </div>
                        <hr>
                        <div class="form-group">
                            <input type="file" name="file" required>
                        </div>
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-primary text-white">Upload file</button>
                            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

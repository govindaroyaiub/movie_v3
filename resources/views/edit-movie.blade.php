@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Movie: {{ $movie_details['movie_title'] }}</div>

                <div class="card-body">
                    @include('alert')

                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        The Major Details
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <form method="post" action="/movielist/edit/tmd/{{$id}}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="movie_title">Title</label>
                                            <input type="text" class="form-control" name="movie_title" id="movie_title"
                                                value="{{ $movie_details['movie_title'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="director">Director</label>
                                            <input type="text" class="form-control" name="director" id="director"
                                                value="{{ $movie_details['director'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="producer">Producer</label>
                                            <input type="text" class="form-control" name="producer" id="producer"
                                                value="{{ $movie_details['producer'] }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="writer">Writer</label>
                                            <input type="text" class="form-control" name="writer" id="writer"
                                                value="{{ $movie_details['writer'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="actors">Actors</label>
                                            <input type="text" class="form-control" name="actors" id="actors"
                                                value="{{ $movie_details['actors'] }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="youtube_url">Youtube URL</label>
                                            <input type="text" class="form-control" name="youtube_url" id="youtube_url"
                                                value="{{ $movie_details['youtube_url'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="duration">Duration</label>
                                            <input type="text" class="form-control" name="duration" id="duration"
                                                value="{{ $movie_details['duration'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="base_url">Base URL</label>
                                            <input type="text" class="form-control" name="base_url" id="base_url"
                                                value="{{ $movie_details['base_url'] }}" required readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="image1">Poster URL</label>
                                            <input type="text" class="form-control" name="image1" id="image1"
                                                value="{{ $movie_details['image1'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="fb_link">Facebook Link</label>
                                            <input type="text" class="form-control" name="fb_link" id="fb_link"
                                                value="{{ $movie_details['fb_link'] }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="twitter_link">Twitter Link</label>
                                            <input type="text" class="form-control" name="twitter_link"
                                                id="twitter_link" value="{{ $movie_details['twitter_link'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="hashtag">Hashtag</label>
                                            <input type="text" class="form-control" name="hashtag" id="hashtag"
                                                value="{{ $movie_details['hashtag'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="fb_pixel">Facebook Pixel</label>
                                            <textarea name="fb_pixel" id="fb_pixel" class="form-control" rows="6"
                                                cols="50">{{ $movie_details['fb_pixel'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="google_pixel">Google Pixel</label>
                                            <textarea name="google_pixel" id="google_pixel" class="form-control"
                                                rows="6" cols="50">{{ $movie_details['google_pixel'] }}</textarea>
                                        </div>

                                        <br>

                                        <div class="row">
                                            <div class="col">
                                                <label for="d_id">Distributor</label>
                                                <select class="form-control select2" id="d_id" name="d_id"
                                                    style="width: 100%;" required>
                                                    <option value="">Select Distributor</option>
                                                    <option value="0" @if($movie_details['d_id']==0) selected @endif>
                                                        None</option>
                                                    @foreach($d_list as $row)
                                                    <option value="{{$row->id}}" @if($row->id == $movie_details['d_id'])
                                                        selected @endif>{{$row->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="mp_id">Media Partner</label>
                                                <select class="form-control select2" id="mp_id" name="mp_id"
                                                    style="width: 100%;" required>
                                                    <option value="">Select Movie Partner</option>
                                                    <option value="0" @if($movie_details['mp_id']==0) selected @endif>
                                                        None</option>
                                                    @foreach($mp_list as $row)
                                                    <option value="{{$row->id}}" @if($row->id ==
                                                        $movie_details['mp_id']) selected @endif>{{$row->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <label for="primary_light">Color: Border Around City</label>
                                                <input type="color" class="form-control"
                                                    value="{{ $movie_details['primary_light'] }}" name="primary_light"
                                                    id="primary_light" required>
                                            </div>
                                            <div class="col">
                                                <label for="primary_dark">Color: HASHTAG and Submit Button</label>
                                                <input type="color" class="form-control"
                                                    value="{{ $movie_details['primary_dark'] }}" name="primary_dark"
                                                    id="primary_dark" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <label for="secondary_light">Color: Movie-header, City BG, Review
                                                    Area</label>
                                                <input type="color" class="form-control"
                                                    value="{{ $movie_details['secondary_light'] }}"
                                                    name="secondary_light" id="secondary_light" required>
                                            </div>
                                            <div class="col">
                                                <label for="secondary_dark">Movie Content (dont touch if
                                                    possible)</label>
                                                <input type="color" class="form-control"
                                                    value="{{ $movie_details['secondary_dark'] }}" name="secondary_dark"
                                                    id="secondary_dark" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="form-control-user btn btn-primary">Update</button>
                                            <a href="/movielist"><button type="button"
                                                    class="btn btn-secondary">Back</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Dutch Contents
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <form method="post" action="/movielist/edit/nl/{{$id}}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="tagline_nl">Tagline</label>
                                            <textarea class="form-control" name="tagline_nl" id="tagline_nl"
                                                maxlength="500" rows="6" cols="50">{{ $movie_details['tagline_nl'] }}
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="movie_description_short_nl">Movie Description Short</label>
                                            <textarea class="form-control" name="movie_description_short_nl"
                                                id="movie_description_short_nl" maxlength="500" rows="6" cols="50">{{ $movie_details['movie_description_short_nl'] }}
                                            </textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="movie_description_long_nl">Movie Description Long</label>
                                            <textarea name="movie_description_long_nl" id="movie_description_long_nl"
                                                class="form-control" rows="20" cols="50">{{ $movie_details['movie_description_long_nl'] }}
                                            </textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="buy_tickets_nl">Buy Tickets Text</label>
                                            <input type="text" class="form-control" name="buy_tickets_nl"
                                                id="buy_tickets_nl" value="{{ $movie_details['buy_tickets_nl'] }}"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label for="cookies_nl">Cookies</label>
                                            <textarea name="cookies_nl" id="cookies_nl" class="form-control" rows="6"
                                                cols="50">{{ $movie_details['cookies_nl'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="terms_of_use_nl">Terms Of Use</label>
                                            <textarea name="terms_of_use_nl" id="terms_of_use_nl" class="form-control"
                                                rows="6" cols="50">{{ $movie_details['terms_of_use_nl'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="privacy_policy_nl">Privacy Policy</label>
                                            <textarea name="privacy_policy_nl" id="privacy_policy_nl"
                                                class="form-control" rows="6"
                                                cols="50">{{ $movie_details['privacy_policy_nl'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="credits_nl">Credits</label>
                                            <textarea name="credits_nl" id="credits_nl" class="form-control" rows="6"
                                                cols="50">{{ $movie_details['credits_nl'] }}</textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="form-control-user btn btn-primary">Update</button>
                                            <a href="/movielist"><button type="button"
                                                    class="btn btn-secondary">Back</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        English Contents
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <form method="post" action="/movielist/edit/en/{{$id}}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="tagline_en">Tagline</label>
                                            <textarea class="form-control" name="tagline_en" id="tagline_en"
                                                maxlength="500" rows="6" cols="50">{{ $movie_details['tagline_en'] }}
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="movie_description_short">Movie Description Short</label>
                                            <textarea class="form-control" name="movie_description_short"
                                                id="movie_description_short" maxlength="500" rows="6" cols="50">{{ $movie_details['movie_description_short'] }}
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="movie_description_long">Movie Description Long</label>
                                            <textarea name="movie_description_long" id="movie_description_long"
                                                class="form-control" rows="20"
                                                cols="50">{{ $movie_details['movie_description_long'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="buy_tickets">Buy Tickets Text</label>
                                            <input type="text" class="form-control" name="buy_tickets" id="buy_tickets"
                                                value="{{ $movie_details['buy_tickets'] }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="cookies_en">Cookies</label>
                                            <textarea name="cookies_en" id="cookies_en" class="form-control" rows="6"
                                                cols="50">{{ $movie_details['cookies'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="terms_of_use">Terms Of Use</label>
                                            <textarea name="terms_of_use" id="terms_of_use" class="form-control"
                                                rows="6" cols="50">{{ $movie_details['terms_of_use'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="privacy_policy">Privacy Policy</label>
                                            <textarea name="privacy_policy" id="privacy_policy" class="form-control"
                                                rows="6" cols="50">{{ $movie_details['privacy_policy'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="credits">Credits</label>
                                            <textarea name="credits" id="credits" class="form-control" rows="6"
                                                cols="50">{{ $movie_details['credits'] }}</textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="form-control-user btn btn-primary">Update</button>
                                            <a href="/movielist"><button type="button"
                                                    class="btn btn-secondary">Back</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        @if($movie_details['id'] == 8)
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        French Contents
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <form method="post" action="/movielist/edit/fr/{{$id}}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="tagline_fr">Tagline</label>
                                            <textarea class="form-control" name="tagline_fr" id="tagline_fr"
                                                maxlength="500" rows="6" cols="50" required>{{ $movie_details['tagline_fr'] }}
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="movie_description_short_fr">Movie Description Short</label>
                                            <textarea class="form-control" name="movie_description_short_fr"
                                                id="movie_description_short_fr" maxlength="500" rows="6" cols="50"
                                                required>{{ $movie_details['movie_description_short_fr'] }}
                                            </textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="movie_description_long_fr">Movie Description Long</label>
                                            <textarea name="movie_description_long_fr" id="movie_description_long_fr"
                                                class="form-control" rows="20" cols="50">{{ $movie_details['movie_description_long_fr'] }}
                                            </textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="buy_tickets_fr">Buy Tickets Text</label>
                                            <input type="text" class="form-control" name="buy_tickets_fr"
                                                id="buy_tickets_fr" value="{{ $movie_details['buy_tickets_fr'] }}"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label for="cookies_fr">Cookies</label>
                                            <textarea name="cookies_fr" id="cookies_fr" class="form-control" rows="6"
                                                cols="50">{{ $movie_details['cookies_fr'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="terms_of_use_fr">Terms Of Use</label>
                                            <textarea name="terms_of_use_fr" id="terms_of_use_fr" class="form-control"
                                                rows="6" cols="50">{{ $movie_details['terms_of_use_fr'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="privacy_policy_fr">Privacy Policy</label>
                                            <textarea name="privacy_policy_fr" id="privacy_policy_fr"
                                                class="form-control" rows="6"
                                                cols="50">{{ $movie_details['privacy_policy_fr'] }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="credits_fr">Credits</label>
                                            <textarea name="credits_fr" id="credits_fr" class="form-control" rows="6"
                                                cols="50">{{ $movie_details['credits_fr'] }}</textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="form-control-user btn btn-primary">Update</button>
                                            <a href="/movielist"><button type="button"
                                                    class="btn btn-secondary">Back</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

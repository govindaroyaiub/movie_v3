@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">User Manual</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="manual_list" class="table-bordered" width="100%" cellspacing="0">
                            <thead style="text-align:center;">
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Little Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align:center;">
                                <tr>
                                    <td>1</td>
                                    <td>Movies</td>
                                    <td>Manual on creating/updating movies.</td>
                                    <td><button class="btn btn-primary text-white custom" data-toggle="modal"
                                            data-target="#create_movies">View</button></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Showtimes</td>
                                    <td>Manual on uploading/updating showtimes.</td>
                                    <td><button class="btn btn-primary text-white custom" data-toggle="modal"
                                            data-target="#showtimes">View</button></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Reviews</td>
                                    <td>Update on how to create and update reviews.</td>
                                    <td><button class="btn btn-primary text-white custom" data-toggle="modal"
                                            data-target="#reviews">View</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade bd-example-modal-lg" id="create_movies" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Movies</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="headline_text">Create Movies</h3>
                <div class="form-group">
                    <label for="movies">Creating Movies is very easy. At <a href="/home">Home</a> page, click on the top
                        right of the movies table. A modal will show. Fill it out with the correct info. And hit the <b
                            style="color:red;">"Create"</b> button!</label>
                    <img src="{{ asset('user_manual/create_movies.png') }}" class="center" style="width:90%;"></img>
                    <label class="center_text">Button For Creating Movies</label>
                    <br>
                    <img src="{{ asset('user_manual/create_movies_modal.png') }}" class="center"
                        style="width:25%; height: 50%;">
                    <label class="center_text">Create Movies Modal View</label>
                </div>
                <hr>
                <h3 class="headline_text">Edit Movies</h3>
                <div class="form-group">
                    <label for="movies">To Edit a Movie click the <b style="color: red;">"Edit"</b> button in the movies
                        which is on the right side.</label>
                    <img src="{{ asset('user_manual/edit_movies.png') }}" class="center" style="width:90%;"></img>
                    <label class="center_text">Button to a Edit Movie</label>
                    <br>
                    <label for="movies">If clicked, a page will show with 3 tabs: The Major Details, EN Version and NL
                        Version. By clicking the tabs, the blanked fields must be filled out.</label>
                    <img src="{{ asset('user_manual/edit_movies_page.png') }}" class="center" style="width:90%;"></img>
                    <br>
                    <b>Here is the most important part of Editing a movie: The youtube URL is the trickiest one. Follow
                        the instruction below what needs to be set for the youtube URL.</b>
                    <img src="{{ asset('user_manual/wrong_youtube.png') }}" class="center" style="width:90%;">
                    <label class="center_text">Wrong Youtube URL Format</label>
                    <img src="{{ asset('user_manual/right_youtube.png') }}" class="center" style="width:90%;">
                    <label class="center_text">Right Youtube URL Format</label>
                    <br>
                    <b>Explanation: Let's say,</b>
                    <br>
                    <b style="color:red; text-decoration: underline;">Wrong youtube url is:</b><b>
                        https://www.youtube.com/watch?v=7mo4COng7Sg</b>
                    <br>
                    <b style="color:red; text-decoration: underline;">Right youtube url is:</b><b>
                        https://youtu.be/aXJnJSJiaS8</b>
                    <br><br>
                    <b>The reason for this is, in the landing page of the movie, the youtube video that
                        appears as a modal, we are using the right youtube format as an Iframe to that modal. The wrong
                        youtube url does not support there. So the right format needs to be
                        provided. Otherwise no youtube video on the front-end We tried to code in such way, to convert
                        the wrong youtube url to be genereted into right youtube url, but it seems impossible because
                        the wrong youtube url is not always the same.
                    </b>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="showtimes" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Showtimes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <h3 class="headline_text">Upload Showtimes</h3>
                    <label for="showtimes">To upload movie click the <b style="color: red;">"Upload"</b> button. Download
                        the sheet. Fill the Start Date and End Date. Choose the file and upload.</label>
                    <img src="{{ asset('user_manual/upload_button.png') }}" class="center" style="width:90%;"></img>
                    <label class="center_text">Button For Uploading Movies</label>
                    <br>
                    <label for="showtimes">Download the sheet. Fill the Start Date and End Date. Choose the file and
                        upload.</label>
                    <img src="{{ asset('user_manual/upload_page.png') }}" class="center" class="center"
                        style="width:90%;">
                    <label class="center_text">Upload Showtimes Page View</label>
                </div>
                <hr>
                <h3 class="headline_text">Updating Showtimes</h3>
                <div class="form-group">
                    <label for="showtimes">Update the showtimes by clicking <b style="color:red;">"Showtimes"</b>
                        button.</label>
                    <img src="{{ asset('user_manual/update_showtimes_button.png') }}" class="center"
                        style="width:90%;"></img>
                    <label class="center_text">Showtimes Update Button</label>
                    <br>
                    <label for="showtimes">You will see a list of showtimes with the theatre name. While editing the
                        showtimes, if the URL field needs to be filled out <b style="color:red;">please keep in mind
                            that, the url must be without http or https.</b></label>
                    <img src="{{ asset('user_manual/update_showtimes_page.png') }}" class="center"
                        style="width:90%;"></img>
                    <label class="center_text">Showtimes Update Page</label>
                    <br>
                    <h3 class="headline_text">OR</h3>
                    <label for="showtimes">Or the dates can be updated altogether by clicking this. It will update all the
                        dates regarding with the movie.</b></label>
                    <img src="{{ asset('user_manual/update_showtimes_together.png') }}" class="center"
                        style="width:90%;"></img>
                    <label class="center_text">Showtimes Update Page</label>
                    <h3 class="headline_text">AND</h3>
                    <label for="showtimes">If there is a theatre missing, then no need to upload the sheet again. Just click <b style="color:red;">"Add Theatre+"</b>, fill up the form and the theatre will be saved.</label>
                    <img src="{{ asset('user_manual/showtimes_add_theatre.png') }}" class="center"
                        style="width:90%;"></img>
                    <label class="center_text">Add Theatre</label>
                </div>
                <hr>
                <div class="form-group">
                    <h3 class="headline_text">Showtime Scenarios</h3>
                    <label for="showtimes">Here we are going to know how Start Date and End Date play role in the Front-End
                        meaning, in the movie landing pages.</label>
                    <br>
                    <label for="showtimes">If the current date is smaller than the Start Date, then in the Front-End, it
                        will show Vanaf/From.</label>
                    <img src="{{ asset('user_manual/vanaf.png') }}" class="center" style="width:60%;"></img>
                    <label class="center_text">Date Condition 1</label>
                    <br>
                    <label for="showtimes">If the current date is in the middle of Start Date and End Date then, in the
                        Front-End it will show "In de Bioscoop" or "Now Showing in Theatre".</label>
                    <img src="{{ asset('user_manual/in_theatre.png') }}" class="center" class="center"
                        style="width:60%;">
                    <label class="center_text">Date Condition 2</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="reviews" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Reviews</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <h3 class="headline_text">Create Reviews</h3>
                    <label for="reviews">To create/edit reviews click the <b style="color: red;">"Reviews"</b>
                        button.</label>
                    <img src="{{ asset('user_manual/reviews_button.png') }}" class="center" style="width:90%;"></img>
                    <label class="center_text">Button For Reviews</label>
                    <br>
                    <label for="reviews">To add Reviews, click here.</label>
                    <img src="{{ asset('user_manual/reviews_page.png') }}" class="center" class="center"
                        style="width:90%;">
                    <label class="center_text">Review Page View</label>
                    <br>
                    <label for="reviews">Then fill up the form. Edit page is the same.</label>
                    <img src="{{ asset('user_manual/reviews_modal.png') }}" class="center" class="center"
                        style="width:70%; height: 50%;">
                    <label class="center_text">Review Modal</label>
                </div>
                <div class="form-group">
                    <h3 class="headline_text">Know more about the Review System</h3>
                    <label for="reviews">To create/edit reviews click the <b style="color: red;">"Reviews"</b>
                        button.</label>
                    <ul class="list-group">
                        <li class="list-group-item" style="color: #3490dc; font-weight: bold;">The review system is
                            created such a way that, in NL landing page
                            Both EN and NL language Reviews will be shown. In En landing page, only EN Reviews will be
                            shown.</li>
                        <li class="list-group-item" style="color: #3490dc; font-weight: bold;">So if the review is in EN
                            lanuage, no need create NL version for
                            that. Otherwise same review will be shown twice.</li>
                        <li class="list-group-item" style="color: #3490dc; font-weight: bold;">But if the review is in
                            NL, if EN review is provided that will be
                            nice if not no matter, just create the NL version. So, user will see both NL and EN reviews
                            in NL landing page and the EN reviews in EN landing page. </li>
                        <li class="list-group-item" style="color: #3490dc; font-weight: bold;">And no need for "" while
                            creating or editing the review. We already have that in the Front-End. Just like below:</li>
                    </ul>
                    <br>
                    <img src="{{ asset('user_manual/review_example.png') }}" class="center" class="center"
                        style="width:70%; height: 50%;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

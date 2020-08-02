<?php

use Illuminate\Support\Facades\Route; 

//if domain is movie.planetnine.com
Route::domain('movie.planetnine.com')->group(function(){
    Route::get('/', 'DataController@index');
    Route::get('/en', 'DataController@en_index');
});

//domain for madre-defilm.nl
Route::domain('madre-defilm.nl')->group(function(){
    Route::get('/', 'MadreController@nl_landing');
    Route::get('/_en', 'MadreController@en_landing');
    Route::get('/api/shows', 'MadreController@showsApi');
});

//domain for www.madre-defilm.nl
Route::domain('www.madre-defilm.nl')->group(function(){
    Route::get('/', 'MadreController@nl_landing');
    Route::get('/_en', 'MadreController@en_landing');
    Route::get('/api/shows', 'MadreController@showsApi');
});

//domain for gli-anni-defilm.nl
Route::domain('gli-anni-defilm.nl')->group(function(){
    Route::get('/', 'GliController@nl_landing');
    Route::get('/_en', 'GliController@en_landing');
    Route::get('/api/shows', 'GliController@showsApi');
});

//domain for www.gli-anni-defilm.nl
Route::domain('www.gli-anni-defilm.nl')->group(function(){
    Route::get('/', 'GliController@nl_landing');
    Route::get('/_en', 'GliController@en_landing');
    Route::get('/api/shows', 'GliController@showsApi');
});

//domain for sibyl-defilm.nl
Route::domain('sibyl-defilm.nl')->group(function(){
    Route::get('/', 'SibylController@nl_landing');
    Route::get('/_en', 'SibylController@en_landing');
    Route::get('/api/shows', 'SibylController@showsApi');
});

//domain for www.sibyl-defilm.nl
Route::domain('www.sibyl-defilm.nl')->group(function(){
    Route::get('/', 'SibylController@nl_landing');
    Route::get('/_en', 'SibylController@en_landing');
    Route::get('/api/shows', 'SibylController@showsApi');
});

//if domain is running on localhost
Route::get('/', 'DataController@index');
Route::get('/en', 'DataController@en_index');

Route::get('/madre', 'MadreController@nl_landing');
Route::get('/madre_en', 'MadreController@en_landing');
Route::get('/madre/api/shows', 'MadreController@showsApi');

Route::get('/GliAnniPiuBelli', 'GliController@nl_landing');
Route::get('/GliAnniPiuBelli_en', 'GliController@en_landing');
Route::get('/GliAnniPiuBelli/api/shows', 'GliController@showsApi');

Route::get('/Sibyl', 'SibylController@nl_landing');
Route::get('/Sibyl_en', 'SibylController@en_landing');
Route::get('/Sibyl/api/shows', 'SibylController@showsApi');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/showtimes/{id}', 'HomeController@showtimes');
    Route::get('/showtimes/edit/{id}', 'HomeController@showtimes_edit');
    Route::post('/showtimes/edit/{id}', 'HomeController@showtimes_edit_post');
    Route::get('/showtimes/delete/{id}', 'HomeController@showtimes_delete');
    Route::get('/upload/{id}', 'HomeController@movie_showtime');
    Route::post('/upload_sheet/{id}', 'HomeController@upload');
    Route::post('/update-info', 'HomeController@update_info')->name('update_info');

    Route::get('/userlist', 'AdminController@userlist');
    Route::post('/userlist/create', 'AdminController@create_user')->name('create.user');
    Route::get('/userlist/delete/{id}', 'AdminController@delete_user');
    Route::get('/userlist/edit/{id}', 'AdminController@edit_user');
    Route::post('/userlist/edit/{id}', 'AdminController@edit_user_post');

    Route::get('/theaterlist', 'AdminController@theaterlist');
    Route::post('/theaterlist/create', 'AdminController@theater_create');
    Route::get('/theaterlist/edit/{id}', 'AdminController@theater_edit');
    Route::post('/theaterlist/edit/{id}', 'AdminController@theater_edit_post');
    Route::get('/theaterlist/delete/{id}', 'AdminController@theater_delete');

    Route::get('/movielist', 'AdminController@movielist');
    Route::post('/movielist/create', 'AdminController@movie_create');
    Route::get('/movielist/edit/{id}', 'AdminController@movie_edit');
    Route::post('/movielist/edit/tmd/{id}', 'AdminController@tmd_edit');
    Route::post('/movielist/edit/en/{id}', 'AdminController@en_edit');
    Route::post('/movielist/edit/nl/{id}', 'AdminController@nl_edit');
    Route::get('/movielist/delete/{id}', 'AdminController@movie_delete');

    Route::get('/reviews/{id}', 'AdminController@reviews_list');
    Route::post('/reviews/create/{id}', 'AdminController@reviews_create');
    Route::get('/reviews/delete/{id}', 'AdminController@reviews_delete');
    Route::get('/reviews/edit/{id}', 'AdminController@reviews_edit');
    Route::post('/reviews/edit/{id}', 'AdminController@reviews_edit_post');

    Route::get('/partnerlist/distributors', 'AdminController@d_list');
    Route::post('/partnerlist/distributor/create', 'AdminController@d_create');
    Route::get('/partnerlist/distributor/edit/{id}', 'AdminController@d_edit');
    Route::post('/partnerlist/distributor/edit/{id}', 'AdminController@d_edit_post');
    Route::get('/partnerlist/distributor/delete/{id}', 'AdminController@d_delete');

    Route::get('/partnerlist/media_partners', 'AdminController@mp_list');
    Route::post('/partnerlist/media_partner/create', 'AdminController@mp_create');
    Route::get('/partnerlist/media_partner/edit/{id}', 'AdminController@mp_edit');
    Route::post('/partnerlist/media_partner/edit/{id}', 'AdminController@mp_edit_post');
    Route::get('/partnerlist/media_partner/delete/{id}', 'AdminController@mp_delete');
});

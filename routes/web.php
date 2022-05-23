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

Route::domain('www.cunningham-defilm.nl')->group(function(){
    Route::get('/', 'CunninghamController@nl_landing');
    Route::get('/_en', 'CunninghamController@en_landing');
    Route::get('/api/shows', 'CunninghamController@showsApi');
});

Route::domain('cunningham-defilm.nl')->group(function(){
    Route::get('/', 'CunninghamController@nl_landing');
    Route::get('/_en', 'CunninghamController@en_landing');
    Route::get('/api/shows', 'CunninghamController@showsApi');
});

Route::domain('www.lara-defilm.nl')->group(function(){
    Route::get('/', 'LaraController@nl_landing');
    Route::get('/_en', 'LaraController@en_landing');
    Route::get('/api/shows', 'LaraController@showsApi');
});

Route::domain('lara-defilm.nl')->group(function(){
    Route::get('/', 'LaraController@nl_landing');
    Route::get('/_en', 'LaraController@en_landing');
    Route::get('/api/shows', 'LaraController@showsApi');
});

//cunningham-film.be
Route::domain('cunningham-film.be')->group(function(){
    Route::get('/', 'CunninghamBEController@nl_landing');
    Route::get('/_en', 'CunninghamBEController@en_landing');
    Route::get('/_fr', 'CunninghamBEController@fr_landing');
    Route::get('/api/shows', 'CunninghamBEController@showsApi');
});

Route::domain('www.cunningham-film.be')->group(function(){
    Route::get('/', 'CunninghamBEController@nl_landing');
    Route::get('/_en', 'CunninghamBEController@en_landing');
    Route::get('/_fr', 'CunninghamBEController@fr_landing');
    Route::get('/api/shows', 'CunninghamBEController@showsApi');
});

Route::domain('police-defilm.nl')->group(function(){
    Route::get('/', 'PoliceController@nl_landing');
    Route::get('/_en', 'PoliceController@en_landing');
    Route::get('/api/shows', 'PoliceController@showsApi');
});

Route::domain('www.police-defilm.nl')->group(function(){
    Route::get('/', 'PoliceController@nl_landing');
    Route::get('/_en', 'PoliceController@en_landing');
    Route::get('/api/shows', 'PoliceController@showsApi');
});

Route::domain('undine-defilm.nl')->group(function(){
    Route::get('/', 'UndineController@nl_landing');
    Route::get('/_en', 'UndineController@en_landing');
    Route::get('/api/shows', 'UndineController@showsApi');
});

Route::domain('www.undine-defilm.nl')->group(function(){
    Route::get('/', 'UndineController@nl_landing');
    Route::get('/_en', 'UndineController@en_landing');
    Route::get('/api/shows', 'UndineController@showsApi');
});

Route::domain('100up.nl')->group(function(){
    Route::get('/', 'HundredUpController@nl_landing');
    Route::get('/_en', 'HundredUpController@en_landing');
    Route::get('/api/shows', 'HundredUpController@showsApi');
});

Route::domain('www.100up.nl')->group(function(){
    Route::get('/', 'HundredUpController@nl_landing');
    Route::get('/_en', 'HundredUpController@en_landing');
    Route::get('/api/shows', 'HundredUpController@showsApi');
});

Route::domain('sorellemacaluso.nl')->group(function(){
    Route::get('/', 'LaSorelleController@nl_landing');
    Route::get('/_en', 'LaSorelleController@en_landing');
    Route::get('/api/shows', 'LaSorelleController@showsApi');
});

Route::domain('www.sorellemacaluso.nl')->group(function(){
    Route::get('/', 'LaSorelleController@nl_landing');
    Route::get('/_en', 'LaSorelleController@en_landing');
    Route::get('/api/shows', 'LaSorelleController@showsApi');
});

Route::domain('dearcomrades-defilm.nl')->group(function(){
    Route::get('/', 'DearComradeController@nl_landing');
    Route::get('/_en', 'DearComradeController@en_landing');
    Route::get('/api/shows', 'DearComradeController@showsApi');
});

Route::domain('www.dearcomrades-defilm.nl')->group(function(){
    Route::get('/', 'DearComradeController@nl_landing');
    Route::get('/_en', 'DearComradeController@en_landing');
    Route::get('/api/shows', 'DearComradeController@showsApi');
});

Route::domain('martinlutherkingvsthefbi.nl')->group(function(){
    Route::get('/', 'MartinLutherController@nl_landing');
    Route::get('/_en', 'MartinLutherController@en_landing');
    Route::get('/api/shows', 'MartinLutherController@showsApi');
});

Route::domain('www.martinlutherkingvsthefbi.nl')->group(function(){
    Route::get('/', 'MartinLutherController@nl_landing');
    Route::get('/_en', 'MartinLutherController@en_landing');
    Route::get('/api/shows', 'MartinLutherController@showsApi');
});

Route::domain('balladofawhitecow-defilm.nl')->group(function(){
    Route::get('/', 'BalladWhiteCowController@nl_landing');
    Route::get('/_en', 'BalladWhiteCowController@en_landing');
    Route::get('/api/shows', 'BalladWhiteCowController@showsApi');
});

Route::domain('www.balladofawhitecow-defilm.nl')->group(function(){
    Route::get('/', 'BalladWhiteCowController@nl_landing');
    Route::get('/_en', 'BalladWhiteCowController@en_landing');
    Route::get('/api/shows', 'BalladWhiteCowController@showsApi');
});

Route::domain('sunchildren-defilm.nl')->group(function(){
    Route::get('/', 'SunChildrenController@nl_landing');
    Route::get('/_en', 'SunChildrenController@en_landing');
    Route::get('/api/shows', 'SunChildrenController@showsApi');
});

Route::domain('www.sunchildren-defilm.nl')->group(function(){
    Route::get('/', 'SunChildrenController@nl_landing');
    Route::get('/_en', 'SunChildrenController@en_landing');
    Route::get('/api/shows', 'SunChildrenController@showsApi');
});

Route::domain('petrovsflu-defilm.nl')->group(function(){
    Route::get('/', 'PetrovController@nl_landing');
    Route::get('/_en', 'PetrovController@en_landing');
    Route::get('/api/shows', 'PetrovController@showsApi');
});

Route::domain('www.petrovsflu-defilm.nl')->group(function(){
    Route::get('/', 'PetrovController@nl_landing');
    Route::get('/_en', 'PetrovController@en_landing');
    Route::get('/api/shows', 'PetrovController@showsApi');
});

Route::domain('thereasonijump-defilm.nl')->group(function(){
    Route::get('/', 'ReasonIJumpController@nl_landing');
    Route::get('/_en', 'ReasonIJumpController@en_landing');
    Route::get('/api/shows', 'ReasonIJumpController@showsApi');
});

Route::domain('www.thereasonijump-defilm.nl')->group(function(){
    Route::get('/', 'ReasonIJumpController@nl_landing');
    Route::get('/_en', 'ReasonIJumpController@en_landing');
    Route::get('/api/shows', 'ReasonIJumpController@showsApi');
});

Route::domain('ninjababy-defilm.nl')->group(function(){
    Route::get('/', 'NinjaBabyController@nl_landing');
    Route::get('/_en', 'NinjaBabyController@en_landing');
    Route::get('/api/shows', 'NinjaBabyController@showsApi');
});

Route::domain('www.ninjababy-defilm.nl')->group(function(){
    Route::get('/', 'NinjaBabyController@nl_landing');
    Route::get('/_en', 'NinjaBabyController@en_landing');
    Route::get('/api/shows', 'NinjaBabyController@showsApi');
});

Route::domain('ali-en-ava-defilm.nl')->group(function(){
    Route::get('/', 'NinjaBabyController@nl_landing');
    Route::get('/_en', 'NinjaBabyController@en_landing');
    Route::get('/api/shows', 'NinjaBabyController@showsApi');
});

Route::domain('www.ali-en-ava-defilm.nl')->group(function(){
    Route::get('/', 'alliavaController@nl_landing');
    Route::get('/_en', 'alliavaController@en_landing');
    Route::get('/api/shows', 'alliavaController@showsApi');
});

Route::domain('www.hittheroad-defilm.nl')->group(function(){
    Route::get('/', 'hittheroadController@nl_landing');
    Route::get('/_en', 'hittheroadController@en_landing');
    Route::get('/api/shows', 'hittheroadController@showsApi');
});

Route::domain('hittheroad-defilm.nl')->group(function(){
    Route::get('/', 'hittheroadController@nl_landing');
    Route::get('/_en', 'hittheroadController@en_landing');
    Route::get('/api/shows', 'hittheroadController@showsApi');
});

Route::domain('www.theinnocents-defilm.nl')->group(function(){
    Route::get('/', 'theinnocentsController@nl_landing');
    Route::get('/_en', 'theinnocentsController@en_landing');
    Route::get('/api/shows', 'theinnocentsController@showsApi');
});

Route::domain('theinnocents-defilm.nl')->group(function(){
    Route::get('/', 'theinnocentsController@nl_landing');
    Route::get('/_en', 'theinnocentsController@en_landing');
    Route::get('/api/shows', 'theinnocentsController@showsApi');
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

Route::get('/cunningham', 'CunninghamController@nl_landing');
Route::get('/cunningham_en', 'CunninghamController@en_landing');
Route::get('/cunningham/api/shows', 'CunninghamController@showsApi');

Route::get('/cunninghamBE', 'CunninghamBEController@nl_landing');
Route::get('/cunninghamBE_en', 'CunninghamBEController@en_landing');
Route::get('/cunninghamBE_fr', 'CunninghamBEController@fr_landing');
Route::get('/cunninghamBE/api/shows', 'CunninghamBEController@showsApi');

Route::get('/lara', 'LaraController@nl_landing');
Route::get('/lara_en', 'LaraController@en_landing');
Route::get('/lara/api/shows', 'LaraController@showsApi');

Route::get('/police', 'PoliceController@nl_landing');
Route::get('/police_en', 'PoliceController@en_landing');
Route::get('/police/api/shows', 'PoliceController@showsApi');

Route::get('/Undine', 'UndineController@nl_landing');
Route::get('/Undine_en', 'UndineController@en_landing');
Route::get('/Undine/api/shows', 'UndineController@showsApi');

Route::get('/undine', 'UndineController@nl_landing');
Route::get('/undine_en', 'UndineController@en_landing');
Route::get('/undine/api/shows', 'UndineController@showsApi');

Route::get('/100UP', 'HundredUpController@nl_landing');
Route::get('/100UP_en', 'HundredUpController@en_landing');
Route::get('/100UP/api/shows', 'HundredUpController@showsApi');

Route::get('/100up', 'HundredUpController@nl_landing');
Route::get('/100up_en', 'HundredUpController@en_landing');
Route::get('/100up/api/shows', 'HundredUpController@showsApi');

Route::get('/dummy', 'DumbController@nl_landing');
Route::get('/dummy_en', 'DumbController@en_landing');
Route::get('/dummy/api/shows', 'DumbController@showsApi');

Route::get('/lesorellemacaluso', 'LaSorelleController@nl_landing');
Route::get('/lesorellemacaluso_en', 'LaSorelleController@en_landing');
Route::get('/lesorellemacaluso/api/shows', 'LaSorelleController@showsApi');

Route::get('/dearcomrades', 'DearComradeController@nl_landing');
Route::get('/dearcomrades_en', 'DearComradeController@en_landing');
Route::get('/dearcomrades/api/shows', 'DearComradeController@showsApi');

Route::get('/martinlutherking', 'MartinLutherController@nl_landing');
Route::get('/martinlutherking_en', 'MartinLutherController@en_landing');
Route::get('/martinlutherking/api/shows', 'MartinLutherController@showsApi');

Route::get('/balladthewhitecow', 'BalladWhiteCowController@nl_landing');
Route::get('/balladthewhitecow_en', 'BalladWhiteCowController@en_landing');
Route::get('/balladthewhitecow/api/shows', 'BalladWhiteCowController@showsApi');

Route::get('/sunchildren', 'SunChildrenController@nl_landing');
Route::get('/sunchildren_en', 'SunChildrenController@en_landing');
Route::get('/sunchildren/api/shows', 'SunChildrenController@showsApi');

Route::get('/petrovsflu', 'PetrovController@nl_landing');
Route::get('/petrovsflu_en', 'PetrovController@en_landing');
Route::get('/petrovsflu/api/shows', 'PetrovController@showsApi');

Route::get('/thereasonijump', 'ReasonIJumpController@nl_landing');
Route::get('/thereasonijump_en', 'ReasonIJumpController@en_landing');
Route::get('/thereasonijump/api/shows', 'ReasonIJumpController@showsApi');

Route::get('/ninjababy', 'NinjaBabyController@nl_landing');
Route::get('/ninjababy_en', 'NinjaBabyController@en_landing');
Route::get('/ninjababy/api/shows', 'NinjaBabyController@showsApi');

Route::get('/aliandava', 'alliavaController@nl_landing');
Route::get('/aliandava_en', 'alliavaController@en_landing');
Route::get('/aliandava/api/shows', 'alliavaController@showsApi');

Route::get('/the-innocents', 'theinnocentsController@nl_landing');
Route::get('/the-innocents_en', 'theinnocentsController@en_landing');
Route::get('/the-innocents/api/shows', 'theinnocentsController@showsApi');

Route::get('/hit_the_road', 'hittheroadController@nl_landing');
Route::get('/hit_the_road_en', 'hittheroadController@en_landing');
Route::get('/hit_the_road/api/shows', 'hittheroadController@showsApi');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/showtimes/{id}', 'HomeController@showtimes');
    Route::post('/showtimes/add/{id}', 'HomeController@showtimes_add');
    Route::get('/showtimes/edit/{id}', 'HomeController@showtimes_edit');
    Route::post('/showtimes/edit/{id}', 'HomeController@showtimes_edit_post');
    Route::post('/showtimes/update/{id}', 'HomeController@showtimes_update');
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
    Route::get('/movie/create', 'AdminController@movie_create_view');
    Route::post('/movielist/create', 'AdminController@movie_create');
    Route::get('/movielist/edit/{id}', 'AdminController@movie_edit');
    Route::post('/movielist/edit/tmd/{id}', 'AdminController@tmd_edit');
    Route::post('/movielist/edit/en/{id}', 'AdminController@en_edit');
    Route::post('/movielist/edit/nl/{id}', 'AdminController@nl_edit');
    Route::post('/movielist/edit/fr/{id}', 'AdminController@fr_edit');
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

    Route::get('/manual', 'AdminController@user_manual');

    Route::post('/is_active', 'AdminController@is_active')->name('is_active');
    Route::post('/is_two_d', 'AdminController@is_two_d')->name('is_two_d');
    Route::post('/is_three_d', 'AdminController@is_three_d')->name('is_three_d');
    Route::post('/gettheatreurl', 'AdminController@gettheatreurl')->name('gettheatreurl');
    Route::post('/gettheaters', 'AdminController@gettheaters')->name('gettheaters');
});

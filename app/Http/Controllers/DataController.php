<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Showtime;
use App\Location;
use App\Review;

class DataController extends Controller
{
    public function index()
    {
        $movie_list = Movie::where('is_delete', '=', 0)->get();
        return view('land', compact('movie_list'));
    }

    public function en_index()
    {
        $movie_list = Movie::where('is_delete', '=', 0)->get();
        return view('land-en', compact('movie_list'));
    }
}

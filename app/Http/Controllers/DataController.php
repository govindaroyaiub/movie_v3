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
        return view('coming_soon');
    }
    
    public function get_google_sheet(Request $request)
    {
        $movie_details = Movie::where('id', $request->movie_id)->first();
        return $movie_details;
    }
}

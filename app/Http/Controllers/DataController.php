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
        return view('land');
    }

    public function en_index()
    {
        return view('land-en');
    }
}

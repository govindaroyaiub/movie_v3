<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Showtime;
use App\Location;
use App\Review;
use Carbon\Carbon;

class GliController extends Controller
{
    public function nl_landing()
    {   
        $title = new \Imdb\Title(9392248);
        $rating = $title->rating();
        
        $app_url = 'https://movie.planetnine.com/GliAnniPiuBelli';
        $movie_details = Movie::where('base_url', '=', $app_url)->first();
        $current_date = date('Y-m-d');
        if ($movie_details == NULL) {
            return view('coming_soon');
        } else {
            $youtube_url_db = Movie::select('youtube_url')->where('base_url', '=', $app_url)->first();
            $youtube_link = explode("/", $youtube_url_db['youtube_url']);
            $last_youtube_part = end($youtube_link);
            array_pop($youtube_link);
            $youtube_first = implode("/", $youtube_link);
            $youtube_url = 'https://youtube.com/embed/' . $last_youtube_part;
            
            $poster = Movie::select('image1', 'image2', 'image3')->where('base_url', '=', $app_url)->first();
            $showtime = Showtime::join('movie_details', 'movie_showtimes.movie_id', 'movie_details.id')
            ->join('show_location_static', 'movie_showtimes.cinema_id', 'show_location_static.id')
            ->where('movie_details.base_url', '=', $app_url)
            ->where('movie_showtimes.date', '>=', $current_date)
            ->orderBy('show_location_static.name', 'ASC')
            ->orderBy('movie_showtimes.date', 'ASC')
            ->get();
            
            $city = Showtime::join('movie_details', 'movie_showtimes.movie_id', 'movie_details.id')
            ->join('show_location_static', 'movie_showtimes.cinema_id', 'show_location_static.id')
            ->select('show_location_static.city')
            ->where('movie_details.base_url', '=', $app_url)
            ->where('movie_showtimes.date', '>=', $current_date)
            ->orderBy('show_location_static.city', 'ASC')
            ->distinct()
            ->get();
            
            $d_details = Movie::join('distributors', 'distributors.id', 'movie_details.d_id')
            ->select('distributors.logo', 'distributors.name', 'distributors.email')
            ->where('movie_details.base_url', '=', $app_url)
            ->first();
            
            $mp_details = Movie::join('media_partners', 'media_partners.id', 'movie_details.mp_id')
            ->select('media_partners.logo', 'media_partners.name', 'media_partners.email')
            ->where('movie_details.base_url', '=', $app_url)
            ->first();         
            
            $release_date = Showtime::join('movie_details', 'movie_showtimes.movie_id', 'movie_details.id')
                            ->select('movie_showtimes.date')
                            ->where('movie_details.base_url', '=', $app_url)
                            ->orderBy('movie_showtimes.date', 'ASC')
                            ->first();

            Carbon::setLocale('nl');
            $date = Carbon::parse($release_date['date'])->locale('nl_NL');
            if(strlen($date->day) == 1)
            {
                $d = '0'.$date->day.' '.$date->monthName.' '.$date->year;
                $first_release_date = strtoupper($d);
            }
            else
            {
                $d = $date->day.' '.$date->monthName.' '.$date->year;
                $first_release_date = strtoupper($d);
            }        

            $movie_details_color = Movie::select('primary_light', 'primary_dark', 'secondary_light', 'secondary_dark')->where('base_url', '=', $app_url)->first();
            $primary_light = $movie_details_color['primary_light'];
            $primary_dark = $movie_details_color['primary_dark'];
            $secondary_light = $movie_details_color['secondary_light'];
            $secondary_dark = $movie_details_color['secondary_dark'];
            
            $reviews = Review::join('movie_details', 'movie_details.id', 'reviews.movie_id')
            ->select('reviews.id', 'reviews.movie_id', 'movie_details.movie_title', 'reviews.review_text', 'reviews.language', 'reviews.source', 'reviews.source_link', 'reviews.ratings')
            ->where('base_url', '=', $app_url)
            ->get();
            
            return view('gli.index', compact(
                'movie_details',
                'youtube_url',
                'poster', 'showtime',
                'city',
                'rating',
                'd_details',
                'mp_details',
                'reviews',
                'primary_light',
                'primary_dark',
                'secondary_light',
                'secondary_dark',
                'first_release_date'
            ));
            
        }
    }
    
    public function en_landing()
    {
        $title = new \Imdb\Title(9392248);
        $rating = $title->rating();
        
        $app_url = 'https://movie.planetnine.com/GliAnniPiuBelli';
        $movie_details = Movie::where('base_url', '=', $app_url)->first();
        $current_date = date('Y-m-d');
        if ($movie_details == NULL) {
            return view('coming_soon');
        } else {
            $youtube_url_db = Movie::select('youtube_url')->where('base_url', '=', $app_url)->first();
            $youtube_link = explode("/", $youtube_url_db['youtube_url']);
            $last_youtube_part = end($youtube_link);
            array_pop($youtube_link);
            $youtube_first = implode("/", $youtube_link);
            $youtube_url = 'https://youtube.com/embed/' . $last_youtube_part;
            
            $poster = Movie::select('image1', 'image2', 'image3')->where('base_url', '=', $app_url)->first();
            $showtime = Showtime::join('movie_details', 'movie_showtimes.movie_id', 'movie_details.id')
            ->join('show_location_static', 'movie_showtimes.cinema_id', 'show_location_static.id')
            ->where('movie_details.base_url', '=', $app_url)
            ->where('movie_showtimes.date', '>=', $current_date)
            ->orderBy('show_location_static.name', 'ASC')
            ->orderBy('movie_showtimes.date', 'ASC')
            ->get();
            
            $city = Showtime::join('movie_details', 'movie_showtimes.movie_id', 'movie_details.id')
            ->join('show_location_static', 'movie_showtimes.cinema_id', 'show_location_static.id')
            ->select('show_location_static.city')
            ->where('movie_details.base_url', '=', $app_url)
            ->where('movie_showtimes.date', '>=', $current_date)
            ->orderBy('show_location_static.city', 'ASC')
            ->distinct()
            ->get();
            
            
            $d_details = Movie::join('distributors', 'distributors.id', 'movie_details.d_id')
            ->select('distributors.logo', 'distributors.name', 'distributors.email')
            ->where('movie_details.base_url', '=', $app_url)
            ->first();
            
            $mp_details = Movie::join('media_partners', 'media_partners.id', 'movie_details.mp_id')
            ->select('media_partners.logo', 'media_partners.name', 'media_partners.email')
            ->where('movie_details.base_url', '=', $app_url)
            ->first();

           
            
            $release_date = Showtime::join('movie_details', 'movie_showtimes.movie_id', 'movie_details.id')
            ->select('movie_showtimes.date')
            ->where('movie_details.base_url', '=', $app_url)
            ->orderBy('movie_showtimes.date', 'ASC')
            ->first();
            
            $first_release_date = strtoupper(date("d F Y", strtotime($release_date['date'])));
            
            $movie_details_color = Movie::select('primary_light', 'primary_dark', 'secondary_light', 'secondary_dark')->where('base_url', '=', $app_url)->first();
            $primary_light = $movie_details_color['primary_light'];
            $primary_dark = $movie_details_color['primary_dark'];
            $secondary_light = $movie_details_color['secondary_light'];
            $secondary_dark = $movie_details_color['secondary_dark'];
            
            $reviews = Review::join('movie_details', 'movie_details.id', 'reviews.movie_id')
            ->select('reviews.id', 'reviews.movie_id', 'movie_details.movie_title', 'reviews.review_text', 'reviews.language', 'reviews.source', 'reviews.source_link', 'reviews.ratings')
            ->where('movie_details.base_url', '=', $app_url)
            ->where('reviews.language', '=', 'en')
            ->get();
            
            return view('gli.index-en', compact(
                'movie_details',
                'youtube_url',
                'poster', 'showtime',
                'city',
                'rating',
                'd_details',
                'mp_details',
                'reviews',
                'primary_light',
                'primary_dark',
                'secondary_light',
                'secondary_dark',
                'first_release_date'
            ));
        }
    }
    
    public function showsApi()
    {
        $app_url = 'https://movie.planetnine.com/GliAnniPiuBelli';
        $movie_details = Movie::where('base_url', '=', $app_url)->first();
        $current_date = date('Y-m-d');
        $showtime = Showtime::join('show_location_static', 'movie_showtimes.cinema_id', 'show_location_static.id')
                            ->select(
                                'movie_showtimes.id',
                                'movie_showtimes.cinema_id',
                                'movie_showtimes.date',
                                'movie_showtimes.end_date',
                                'movie_showtimes.time',
                                'show_location_static.name',
                                'show_location_static.address',
                                'show_location_static.city',
                                'show_location_static.zip',
                                'movie_showtimes.url',
                                'movie_showtimes.two_d',
                                'movie_showtimes.three_d',
                                'show_location_static.long',
                                'show_location_static.lat')
                            ->where('movie_showtimes.movie_id', '=', $movie_details['id'])
                            ->where('movie_showtimes.is_active', '=', 1)
                            ->orderBy('show_location_static.name', 'ASC')
                            ->get();
                                
        return $showtime;
    }
}

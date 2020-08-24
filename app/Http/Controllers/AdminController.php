<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hash;
use App\Movie;
use App\Showtime;
use App\Location;
use App\User;
use App\Review;
use App\Distributor;
use App\MediaPartner;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function userlist()
    {
        $userlist = User::where('is_delete', 1)->orderBy('name')->get();
        return view('userlist', compact('userlist'));
    }

    public function create_user(Request $request)
    {
        $request->validate([
            'email' => 'unique:users',
        ]);

        $name = $request->name;
        $email = $request->email;
        $default_password = 'password';
        $user_role = $request->role;

        $params = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($default_password),
            'is_admin' => $user_role,
            'is_delete' => '1'
        ];
        User::insert($params);
        return back()->with('success-create-user', $name);
    }

    public function edit_user($id)
    {
        $user_details = User::find($id);
    
        return view('edit-user', compact('user_details', 'id'));
    }

    public function edit_user_post(Request $request, $id)
    {
        $name = $request->name;
        $email = $request->email;
        $role = $request->role;

        $params = [
            'name' => $name,
            'email' => $email,
            'is_admin' => $role
        ];
        User::where('id', $id)->update($params);
        return back()->with('info', $name.' has been updated!');
    }

    public function delete_user($id)
    {
        User::where('id', $id)->update(['is_delete' => 0]);
        return redirect('/userlist')->with('info', 'User has been deleted!');
    }

    public function movielist()
    {
        $d_list = Distributor::get();
        $mp_list = MediaPartner::get();
        if(Auth::user()->is_admin == 0)
        {
            $movie_list = Movie::join('users', 'users.id', 'movie_details.uploaded_by')
                                ->select(
                                    'movie_details.id',
                                    'users.name',
                                    'users.is_admin',
                                    'movie_details.movie_title',
                                    'movie_details.base_url'
                                )
                                ->where('movie_details.is_delete', '0')
                                ->where('movie_details.uploaded_by', Auth::user()->id)
                                ->get();
        }
        else
        {
            $user_list = User::where('is_admin', 0)->where('is_delete', 1)->get();
            $movie_list = Movie::join('users', 'users.id', 'movie_details.uploaded_by')
                                ->select(
                                    'movie_details.id',
                                    'users.name',
                                    'users.is_admin',
                                    'movie_details.movie_title',
                                    'movie_details.base_url'
                                )
                                ->where('movie_details.is_delete', '0')
                                ->get();

        }

        return view('movielist', compact('movie_list', 'user_list', 'd_list', 'mp_list'));
    }

    public function movie_create(Request $request)  
    {
        $distributor = Distributor::where('id', '=', $request->d_id)->select('name')->first();
        $media_partner = MediaPartner::where('id', '=', $request->mp_id)->select('name')->first();
        $d_name = $distributor['name'];
        $mp_name = $media_partner['name'];
        $movie_title = $request->movie_title;

        if($request->d_id == 0 && $request->mp_id == 0)
        {
            $movie_details = [
                'movie_title' => $request->movie_title,
                'base_url' => 'https://movie.planetnine.com/'.$request->base_url,
                'google_sheet' => $request->google_sheet,
                'uploaded_by' => $request->client_id,
                'director' => $request->director,
                'producer' => $request->producer,
                'writer' => $request->writer,
                'actors' => $request->actors,
                'credits' => $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'.',
                'credits_nl' => $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'.',
                'primary_light' => "#353B48",
                'primary_dark' => "#353B48",
                'secondary_light' => "#353B48",
                'secondary_dark' => "#353B48",
                'd_id' => $request->d_id,
                'mp_id' => $request->mp_id,
                'is_delete' => 0
            ];
            Movie::insert($movie_details);
            return back()->with('success', $movie_title.' has been created!');
        }
        elseif($request->d_id != 0 && $request->mp_id == 0)
        {
            $movie_details = [
                'movie_title' => $request->movie_title,
                'base_url' => 'https://movie.planetnine.com/'.$request->base_url,
                'google_sheet' => $request->google_sheet,
                'uploaded_by' => $request->client_id,
                'director' => $request->director,
                'producer' => $request->producer,
                'writer' => $request->writer,
                'actors' => $request->actors,
                'credits' => $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'. Distributor '.$d_name.'.',
                'credits_nl' => $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'. Distributeur '.$d_name.'.',
                'primary_light' => "#353B48",
                'primary_dark' => "#353B48",
                'secondary_light' => "#353B48",
                'secondary_dark' => "#353B48",
                'd_id' => $request->d_id,
                'mp_id' => $request->mp_id,
                'is_delete' => 0
            ];
            Movie::insert($movie_details);
            return back()->with('success', $movie_title.' has been created!');
        }
        elseif($request->d_id == 0 && $request->mp_id != 0)
        {
            $movie_details = [
                'movie_title' => $request->movie_title,
                'base_url' => 'https://movie.planetnine.com/'.$request->base_url,
                'google_sheet' => $request->google_sheet,
                'uploaded_by' => $request->client_id,
                'director' => $request->director,
                'producer' => $request->producer,
                'writer' => $request->writer,
                'actors' => $request->actors,
                'credits' => $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'. Promotion '.$mp_name.'.',
                'credits_nl' => $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'. Promotie '.$mp_name.'.',
                'primary_light' => "#353B48",
                'primary_dark' => "#353B48",
                'secondary_light' => "#353B48",
                'secondary_dark' => "#353B48",
                'd_id' => $request->d_id,
                'mp_id' => $request->mp_id,
                'is_delete' => 0
            ];
            Movie::insert($movie_details);
            return back()->with('success', $movie_title.' has been created!');
        }
        else
        {
            $movie_details = [
                'movie_title' => $request->movie_title,
                'base_url' => 'https://movie.planetnine.com/'.$request->base_url,
                'google_sheet' => $request->google_sheet,
                'uploaded_by' => $request->client_id,
                'director' => $request->director,
                'producer' => $request->producer,
                'writer' => $request->writer,
                'actors' => $request->actors,
                'credits' => $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'. Distributor '.$d_name.'. Promotion '.$mp_name.'.',
                'credits_nl' => $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'. Distributeur '.$d_name.'. Promotie '.$mp_name.'.',
                'primary_light' => "#353B48",
                'primary_dark' => "#353B48",
                'secondary_light' => "#353B48",
                'secondary_dark' => "#353B48",
                'd_id' => $request->d_id,
                'mp_id' => $request->mp_id,
                'is_delete' => 0
            ];
            Movie::insert($movie_details);
            return back()->with('success', $movie_title.' has been created!');
        }
    }

    public function movie_delete($id)
    {
        Movie::where('id', $id)->update(['is_delete' => '1']);
        return redirect('/movielist')->with('info', 'Movie has been deleted!');
    }

    public function movie_edit($id)
    {
        $movie_details = Movie::where('id', $id)->first();
        $d_list = Distributor::get();
        $mp_list = MediaPartner::get();
        return view('edit-movie', compact('movie_details', 'id', 'd_list', 'mp_list'));
    }

    public function tmd_edit(Request $request, $id)
    {
        $distributor = Distributor::where('id', '=', $request->d_id)->select('name')->first();
        $media_partner = MediaPartner::where('id', '=', $request->mp_id)->select('name')->first();
        $d_name = $distributor['name'];
        $mp_name = $media_partner['name'];

        if($request->d_id == 0 && $request->mp_id == 0)
        {
            $tmd_details = [
                'movie_title' => $request->movie_title,
                'director' => $request->director,
                'producer' => $request->producer,
                'writer' => $request->writer,
                'actors' => $request->actors,
                'youtube_url' => $request->youtube_url,
                'duration' => $request->duration,
                'base_url' => $request->base_url,
                'image1' => $request->image1,
                'fb_link' => $request->fb_link,
                'twitter_link' => $request->twitter_link,
                'hashtag' => $request->hashtag,
                'fb_pixel' => $request->fb_pixel,
                'google_pixel' => $request->google_pixel,
                'primary_light' => $request->primary_light,
                'primary_dark' => $request->primary_dark,
                'secondary_light' => $request->secondary_light,
                'secondary_light' => $request->secondary_light,
                'd_id' => $request->d_id,
                'mp_id' => $request->mp_id,
                'credits' => $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'.',
                'credits_nl' => $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'.',
            ];
            Movie::where('id', $id)->update($tmd_details);
            return redirect('/movielist/edit/'.$id)->with('info', 'The Major Details has been updated!');
        }
        elseif($request->d_id != 0 && $request->mp_id == 0)
        {
            $tmd_details = [
                'movie_title' => $request->movie_title,
                'director' => $request->director,
                'producer' => $request->producer,
                'writer' => $request->writer,
                'actors' => $request->actors,
                'youtube_url' => $request->youtube_url,
                'duration' => $request->duration,
                'base_url' => $request->base_url,
                'image1' => $request->image1,
                'fb_link' => $request->fb_link,
                'twitter_link' => $request->twitter_link,
                'hashtag' => $request->hashtag,
                'fb_pixel' => $request->fb_pixel,
                'google_pixel' => $request->google_pixel,
                'primary_light' => $request->primary_light,
                'primary_dark' => $request->primary_dark,
                'secondary_light' => $request->secondary_light,
                'secondary_light' => $request->secondary_light,
                'd_id' => $request->d_id,
                'mp_id' => $request->mp_id,
                'credits' => $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'. Distributor '.$d_name.'.',
                'credits_nl' => $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'. Distributeur '.$d_name.'.',
            ];
            Movie::where('id', $id)->update($tmd_details);
            return redirect('/movielist/edit/'.$id)->with('info', 'The Major Details has been updated!');
        }
        elseif($request->d_id == 0 && $request->mp_id != 0)
        {
            $tmd_details = [
                'movie_title' => $request->movie_title,
                'director' => $request->director,
                'producer' => $request->producer,
                'writer' => $request->writer,
                'actors' => $request->actors,
                'youtube_url' => $request->youtube_url,
                'duration' => $request->duration,
                'base_url' => $request->base_url,
                'image1' => $request->image1,
                'fb_link' => $request->fb_link,
                'twitter_link' => $request->twitter_link,
                'hashtag' => $request->hashtag,
                'fb_pixel' => $request->fb_pixel,
                'google_pixel' => $request->google_pixel,
                'primary_light' => $request->primary_light,
                'primary_dark' => $request->primary_dark,
                'secondary_light' => $request->secondary_light,
                'secondary_light' => $request->secondary_light,
                'd_id' => $request->d_id,
                'mp_id' => $request->mp_id,
                'credits' => $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'. Promotion '.$mp_name.'.',
                'credits_nl' => $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'. Promotie '.$mp_name.'.',
            ];
            Movie::where('id', $id)->update($tmd_details);
            return redirect('/movielist/edit/'.$id)->with('info', 'The Major Details has been updated!');
        }
        else
        {
            $tmd_details = [
                'movie_title' => $request->movie_title,
                'director' => $request->director,
                'producer' => $request->producer,
                'writer' => $request->writer,
                'actors' => $request->actors,
                'youtube_url' => $request->youtube_url,
                'duration' => $request->duration,
                'base_url' => $request->base_url,
                'image1' => $request->image1,
                'fb_link' => $request->fb_link,
                'twitter_link' => $request->twitter_link,
                'hashtag' => $request->hashtag,
                'fb_pixel' => $request->fb_pixel,
                'google_pixel' => $request->google_pixel,
                'primary_light' => $request->primary_light,
                'primary_dark' => $request->primary_dark,
                'secondary_light' => $request->secondary_light,
                'secondary_light' => $request->secondary_light,
                'd_id' => $request->d_id,
                'mp_id' => $request->mp_id,
                'credits' => $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'. Distributor '.$d_name.'. Promotion '.$mp_name.'.',
                'credits_nl' => $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'. Distributeur '.$d_name.'. Promotie '.$mp_name.'.',
            ];
            Movie::where('id', $id)->update($tmd_details);
            return redirect('/movielist/edit/'.$id)->with('info', 'The Major Details has been updated!');
        }
    }

    public function en_edit(Request $request, $id)
    {
        $en_details = [
            'movie_description_short' => $request->movie_description_short,
            'movie_description_long' => $request->movie_description_long,
            'buy_tickets' => $request->buy_tickets,
            'cookies' => $request->cookies_en,
            'terms_of_use' => $request->terms_of_use,
            'privacy_policy' => $request->privacy_policy,
            'credits' => $request->credits
        ];

        Movie::where('id', $id)->update($en_details);
        return redirect('/movielist/edit/'.$id)->with('info', 'EN Details has been updated!');
    }

    public function nl_edit(Request $request, $id)
    {
        $nl_details = [
            'movie_description_short_nl' => $request->movie_description_short_nl,
            'movie_description_long_nl' => $request->movie_description_long_nl,
            'buy_tickets_nl' => $request->buy_tickets_nl,
            'cookies_nl' => $request->cookies_nl,
            'terms_of_use_nl' => $request->terms_of_use_nl,
            'privacy_policy_nl' => $request->privacy_policy_nl,
            'credits_nl' => $request->credits_nl
        ];

        Movie::where('id', $id)->update($nl_details);
        return redirect('/movielist/edit/'.$id)->with('info', 'NL Details has been updated!');
    }
    
    public function theaterlist()
    {
        $theaterlist = Location::orderBy('name', 'ASC')->get();
        return view('theaterlist', compact('theaterlist'));
    }

    public function theater_create(Request $request)
    {
        $request->validate([
            'name' => 'unique:show_location_static',
            'phone' => 'unique:show_location_static',
            'long' => 'numeric',
            'lat' => 'numeric'
        ]);

        $name = $request->name;
        $address = $request->address;
        $zip = $request->zip;
        $city = $request->city;
        $phone = $request->phone;
        $long = $request->long;
        $lat = $request->lat;
        $website = $request->website;

        $theater_details = [
            'name' => $name,
            'address' => $address,
            'zip' => $zip,
            'city' => $city,
            'phone' => $phone,
            'long' => $long,
            'lat' => $lat,
            'website' => $website
        ];
        Location::insert($theater_details);
        return back()->with('info', 'Theater: '. $name. ' has been created');
    }

    public function theater_delete($id)
    {
        Location::where('id', $id)->delete();
        return back()->with('info', 'Theater has been deleted!');
    }

    public function theater_edit($id)
    {
        $theater_details = Location::where('id', $id)->first();
        return view('theater-edit', compact('id', 'theater_details'));
    }

    public function theater_edit_post(Request $request, $id)
    {
        $name = $request->name;
        $theater_details = [
            'name' => $request->name,
            'address' => $request->address,
            'zip' => $request->zip,
            'city' => $request->city,
            'phone' => $request->phone,
            'long' => $request->long,
            'lat' => $request->lat,
            'website' => $request->website
        ];
        Location::where('id', $id)->update($theater_details);
        return back()->with('info', 'Theater '.$name. ' has been updated!');
    }

    public function d_list()
    {
        $d_list = Distributor::get();
        return view('d_list', compact('d_list'));
    }

    public function d_create(Request $request)
    {
        $request->validate([
            'd_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->d_logo->extension();  
        $request->d_logo->move(public_path('distributors'), $imageName);

        $d_details = [
            'name' => $request->d_name,
            'email' => $request->d_email,
            'logo' => $imageName,
        ];
        Distributor::insert($d_details);
        return back()->with('info', 'Distributor created!');
    }

    public function d_edit(Request $request, $id)
    {
        $d_details = Distributor::where('id', $id)->first();
        return view('d_edit', compact('d_details', 'id'));
    }

    public function d_edit_post(Request $request, $id)
    {
        $request->validate([
            'd_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $d_details = Distributor::where('id', $id)->first();

        if($request->has('d_logo'))
        {
            unlink(public_path('distributors/'.$d_details['logo']));

            $imageName = time().'.'.$request->d_logo->extension();  
            $request->d_logo->move(public_path('distributors'), $imageName);
        }
        else
        {
            $imageName = $d_details['logo'];
        }

        $d_details = [
            'name' => $request->d_name,
            'email' => $request->d_email,
            'logo' => $imageName,
        ];
        Distributor::where('id', $id)->update($d_details);
        return back()->with('info', 'Distributor updated!');
    }

    public function d_delete(Request $request, $id)
    {
        Distributor::where('id', $id)->delete();
        return back()->with('info', 'Distributor is deleted');
    }
    
    public function mp_list()
    {
        $mp_list = MediaPartner::get();
        return view('mp_list', compact('mp_list'));
    }

    public function mp_create(Request $request)
    {
        $request->validate([
            'mp_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->mp_logo->extension();  
        $request->mp_logo->move(public_path('media_partners'), $imageName);

        $mp_details = [
            'name' => $request->mp_name,
            'email' => $request->mp_email,
            'logo' => $imageName,
        ];
        MediaPartner::insert($mp_details);
        return back()->with('info', 'Media Partner created!');
    }

    public function mp_edit(Request $request, $id)
    {
        $mp_details = MediaPartner::where('id', $id)->first();
        return view('mp_edit', compact('mp_details', 'id'));
    }

    public function mp_edit_post(Request $request, $id)
    {
        $request->validate([
            'mp_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $mp_details = MediaPartner::where('id', $id)->first();

        if($request->has('mp_logo'))
        {
            unlink(public_path('media_partners/'.$mp_details['logo']));

            $imageName = time().'.'.$request->mp_logo->extension();  
            $request->mp_logo->move(public_path('media_partners'), $imageName);
        }
        else
        {
            $imageName = $mp_details['logo'];
        }

        $mp_details = [
            'name' => $request->mp_name,
            'email' => $request->mp_email,
            'logo' => $imageName,
        ];
        MediaPartner::where('id', $id)->update($mp_details);
        return back()->with('info', 'Media Partner updated!');
    }

    public function mp_delete(Request $request, $id)
    {
        MediaPartner::where('id', $id)->delete();
        return back()->with('info', 'Media Partner is deleted');
    }

    public function reviews_list($id)
    {
        $movie_details = Movie::where('id', '=', $id)->first();
        $reviews = Review::join('movie_details', 'movie_details.id', '=', 'reviews.movie_id')
                            ->select('reviews.id', 'movie_details.movie_title', 'reviews.review_text', 'reviews.language', 'reviews.source', 'reviews.source_link', 'reviews.ratings')
                            ->where('movie_details.id', '=', $id)
                            ->get();

        return view('reviews', compact('reviews', 'movie_details', 'id'));
    }

    public function reviews_create(Request $request, $id)
    {
        $movie_details = Movie::where('id', '=', $id)->first();
        $review_details = [
            'movie_id' => $id,
            'review_text' => $request->review_text,
            'language' => $request->language,
            'source' => $request->source,
            'source_link' => $request->source_link,
            'ratings' => $request->rating
        ];
        Review::insert($review_details);
        return back()->with('info', 'Review created for '.$movie_details['movie_title']);
    }

    public function reviews_delete(Request $request, $id)
    {
        Review::where('id', '=', $id)->delete();
        return back()->with('warning', 'Review has been deleted!');
    }

    public function reviews_edit($id)
    {
        $movie_list = Movie::where('is_delete', 0)->get();
        $review_details = Review::join('movie_details', 'movie_details.id', '=', 'reviews.movie_id')
                                ->select('reviews.id', 'reviews.movie_id', 'movie_details.movie_title', 'reviews.review_text', 'reviews.language', 'reviews.source', 'reviews.source_link', 'reviews.ratings')
                                ->where('reviews.id', '=', $id)
                                ->first();

        return view('edit-reviews', compact('review_details', 'movie_list', 'id'));
    }

    public function reviews_edit_post(Request $request, $id)
    {
        $movie_details = Movie::where('id', '=', $request->movie_id)->first();
        $review_details = [
            'movie_id' => $request->movie_id,
            'review_text' => $request->review_text,
            'language' => $request->language,
            'source' => $request->source,
            'source_link' => $request->source_link,
            'ratings' => $request->rating
        ];
        Review::where('id', '=', $id)->update($review_details);
        return back()->with('info', 'Review updated for '.$movie_details['movie_title']);
    }

    public function user_manual()
    {
        return view('user_manual');
    }

    public function is_active(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        if($status == 1)
        {
            Showtime::where('id', '=', $id)->update(['is_active' => 1]);
            return 'true';
        }
        elseif($status == 0)
        {
            Showtime::where('id', '=', $id)->update(['is_active' => 0]);
            return 'false';
        }
        else
        {
            return 'error';
        }
    }
}

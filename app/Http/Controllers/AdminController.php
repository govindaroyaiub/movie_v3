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
use Stichoza\GoogleTranslate\GoogleTranslate;

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
                                ->orderBy('movie_details.id', 'desc')
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
                                ->orderBy('movie_details.id', 'desc')
                                ->get();

        }

        return view('movielist', compact('movie_list', 'user_list', 'd_list', 'mp_list'));
    }

    public function movie_create_view()
    {
        $d_list = Distributor::get();
        $mp_list = MediaPartner::get();
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
        return view('create-movie', compact('movie_list', 'user_list', 'd_list', 'mp_list'));
    }

    public function movie_create(Request $request)  
    {
        $movie_title = $request->movie_title;
        $release_date = $request->release_date;
        $hashTag = str_replace(' ', '_', strtoupper($movie_title));
        
        $default_theater_list = array(82, 3, 276, 262, 250, 232, 234, 224, 202, 195, 175, 167, 157, 524, 143, 137, 118, 114, 102, 99, 523, 67, 65, 61, 46, 54, 41, 38, 32, 26, 31, 24, 21, 14, 11, 20, 55, 132, 30, 20, 69, 94, 111, 213, 242, 248, 273, 246);

        if($request->d_id == 0 && $request->mp_id == 0)
        {
            $credits =  $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'.';
            $credits_nl = $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'.';
            $credits_fr = $request->movie_title.' est dirigé par '.$request->director.', avec des acteurs '.$request->actors.' Scénariste et Producteur '.$request->writer.', '.$request->producer.'.';
        }
        elseif($request->d_id != 0 && $request->mp_id == 0)
        {
            $distributor = Distributor::where('id', '=', $request->d_id)->select('name')->first();
            $d_name = $distributor['name'];

            $credits = $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'. Distributor '.$d_name.'.';
            $credits_nl = $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'. Distributeur '.$d_name.'.';
            $credits_fr = $request->movie_title.' est dirigé par '.$request->director.', avec des acteurs '.$request->actors.' Scénariste et Producteur '.$request->writer.', '.$request->producer.'. Distributeur '.$d_name.'.';
        }
        elseif($request->d_id == 0 && $request->mp_id != 0)
        {
            $media_partner = MediaPartner::where('id', '=', $request->mp_id)->select('name')->first();
            $mp_name = $media_partner['name'];

            $credits = $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'. Promotion '.$mp_name.'.';
            $credits_nl = $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'. Promotie '.$mp_name.'.';
            $credits_fr = $request->movie_title.' est dirigé par '.$request->director.', avec des acteurs '.$request->actors.' Scénariste et Producteur '.$request->writer.', '.$request->producer.'. Promotion '.$mp_name.'.';
        }
        else
        {
            $distributor = Distributor::where('id', '=', $request->d_id)->select('name')->first();
            $media_partner = MediaPartner::where('id', '=', $request->mp_id)->select('name')->first();
            $d_name = $distributor['name'];
            $mp_name = $media_partner['name'];

            $credits = $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'. Distributor '.$d_name.'. Promotion '.$mp_name.'.';
            $credits_nl = $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'. Distributeur '.$d_name.'. Promotie '.$mp_name.'.';
            $credits_nl = $request->movie_title.' est dirigé par '.$request->director.', avec des acteurs '.$request->actors.' Scénariste et Producteur '.$request->writer.', '.$request->producer.'. Distributeur '.$d_name.'. Promotion '.$mp_name.'.';
        }

        $movie_details = [
            'movie_title' => $request->movie_title,
            'base_url' => 'https://movie.planetnine.com/'.$request->base_url,
            'google_sheet' => $request->google_sheet,
            'uploaded_by' => $request->client_id,
            'director' => $request->director,
            'producer' => $request->producer,
            'writer' => $request->writer,
            'actors' => $request->actors,
            'hashtag' => '#'.$hashTag,
            'buy_tickets' => "Get Tickets",
            'cookies' => "We make use of cookies on this website. A cookie is a simple small file that is sent along with pages from this website and stored by your browser on your hard drive on your computer. You can disable these cookies via your browser [or via your profile page] but this can affect the functioning of our website. negatively affects the website.",
            'terms_of_use' => "The use of the information on this website is free as long as you do not copy, distribute or otherwise use or misuse this information. You may only reuse the information on this website in accordance with the regulations of mandatory law.",
            'privacy_policy' => "You have the right to request access to and correction or deletion of your data. See our contact page for this. To prevent misuse, we may ask you to identify yourself adequately. When it comes to accessing personal data linked to a cookie, you must send a copy of the cookie in question.",
            'credits' => $credits,
            'buy_tickets_nl' => "Naar Theater",
            'cookies_nl' => "Wij maken op deze website gebruik van cookies. Een cookie is een eenvoudig klein bestandje dat met pagina's van deze website wordt meegestuurd en door uw browser op uw harde schrijf van uw computer wordt opgeslagen.U kunt deze cookies uitzetten via uw browser [of via uw profielpagina] maar dit kan het functioneren van onze website negatief aantasten.",
            'terms_of_use_nl' => "Het gebruik van de informatie op deze website is gratis zolang u deze informatie niet kopieert, verspreidt of op een andere manier gebruikt of misbruikt. U mag de informatie op deze website alleen hergebruiken volgens de regelingen van het dwingend recht.",
            'privacy_policy_nl' => "U heeft het recht om te vragen om inzage in en correctie of verwijdering van uw gegevens. Zie hiervoor onze contactpagina. Om misbruik te voorkomen kunnen wij u vragen om u adequaat te identificeren. Wanneer het gaat om inzage in persoonsgegevens gekoppeld aan een cookie, dient u een kopie van het cookie in kwestie mee te sturen.",
            'credits_nl' => $credits_nl,
            'buy_tickets_fr' => "Horaires dans cinéma",
            'cookies_fr' => "Nous utilisons des cookies sur ce site Web. Un cookie est un simple petit fichier envoyé avec des pages de ce site Web et stocké par votre navigateur sur le disque dur de votre ordinateur. Vous pouvez désactiver ces cookies via votre navigateur [ou via votre page de profil], mais cela peut affecter le fonctionnement de notre site Web négativement.",
            'terms_of_use_fr' => "L'utilisation des informations sur ce site Web est gratuite tant que vous ne copiez pas, ne distribuez pas ou n'utilisez pas ou n'utilisez pas ces informations à mauvais escient. Vous ne pouvez réutiliser les informations sur ce site Web que conformément aux dispositions de la loi impérative.",
            'privacy_policy_fr' => "Vous avez le droit de demander l'accès, la correction ou la suppression de vos données. Consultez notre page de contact pour cela. Pour éviter les abus, nous pouvons vous demander de vous identifier de manière adéquate. Lorsqu'il s'agit d'accéder aux données personnelles liées à un cookie, vous devez envoyer une copie du cookie en question.",
            'credits_fr' => $credits_nl,
            'primary_light' => "#353B48",
            'primary_dark' => "#353B48",
            'secondary_light' => "#353B48",
            'secondary_dark' => "#353B48",
            'd_id' => $request->d_id,
            'mp_id' => $request->mp_id,
            'is_delete' => 0
        ];
        Movie::insert($movie_details);

        $movie_list = Movie::select('id')->orderBy('id', 'DESC')->first();
        $last_movie_id = $movie_list['id'];
        foreach($default_theater_list as $dl)
        {
            $getTheaterInfo = Location::select('*')->where('id', $dl)->first();

            $st1 = "https://";
            $st2 = $getTheaterInfo['website'];

            $st1 .= $st2;
  
            $data = [
                'cinema_id' => $dl,
                'date' => $release_date,
                'url' => $st1,
                'is_active' => 1,
                'two_d' => 1,
                'three_d' => 0,
                'movie_id' => $last_movie_id
            ];

            Showtime::insert($data);
        }
        return redirect('/home')->with('success', $movie_title.' has been created with showtimes!');
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
        if($request->d_id == 0 && $request->mp_id == 0)
        {
            $credits = $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'.';
            $credits_nl = $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'.';
        }
        elseif($request->d_id != 0 && $request->mp_id == 0)
        {
            $distributor = Distributor::where('id', '=', $request->d_id)->select('name')->first();
            $d_name = $distributor['name'];

            $credits = $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'. Distributor '.$d_name.'.';
            $credits_nl =  $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'. Distributeur '.$d_name.'.';
        }
        elseif($request->d_id == 0 && $request->mp_id != 0)
        {
            $media_partner = MediaPartner::where('id', '=', $request->mp_id)->select('name')->first();
            $mp_name = $media_partner['name'];

            $credits = $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'. Promotion '.$mp_name.'.';
            $credits_nl = $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'. Promotie '.$mp_name.'.';
        }
        else
        {
            $distributor = Distributor::where('id', '=', $request->d_id)->select('name')->first();
            $media_partner = MediaPartner::where('id', '=', $request->mp_id)->select('name')->first();
            $d_name = $distributor['name'];
            $mp_name = $media_partner['name'];

            $credits = $request->movie_title.' is directed by '.$request->director.', with actors '.$request->actors.' Writer and Producer '.$request->writer.', '.$request->producer.'. Distributor '.$d_name.'. Promotion '.$mp_name.'.';
            $credits_nl = $request->movie_title.' is geregisseerd door '.$request->director.', met acteurs '.$request->actors.' Schrijvers en Regie producent '.$request->writer.', '.$request->producer.'. Distributeur '.$d_name.'. Promotie '.$mp_name.'.';
        }

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
            'secondary_dark' => $request->secondary_dark,
            'd_id' => $request->d_id,
            'mp_id' => $request->mp_id,
            'credits' => $credits,
            'credits_nl' => $credits_nl,
        ];

        Movie::where('id', $id)->update($tmd_details);
        return redirect('/movielist/edit/'.$id)->with('info', 'The Major Details has been updated!');   
    }

    public function en_edit(Request $request, $id)
    {
        $en_details = [
            'movie_description_short' => $request->movie_description_short,
            'tagline_en' => $request->tagline_en,
            'movie_description_long' => $request->movie_description_long,
            'buy_tickets' => $request->buy_tickets,
            'cookies' => $request->cookies_en,
            'terms_of_use' => $request->terms_of_use,
            'privacy_policy' => $request->privacy_policy,
            'credits' => $request->credits
        ];

        Movie::where('id', $id)->update($en_details);
        return redirect('/movielist/edit/'.$id)->with('info', 'English Contents has been updated!');
    }

    public function nl_edit(Request $request, $id)
    {
        $tr = new GoogleTranslate();
        $tr->setSource('nl');
        $tr->setSource();
        $tr->setTarget('en');

        $movie_description_short_en = $tr->translate($request->movie_description_short_nl);
        $tagline_en = $tr->translate($request->tagline_nl);
        $movie_description_long_en = $tr->translate($request->movie_description_long_nl);

        $details = [
            'movie_description_short_nl' => $request->movie_description_short_nl,
            'tagline_nl' => $request->tagline_nl,
            'movie_description_long_nl' => $request->movie_description_long_nl,
            'buy_tickets_nl' => $request->buy_tickets_nl,
            'cookies_nl' => $request->cookies_nl,
            'terms_of_use_nl' => $request->terms_of_use_nl,
            'privacy_policy_nl' => $request->privacy_policy_nl,
            'credits_nl' => $request->credits_nl,
            'movie_description_short' => $movie_description_short_en,
            'tagline_en' => $tagline_en,
            'movie_description_long' => $movie_description_long_en,
        ];

        Movie::where('id', $id)->update($details);

        return redirect('/movielist/edit/'.$id)->with('info', 'Dutch Contents has been updated!');
    }

    public function fr_edit(Request $request, $id)
    {
        $fr_details = [
            'movie_description_short_fr' => $request->movie_description_short_fr,
            'tagline_fr' => $request->tagline_fr,
            'movie_description_long_fr' => $request->movie_description_long_fr,
            'buy_tickets_fr' => $request->buy_tickets_fr,
            'cookies_fr' => $request->cookies_fr,
            'terms_of_use_fr' => $request->terms_of_use_fr,
            'privacy_policy_fr' => $request->privacy_policy_fr,
            'credits_fr' => $request->credits_fr
        ];

        Movie::where('id', $id)->update($fr_details);
        return redirect('/movielist/edit/'.$id)->with('info', 'French Contents has been updated!');
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
        $region = $request->region;
        $country = $request->country;
        $long = $request->long;
        $lat = $request->lat;
        $website = $request->website;

        $theater_details = [
            'name' => $name,
            'address' => $address,
            'zip' => $zip,
            'city' => $city,
            'phone' => $phone,
            'region' => $region,
            'country' => $country,
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
            'country' => $request->country,
            'region' => $request->region,
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

    public function is_two_d(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        if($status == 1)
        {
            Showtime::where('id', '=', $id)->update(['two_d' => 1]);
            return 'true';
        }
        elseif($status == 0)
        {
            Showtime::where('id', '=', $id)->update(['two_d' => 0]);
            return 'false';
        }
        else
        {
            return 'error';
        }
    }

    public function is_three_d(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        if($status == 1)
        {
            Showtime::where('id', '=', $id)->update(['three_d' => 1]);
            return 'true';
        }
        elseif($status == 0)
        {
            Showtime::where('id', '=', $id)->update(['three_d' => 0]);
            return 'false';
        }
        else
        {
            return 'error';
        }
    }

    public function gettheatreurl(Request $request)
    {
        $id = $request->id;
        $td = Location::where('id', '=', $id)->first();
        $theatre_url = $td['website'];
        return $theatre_url;
    }

    public function gettheaters(Request $request)
    {
        $country_name = $request->country_name;

        if($country_name == 'all')
        {
            $theaters = Location::orderBy('name', 'ASC')->get();
        }
        else
        {
            $theaters = Location::where('country', '=', $country_name)->orderBy('name', 'ASC')->get();
        }
        return $theaters;
    }
}

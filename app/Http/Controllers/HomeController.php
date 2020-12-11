<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Hash;
use App\Movie;
use App\Showtime;
use App\Location;
use App\User;
use App\Review;
use App\Distributor;
use App\MediaPartner;
use Auth;

class HomeController extends Controller
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
    public function index()
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

    public function movie_showtime($id)
    {
        $movie_details = Movie::where('id', '=', $id)->first();
        return view('home', compact('id', 'movie_details'));
    }

    public function showtimes($id)
    {
        $md = Movie::where('id', '=', $id)->first();
        $ms = Showtime::join('show_location_static', 'show_location_static.id', 'movie_showtimes.cinema_id')
                        ->select(
                            'movie_showtimes.id', 
                            'movie_showtimes.date',
                            'movie_showtimes.url', 
                            'show_location_static.name', 
                            'show_location_static.address',
                            'show_location_static.zip',
                            'show_location_static.phone',
                            'show_location_static.city',
                            'show_location_static.region',
                            'show_location_static.country',
                            'movie_showtimes.is_active',
                            'movie_showtimes.two_d',
                            'movie_showtimes.three_d')
                        ->where('movie_showtimes.movie_id', '=', $id)
                        ->orderBy('show_location_static.city', 'ASC')
                        ->get();

        $country_list = Location::select('country')->distinct('country')->get();
        return view('showtime-list', compact('md', 'ms', 'id', 'country_list'));
    }

    public function showtimes_add(Request $request, $id)
    {
        $data = [
            'cinema_id' => $request->theatre_id,
            'date' => $request->start_date,
            'url' => $request->url,
            'is_active' => 0,
            'two_d' => 0,
            'three_d' => 0,
            'movie_id' => $id
        ];
        Showtime::insert($data);
        return redirect('/showtimes/'.$id)->with('success', 'Theatre Added!');
    }

    public function showtimes_edit($id)
    {
        $ms = Showtime::join('show_location_static', 'show_location_static.id', 'movie_showtimes.cinema_id')
                        ->select(
                            'movie_showtimes.id', 
                            'movie_showtimes.date',
                            'movie_showtimes.url', 
                            'show_location_static.name', 
                            'show_location_static.address',
                            'show_location_static.zip',
                            'show_location_static.phone',
                            'show_location_static.city')
                        ->where('movie_showtimes.id', '=', $id)
                        ->first();
        return view('edit-showtime', compact('ms', 'id'));
    }

    public function showtimes_edit_post(Request $request, $id)
    {
        $movie_id = Showtime::select('movie_id')->where('id', '=', $id)->first();
        $start_date = $request->start_date;
        $url = $request->url;

        $sd = [
            'url' => $url,
            'date' => $start_date
        ];
        Showtime::where('id', '=', $id)->update($sd);
        return redirect('/showtimes/'.$movie_id['movie_id']);
    }

    public function showtimes_delete($id)
    {
        Showtime::where('id', '=', $id)->delete();
        return back()->with('info', 'Showtime has been deleted!');
    }

    public function showtimes_update(Request $request, $id)
    {
        $data = [
            'date' => $request->start_date
        ];
        Showtime::where('movie_id', '=', $id)->update($data);
        return back()->with('info', 'Updated!');
    }

    public function upload(Request $request, $id)
    {
        //validate the xls file
        $this->validate($request, array(
        'file'      => 'required'
        ));
        if($request->hasFile('file'))
        {
            $movie_id = $id;

            $check_location_data = Location::first();
            $check_showtime_data = Showtime::first();
            $check_movie_details = Movie::first();

            $file = $request->file('file')->getClientOriginalName();
            $request->file->move(public_path('/'), $file);

            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(TRUE);
            $spreadsheet = $reader->load($file);

            $worksheet1 = $spreadsheet->getSheet(0);
            $worksheet2 = $spreadsheet->getSheet(1);

            $location_list = [];
            $showtime_list = [];
            $full_movie_details = [];

            $title = new \Imdb\Title(7374926);
            $rating = $title->rating();

            $movie_details = Movie::where('id', '=', $movie_id)->first();

            if($worksheet1)
            {
                $highestRow = $worksheet1->getHighestDataRow();
                $highestColumn = $worksheet1->getHighestDataColumn();
                $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
                for ($row = 2; $row <= $highestRow; ++$row) {
                    $name = $worksheet1->getCellByColumnAndRow(2, $row)->getValue();
                    $address = $worksheet1->getCellByColumnAndRow(4, $row)->getValue();
                    $zip = $worksheet1->getCellByColumnAndRow(5, $row)->getValue();
                    $city = $worksheet1->getCellByColumnAndRow(6, $row)->getValue();
                    $phone = $worksheet1->getCellByColumnAndRow(7, $row)->getValue();
                    $lat = $worksheet1->getCellByColumnAndRow(8, $row)->getValue();
                    $long = $worksheet1->getCellByColumnAndRow(9, $row)->getValue();
                    $website = $worksheet1->getCellByColumnAndRow(10, $row)->getValue();
                    $region = $worksheet1->getCellByColumnAndRow(11, $row)->getValue();
                    $country = $worksheet1->getCellByColumnAndRow(12, $row)->getValue();

                    if($name != NULL)
                    {
                        $location = [
                            'name' => $name,
                            'address' => $address,
                            'zip' => $zip,
                            'city' => $city,
                            'phone' => $phone,
                            'long' => $long,
                            'lat' => $lat,
                            'website' => $website,
                            'region' => $region,
                            'country' => $country
                        ];
                        array_push($location_list, $location);
                    }
                }
                if($check_location_data == NULL)
                {
                    Location::insert($location_list);
                }
                else
                {
                    Location::truncate();
                    Location::insert($location_list);
                }
            }

            if($worksheet2)
            {   
                $movie_details = Movie::where('id', '=', $movie_id)->first();
                $highestRow = $worksheet2->getHighestDataRow(); 
                $highestColumn = $worksheet2->getHighestDataColumn(); 
            
                $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

                for ($row = 2; $row <= $highestRow; ++$row) {
                    $cinema_details = $worksheet2->getCellByColumnAndRow(2, $row)->getValue();
                    $start_date = $request->start_date;
                    $url = $worksheet2->getCellByColumnAndRow(3, $row)->getValue();
                    $two_d = $worksheet2->getCellByColumnAndRow(4, $row)->getValue();
                    $three_d = $worksheet2->getCellByColumnAndRow(5, $row)->getValue();
                    $movie_id = $movie_details['id'];
                    
                    $cinema_id = explode(" ", $cinema_details);

                    if($url == NULL)
                    {
                        $theatre_details = Location::where('id', '=', $cinema_id[0])->first();
                        if(isset($theatre_details['website']))
                        {
                            $website = $theatre_details['website'];
                        }
                    }
                    else
                    {
                        $website = $url;
                    }

                    if($two_d == NULL)
                    {
                        $two_d = 0;
                    }
                    elseif($two_d != NULL)
                    {
                        if($two_d == 'YES' || $two_d == 'yes' || $two_d == 'Yes')
                        {
                            $two_d = 1;
                        }
                        else
                        {
                            $two_d = 0;
                        }
                    }

                    if($three_d == NULL)
                    {
                        $three_d = 0;
                    }
                    elseif($three_d != NULL)
                    {
                        if($three_d == 'YES' || $three_d == 'yes' || $three_d == 'Yes')
                        {
                            $three_d = 1;
                        }
                        else
                        {
                            $three_d = 0;
                        }
                    }

                    if($cinema_details != NULL)
                    {
                        $showtime = [
                            'cinema_id' => $cinema_id[0],
                            'date' => $start_date,
                            'time' => " ",
                            'url' => $website,
                            'is_active' => 0,
                            'two_d' => $two_d,
                            'three_d' => $three_d,
                            'movie_id' => $movie_id
                        ];
                        array_push($showtime_list, $showtime);
                    }
                }
                if($check_showtime_data == NULL)
                {
                    Showtime::insert($showtime_list);
                }
                else
                {
                    //if data exists on the table, check for other data which is not matched with the current one. First save them and insert all together
                    Showtime::where('movie_id', $movie_details['id'])->delete();
                    $other_showtime_data = Showtime::select('cinema_id', 'date', 'url', 'time', 'movie_id', 'two_d', 'three_d')->get()->toArray();
                    if($other_showtime_data != NULL)
                    {
                        Showtime::truncate();
                        Showtime::insert($showtime_list);
                        Showtime::insert($other_showtime_data);
                    }
                    else
                    {
                        Showtime::truncate();
                        Showtime::insert($showtime_list);
                    }
                }
            }

            
            return back()->with('success', 'File Uploaded!');
        }
    }

    public function update_info(Request $request)
    {
        $username = $request->name;
        $email = $request->email;
        $new_password = $request->new_password;
        $repeat_password = $request->repeat_password;
        $user_info = User::where('id', Auth::user()->id)->first();
        $old_password =$user_info['password'];

        if($new_password != $repeat_password)
        {
            return back()->with('error', 'Sorry Password Did Not Match!');
        }
        else
        {
            User::where('id', Auth::user()->id)->update(['password' => bcrypt($new_password), 'name' => $username, 'email' => $email]);
            Auth::logout();
            return redirect('/login')->with('success', 'Credentials Updated. Please Login Again');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $userCity = Auth::user()->city;
        $jsonString = file_get_contents(base_path('storage/city.json'));
        $cities = json_decode($jsonString, true);
        return view('home',compact('cities','userCity'));
        return view('home');
    }
}

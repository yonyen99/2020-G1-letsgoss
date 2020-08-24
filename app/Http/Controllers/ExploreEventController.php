<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Join_event;
use App\Event;
// use MaddHatter\LaravelFullcalendar\Facades\Calendar;
class ExploreEventController extends Controller
{
    /**
    * Display a listing event.
    *
    * @return \Illuminate\Http\Response
    */
    public function onlyEventJoin()
    {
        $exploreEvent = Event::all()->sortBy('start_date');
        $joins= Join_event::all();
        $jsonString = file_get_contents(base_path('storage/city.json'));
        $userCity = Auth::user()->city;
        $cities = json_decode($jsonString, true);
        $joinEvent = Join_event::where('user_id',Auth::id())->get();
        $user = User::find(Auth::id());
        $user->check = 1;
        $user->save();
        return view('exploreEvent.onlyEventJoin',compact('exploreEvent', 'joins','joinEvent','cities','userCity'));
    }

    /**
    * Store specific event
    *
    * @param data
    * @return value of check if user checkbox
    */
    public function isCheckEvent($data)
    {
        $user = User::find(Auth::id());
        $user->check = $data;
        $user->save();
        return redirect('exploreEvent');
    }
    /**
    * Store specific event
    *
    * @param data
    * @return value of check if user uncheckbox
    */
    public function isNotcheck($data)
    {
        $user = User::find(Auth::id());
        $user->check = $data;
        $user->save();
        return redirect('onlyeventjoin');
    }
    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_users extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function event(){
        return $this->belongsTo(Event::class);
    }
}

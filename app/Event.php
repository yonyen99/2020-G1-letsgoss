<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Category;
use App\Join_event;
class Event extends Model

{
    protected $fillable = ['title','start_date','end_date'];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'cat_id');
    }
    public function joins(){
        return $this->hasMany(Join_event::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'image',
        'caption'
    ];
  
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function like(){
        return $this->hasMany('App\Like');
    }
}

<?php

namespace MyVideos;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'lrv_videos';

    //Relation one to many
    public function comments(){
    	return $this->hasMany('MyVideos\Comment')->orderBy('id','desc');
    }

    //Relation many to one
    public function user(){
    	return $this->belongsTo('MyVideos\User', 'user_id');
    }
}

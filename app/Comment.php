<?php

namespace MyVideos;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'lrv_comments';

    //Relation many to one
    public function user(){
    	return $this->belongsTo('MyVideos\User', 'user_id');
    	//return $this->belongsTo('MyVideos\User', 'lrv_users_id');
    }

    public function video(){
    	return $this->belongsTo('MyVideos\Video', 'video_id');
    	//return $this->belongsTo('MyVideos\User', 'lrv_users_id');
    }
}

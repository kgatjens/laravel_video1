<?php

namespace MyVideos\Http\Controllers;

use Illuminate\Http\Request;

use MyVideos\Video;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$videos = DB::table('videos')->paginate(5);//query builder
        // $videos = Video::orderBy('id','desc')
        // ->paginate(5);

        $videos = Video::with('user')->orderBy('id', 'desc')->paginate(5);

        return view('home',array(
            'videos'=>$videos
        ));
    }
}

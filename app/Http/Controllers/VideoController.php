<?php

namespace MyVideos\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; //store the videos
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\UploadedFile;


use MyVideos\Video;
use MyVideos\Comment;


class VideoController extends Controller
{
    public function createVideo(){
    	return view('video.createVideo');
    }

    public function saveVideo(Request $request){
    	$validate = $this->validate($request, [
    		'title'=>'required|min:5',
    		'description'=>'required',
    		'image'=>'required|mimes:jpeg,bmp,png|image|max:1000',
    		'video'=>'required|mimes:mp4'
    	]);

    	$video 	= new Video();
    	$user	= \Auth::user();
    	$video->user_id = $user->id;
		$video->title 	= $request->input('title');
		$video->description 	= $request->input('description');    
		
		//$image = $request->file('image');		
		//$image = $request->image;

		if($request->hasFile('image')) {
			
			$fileName = time()."_".str_slug($request->input('title'), '_').".".request()->image->getClientOriginalExtension();
			$request->image->storeAs('images',$fileName);
			$video->image = $fileName;
		}else {
        	//dd('No image was found');
    	}

    	if($request->hasFile('video')) {
			
			$fileName = time()."_video_".str_slug($request->input('title'), '_').".".request()->video->getClientOriginalExtension();
			$request->video->storeAs('videos',$fileName);
			$video->video_path = $fileName;
		}else {
        	//dd('No image was found');
    	}

		$video->save();		

		return redirect()->route('home')->with(array(
			"message"=>'Video Uploaded Succesfully'
		));
    }

    public function getImage($filename){
    	$file = Storage::disk('images')->get($filename);
    	return new Response($file, 200);
    }

}

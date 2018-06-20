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

    public function getVideoDetail($video_id){
        
        $video = Video::with('comments')->find($video_id);

        if($video){
            return view('video.detail', array(
                'video'=>$video
            ));
        }
    }

    public function getVideo($filename){
        $file = Storage::disk('videos')->get($filename);
        return new Response($file, 200);
    }

    public function delete($video_id){
        $user = \Auth::user();
        $video= Video::find($video_id);
        $comments = Comment::where('video_id', $video_id)->get();

        if($user && $video->user_id == $user->id){
            //Delete comments
            if($comments && count($comments)>=1){
                Comment::where('video_id', $video_id)->get()->each->delete();
            }

            //Delete storage
            Storage::disk('images')->delete($video->image);
            Storage::disk('videos')->delete($video->video_path);

            //Delete registers
            $video->delete();     
            $message = array('message'=>'Video deleted Succesfully!');
        }else{
            $message = array('message'=>'Video not deleted');
        }

        return redirect()->route('home')->with($message);
    }

    public function edit($video_id){
        $user = \Auth::user();
        $video= Video::find($video_id);

        if($user && $video->user_id == $user->id){
            //Edit comments
            $video = Video::findOrFail($video_id);
            return view('video.edit', array('video'=>$video));
            
        }else{
            return redirect()->route('home');
        }


        
    }


}

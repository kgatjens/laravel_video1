@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit video</div>

                <div class="card-body">
                    <h1>Edit {{$video->title}}</h1>
                    <form action="{{url('save-video')}}" method="post" enctype="multipart/form-data" class="col-lg-7">
                    		{!! csrf_field() !!}

                    		@if($errors->any())
                    			<div class="aler alert-danger">
                    				<ul>
                    					@foreach($errors->all() as $error)
                    						<li>{{$error}}</li>
                    					@endforeach
                    				</ul>
                    			</div>
                    		@endif

                    		<div class="form-group">
                    			<label for="title">Title</label>
                    			<input type="text" class="form-control" id="title" name="title" value="{{$video->title}}"/>
                    		</div>

                    		<div class="form-group">
                    			<label for="description">Description</label>
                    			<input type="text" class="form-control" id="description" name="description" value="{{$video->description}}"/>
                    		</div>

                    		<div class="form-group">
                    			<label for="image">Thumbnail</label>
                    			<input type="file" class="form-control" id="image" name="image"/>
                                
                                @if(Storage::disk('images')->has($video->image))
                                <div class="video-image-thumb col-md-5">
                                    <div class="video-image-mask">
                                        <img class="video-image" src="{{url('/thumbnail/'.$video->image)}}" />
                                    </div>
                                </div>
                                @endif
                    		</div>

                    		<div class="form-group">
                                
                    			<label for="video">Video file</label>
                    			<input type="file" class="form-control" id="video" name="video"/>
                                <video controls id="video-player">
                                    <source src="{{route('fileVideo',['filename'=>$video->video_path])}}"></sources>
                                Your browser not support html5
                                </video>
                    		</div>

                    		<button type="submit" class="btn btn-success">Edit Video</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



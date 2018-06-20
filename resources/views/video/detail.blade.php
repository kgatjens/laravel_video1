@extends('layouts.app')

@section('content')

<div class="col-md-10 col-md-2-offset-1">
	<h2>{{$video->title}}</h2>
	<hr/>

	<div class="col-md-8">
		<video controls id="video-player">
			<source src="{{route('fileVideo',['filename'=>$video->video_path])}}"></sources>
			Your browser not support html5
		</video>
		<!-- description -->
		<div class="panel panel-default video-data">
			<div class="panel-heading">
				<div class="panel-title">
					Uploaded by: <strong>{{$video->user->name.' '.$video->user->surname}}</strong> on {{\FormatTime::LongTimeFilter($video->created_at)}}
				</div>
			</div>
			<div class="panel-body">
				{{$video->description}}
			</div>
		</div>
		<!-- comments -->
		
		@include('video.comments')

	</div>
</div>

@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
            @if(session('message'))
                <div class="aler alert-success">
                    {{session('message')}}
                </div>
            @endif

            <ul id="video-list">
                @foreach($videos as $video)
                    <div class="video-item col-md-10 pull-left card">
                        <div class="card-body"> 
                            @if(Storage::disk('images')->has($video->image))
                                <div class="video-image-thumb col-md-5">
                                    <div class="video-image-mask">
                                        <img class="video-image" src="{{url('/thumbnail/'.$video->image)}}" />
                                    </div>
                                </div>
                            @endif
                                <div class="data col-md-5">
                                    <h4 class="video-title"><a href="{{route('detailVideo',['video_id'=>$video->id])}}">{{$video->title}}</a></h4>
                                    <p>{{$video->user->surname." ".$video->user->surname}}</p>
                                </div>

                                <a href="{{route('detailVideo',['video_id'=>$video->id])}}" class="btn btn-success">Detail</a>
                                @if(Auth::check() && Auth::user()->id == $video->user->id)
                                    <a href="{{url('/edit-video/'.$video->id)}}" class="btn btn-warning">Edit</a>
                                    <a href="#deleteVideo{{$video->id}}" role="button" class="btn btn-large btn-primary" data-toggle="modal">Delete Video</a>

                                    <!-- Modal Overlay en HTML -->
                                    <div id="deleteVideo{{$video->id}}" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Delete?</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Do you wan to delete this element?</p>
                                                    <p class="text-warning"><small>{{$video->title}}</small></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <a href="{{url('/delete-video/'.$video->id)}}" type="button" class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                        </div> 
                    </div> 
                @endforeach
            </ul>
        </div>

        {{$videos->links()}}

    </div>
</div>
@endsection

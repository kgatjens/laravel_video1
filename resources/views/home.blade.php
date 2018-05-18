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
                                    <h4 class="video-title"><a href="">{{$video->title}}</a></h4>
                                    <p>{{$video->user->surname}}</p>
                                </div>
                        </div> 
                    </div> 
                @endforeach
            </ul>
        </div>

        {{$videos->links()}}

    </div>
</div>
@endsection

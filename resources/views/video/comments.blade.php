</hr>
<h4>Comments</h4>
</hr>
@if(session('message'))
    <div class="aler alert-success">
        {{session('message')}}
    </div>
@endif
@if(Auth::check())
<form class="col-md-4" method="POST" action="{{url('/comment')}}">
	{!! csrf_field() !!}

	<input type="hidden" name="video_id" value="{{$video->id}}" required />
	<p>
		<textarea class="form-control" name="body" required></textarea>
	</p>
	<input type="submit" value="Comment" class="btn btn-success">
</form>
<div class="clearfix"></div>
<hr/> 
@endif

@if(isset($video->comments))
	<div id="comments-list">
		@foreach($video->comments as $comment)
			<div class="comment-item col-md-12 pull-left">

			<div class="panel panel-default comment-data">
				<div class="panel-heading">
					<div class="panel-title">
						<strong>{{$comment->user->name.' '.$comment->user->surname}}</strong> on {{\FormatTime::LongTimeFilter($comment->created_at)}}
					</div>
				</div>
				<div class="panel-body">
					{{$comment->body}}
				</div>
				@if(Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()->id == $video->user_id))
				<div class="pull-right">
					<a href="#deleteComment{{$comment->id}}" role="button" class="btn btn-large btn-primary" data-toggle="modal">Delete Comment</a>
					  
					<!-- Modal Overlay en HTML -->
					<div id="deleteComment{{$comment->id}}" class="modal fade">
					    <div class="modal-dialog">
					        <div class="modal-content">
					            <div class="modal-header">
					                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                <h4 class="modal-title">Delete?</h4>
					            </div>
					            <div class="modal-body">
					                <p>Do you wan to delete this element?</p>
					                <p class="text-warning"><small>{{$video->description}}</small></p>
					            </div>
					            <div class="modal-footer">
					                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					                <a href="{{url('/delete-comment/'.$comment->id)}}" type="button" class="btn btn-danger">Delete</a>
					            </div>
					        </div>
					    </div>
					</div>
				</div>
			@endif
			</div>

			</div>
		@endforeach
	</div>
@endif
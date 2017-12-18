@extends('layouts.master')

@section('title')
{{ $discussion->title }}
@stop

@section('content')

@include('shared.form_errors')

<div class="card mb-4">
	<div class="card-header">
		<div class="clearfix">
			<h4 class="card-title float-left">{{ $discussion->title }}</h4>
			@auth
				@if($discussion->isBeingWatchedByAuth())
					<a class="btn btn-info btn-sm float-right" href="{{ route('unwatch', ['discussion' => $discussion->id]) }}" role="button">Unwatch</a>
				@else
					<a class="btn btn-info btn-sm float-right" href="{{ route('watch', ['discussion' => $discussion->id]) }}" role="button">Watch</a>
				@endif
			@endauth
		</div>
		<span class="text-muted card-subtitle">
			Posted on {{ $discussion->created_at->toFormattedDateString() }}&nbsp;
			by <a href="#">{{ $discussion->user->name }}</a>&nbsp;
			under topic <a href="{{ route('topics.show', ['topic' => $discussion->topic_id]) }}">{{ $discussion->topic->name }}</a>
		</span>
	</div>
	<div class="card-body">
		<p class="card-text">
			{!! Markdown::convertToHtml($discussion->body) !!}
		</p>

		@if($discussion->hasBestReply())
			<hr>
			<h5 class="my-4">Best Answer</h5>
			<div class="card">
				<div class="card-body">
					{!! Markdown::convertToHtml($discussion->bestReply()->content) !!}
				</div>
				<div class="card-footer">
					<span class="text-muted float-left">
						Posted on {{ $discussion->bestReply()->created_at->toFormattedDateString() }}&nbsp;
						by <a href="#">{{ $discussion->bestReply()->user->name }}</a>&nbsp;
					</span>
					@if($discussion->isAuthOwner())
						<a href="{{ route('replies.best', ['reply' => $discussion->bestReply()->id]) }}" class="btn btn-sm btn-primary float-right mr-2">Unmark as best</a>
					@endif
				</div>
			</div>
		@endif
	</div>
</div>

@if($discussion->replies->count() > 0)
	@foreach($discussion->replies as $reply)
		<div class="card mb-4">
			<div class="card-body">
				<p class="card-text mt-3">
					{!! Markdown::convertToHtml($reply->content) !!}
				</p>
			</div>
			<div class="card-footer">
				<span class="text-muted float-left">
					Posted on {{ $reply->created_at->toFormattedDateString() }}&nbsp;
					by <a href="#">{{ $reply->user->name }}</a>&nbsp;
				</span>
				@if(auth()->id() == $reply->user_id)
					<form action="{{ route('replies.destroy', ['reply' => $reply->id]) }}" method="POST">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button class="btn btn-sm btn-danger float-right">Delete</button>
					</form>
					
					<a href="{{ route('replies.edit', ['reply' => $reply->id]) }}" class="btn btn-sm btn-info float-right mr-2">Edit</a>
				@endif

				@if(!$discussion->hasBestReply() && $discussion->isAuthOwner())
					<a href="{{ route('replies.best', ['reply' => $reply->id]) }}" class="btn btn-sm btn-primary float-right mr-2">Mark best</a>
				@endif
			</div>
		</div>
	@endforeach
@else
	<div class="card mb-4">
		<div class="card-body text-center">
			<h6 class="text-muted">There is no reply for this discussion.</h6>
		</div>
	</div>
@endif

	@auth
		<form action="{{ route('replies.store') }}" method="POST">
			{{ csrf_field() }}
			
			<input type="hidden" name="discussion_id" value="{{ $discussion->id }}">

			<fieldset class="form-group">
				<textarea name="content" id="content" rows="8" class="form-control" placeholder="Enter your comment"></textarea>
			</fieldset>

			<fieldset class="form-group">
				<button type="submit" class="btn btn-primary float-right">Post</button>
			</fieldset>
		</form>
	@endauth
@stop
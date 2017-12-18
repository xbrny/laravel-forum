@extends('layouts.master')

@section('title')
Home
@stop

@section('content')
	@if($discussions->count() > 0)

		@foreach($discussions as $discussion)
			<div class="card mb-4">
				<div class="card-header">
					<div class="float-left">
						<img src="/{{ $discussion->user->avatar }}" alt="" class="img-thumbnail mr-1" width="30" height="30">
						<span>{{ $discussion->user->name }}</span>
						<span>( {{ $discussion->user->points }} points )</span>
					</div>

					@if($discussion->user_id == auth()->id())
						<div>
							<form action="{{ route('discussions.destroy', ['slug' => $discussion->slug]) }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<button class="btn btn-sm btn-danger float-right" type="submit">Delete</button>
							</form>
							<a class="btn btn-info btn-sm float-right mr-2" href="{{ route('discussions.edit', ['discussion' => $discussion->slug]) }}" role="button">Edit</a>
						</div>
					@endif
				</div>

				<div class="card-body">
					<h4 class="card-title">
						<a href="{{ route('discussions.show', ['discussion' => $discussion->slug]) }}">{{ $discussion->title }}</a>
				        <span class="badge badge-primary ml-2">{{ $discussion->topic->name }}</span>
				        @if($discussion->hasBestReply())
					        <span class="badge badge-success ml-2">Solved</span>
				        @endif
				    </h4>

					<h6 class="mb-2 card-subtitle text-muted">Posted on {{ $discussion->created_at->toFormattedDateString() }}</h6>

					<p class="card-text">{{ str_limit($discussion->body, 100) }}</p>
				</div>
			</div>
		@endforeach

		<div class="float-right">
			{{ $discussions->links('vendor.pagination.bootstrap-4') }}
		</div>
	@else
		<div class="card mb-4">
			<div class="card-body text-center">
				<h6 class="text-muted">There is no discussion to display</h6>
			</div>
		</div>
	@endif
@stop
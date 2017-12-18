@extends('layouts.master')

@section('title')
Edit answer
@stop

@section('content')
@include('shared.form_errors')

<div class="card">
	<div class="card-header">
		Update Answer
	</div>
	<div class="card-body">
		<form action="{{ route('replies.update', ['reply' => $reply->id]) }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			
			<fieldset class="form-group">
				<textarea name="content" id="content" rows="10" class="form-control" placeholder="Enter your comment">{{ $reply->content }}</textarea>
			</fieldset>

			<fieldset class="form-group float-right">
				<a class="btn btn-white mr-2" href="{{ url()->previous() }}" role="button">Back</a>
				<button type="submit" class="btn btn-primary">Save Changes</button>
			</fieldset>
		</form>
	</div>
</div>
@stop
@extends('layouts.master')

@section('title')
Create Discussion
@stop

@section('content')

<div class="card">
	<div class="card-header">
		Create Discussion
	</div>
	<div class="card-body">
		
		@include('shared.form_errors')

		<form action="{{ route('discussions.store') }}" method="POST">

			{{ csrf_field() }}

			<fieldset class="form-group">
				<label for="title">Title</label>
				<input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
			</fieldset>

			<fieldset class="form-group">
				<label for="topic">Select a topic</label>
				<select name="topic_id" id="topic" class="form-control">
					@foreach($topics as $topic)
						<option value="{{ $topic->id }}"
							@if(old('topic_id') == $topic->id)
								selected
							@endif 
							>{{ $topic->name }}</option>
					@endforeach
				</select>
			</fieldset>

			<fieldset class="form-group">
				<label for="body">Content</label>
				<textarea name="body" id="body" rows="10" class="form-control">{{ old('body') }}</textarea>
			</fieldset>

			<fieldset class="form-group float-right">
				<a class="btn btn-white" href="{{ url()->previous() }}" role="button">Back</a>
				<button type="submit" class="btn btn-primary">Create</button>
			</fieldset>
		</form>
	</div>
</div>

@stop
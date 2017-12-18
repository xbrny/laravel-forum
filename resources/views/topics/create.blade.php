@extends('layouts.master')

@section('title')
Topics
@stop

@section('content')

<div class="card">
	<div class="card-header">
		Create Topic
	</div>
	<div class="card-body">
		
		@include('shared.form_errors')

		<form action="{{ route('topics.store') }}" method="POST">

			{{ csrf_field() }}

			<fieldset class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
			</fieldset>
			<fieldset class="form-group float-right">
				<a class="btn btn-white" href="{{ url()->previous() }}" role="button">Back</a>
				<button type="submit" class="btn btn-primary">Create</button>
			</fieldset>
		</form>
	</div>
</div>

@stop
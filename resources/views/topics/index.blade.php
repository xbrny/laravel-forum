@extends('layouts.master')

@section('title')
Topics
@stop

@section('content')

<div class="card">
	<div class="card-header">
		Topics
	</div>
	<div class="card-body">
		<table class="table table-responsive">
			<thead>
				<tr>
					<th class="w-75">Name</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				@foreach($topics as $topic)
					<tr>
						<td>{{ $topic->name }}</td>
						<td>
							<a class="btn btn-primary btn-sm" href="{{ route('topics.edit', ['topic' => $topic->slug]) }}" role="button">Edit</a>
						</td>
						<td>
							<form action="{{ route('topics.destroy', ['topic' => $topic->slug]) }}" method="POST">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<button class="btn btn-danger btn-sm" type="submit" role="button">Delete</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop
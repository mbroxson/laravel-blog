@extends('layout')

@section('main-section')
	<div class="row">
		<div class="large-12 columns">
			<h1>{{ $post->title }}</h1>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			{{ $post->username }} ({{ $post->first_name }} {{ $post->last_name }})
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			{{ $post->post }}
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<h3>Comments</h3>
		</div>
	</div>
	@foreach ($comments as $comment)
		<div class="row">
			<div class="large-3 medium-3 columns">
				{{ $comment->username }} ({{ $comment->first_name }}  {{ $comment->last_name }})
			</div>
			<div class="large-9 medium-9 columns">
				{{ $comment->comment }}
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<hr>
			</div>
		</div>
	@endforeach
	<div class="row">
		<div class="large-12 column">
			<h4>Add new comment</h4>
		</div>
	</div>
	<form data-abide method="post" action="comment">
		<input type="hidden" name="post_id" value="{{ $post_id }}">
		<div class="row">
			<div class="large-12 column">
				<textarea name="comment" id="comment"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="large-12 column">
				<input type="submit" value="Save Comment" class="tiny round button">
			</div>
		</div>
	</form>
@stop

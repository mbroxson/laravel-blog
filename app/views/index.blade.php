@extends('layout')

@section('main-section')
	<div class="row">
		<div class="large-12 columns">
			<h1>Blog post</h1>
		</div>
	</div>
	<div class="row">
		<div class="large-1 medium-1 columns">
			<label for="author" class="right inline">Author</label>
		</div>
		<div class="large-5 medium-5 columns">
			<select name="author" onchange="location.href = '{{ URL::to('/') }}?author=' + this.value;">
				<option value="">All authors</option>
				@foreach ($authors as $author)
					@if ($selectedAuthor == $author->username)
						<option value="{{ $author->username }}" selected>{{ $author->username }}</option>
					@else
						<option value="{{ $author->username }}">{{ $author->username }}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="large-6 medium-6 columns">
			<a href="{{ URL::to('post') }}" class="button tiny inline right">New Post</a>
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			<hr>
		</div>
	</div>
	@foreach ($posts as $post)
		<a href="{{ URL::to('/view') }}?post={{ $post->id }}" title="{{  $post->title }}">
			<div class="row">
				<div class="large-9 medium-9 columns">
					<h3>{{ $post->title }}</h3>
				</div>
				<div class="large-3 medium-3 columns">
					{{ $post->username }} ({{ $post->first_name }} {{ $post->last_name }})
				</div>
				<div class="large-12 columns">
					<hr>
				</div>
			</div>
		</a>
	@endforeach
	<div class="row">
		<div class="large-12 columns">
			{{ $posts->links() }}
		</dvi>
	</div>
@stop

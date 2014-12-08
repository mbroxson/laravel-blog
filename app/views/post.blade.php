@extends('layout')

@section('main-section')
	<div class="row">
		<div class="large-12 columns">
			<h1>Create new blog post</h1>
		</div>
	</div>
	<form data-abide method="post" action="post">
		<div class="row">
			<div class="large-12 columns">
				<label for="title">Title <small>required</small></label>
				<input type="text" name="title" id="title" placeholder="Title" required>
				<small class="error">You must enter a title.</small>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<label for="post">Post <small>required</small></label>
				<textarea name="post" id="post" class="ckeditor" reauired></textarea>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<input type="submit" value="Post" class="small round button">
			</div>
		</div>
	</form>
@stop

@extends('layout')

@section('main-section')
	<div class="row">
		<div class="large-12 columns">
			<h1>Log in to this blog</h1>
		</div>
	</div>
	@if (isset($message))
	<div data-alert class="alert-box alert round">
		{{{ $message or '' }}}
		<a href="#{" class="close">&times;</a>
	</div>
	@endif
	<form data-abide method="post" action="login">
		<div class="row">
			<div class="large-12 columns">
				<label for="username">Username ("test" works)</label>
				<input type="text" name="username" id="username" placeholder="Username" required pattern="alpha_numeric">
				<small class="error">You must enter a username to log in.</small>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<label for="password">Password ("test" works)</label>
				<input type="password" name="password" id="password" required pattern="alpha_numeric">
				<small class="error">You must enter your password to log in.</small>
			</div>
		</div>
		<div class="row">
			<div class="large-6 columns">
				<input type="submit" value="Login" class="small round button">
			</div>
			<div class="large-6 columns">
				<a href="{{ URL::to('/register') }}" class="small round button right">Register</a>
			</div>
		</div>
	</form>
@stop

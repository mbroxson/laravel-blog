@extends('layout')

@section('main-section')
	<div class="row">
		<div class="large-12 columns">
			<h1>Register for this blog</h1>
		</div>
	</div>
	@if (isset($message))
	<div data-alert class="alert-box alert round">
		{{{ $message or '' }}}
		<a href="#{" class="close">&times;</a>
	</div>
	@endif
	<form data-abide method="post" action="register">
		<div class="row">
			<div class="large-6 medium-6 columns">
				<label for="first_name">First Name <small>required</small></label>
				<input type="text" name="first_name" id="first_name" placeholder="First Name" required pattern="alpha">
				<small class="error">First Name is required and must be a string.</small>
			</div>
			<div class="large-6 medium-6 columns">
				<label for="last_name">Last Name <small>required</small></label>
				<input type="text" name="last_name" id="last_name" placeholder="Last Name" required pattern="alpha">
				<small class="error">Last Name is required and must be a string.</small>
			</div>
		</div>
		<div class="row">
			<div class="large-6 medium-6 columns">
				<label for="email">Email <small>required</small></label>
				<input type="text" name="email" id="email" placeholder="Email Address" required pattern="email">
				<small class="error">Email Address is required.</small>
			</div>
			<div class="large-6 medium-6 columns">
				<label for="username">Username <small>required</small></label>
				<input type="text" name="username" id="username" placeholder="Username" required pattern="alpha_numeric">
				<small class="error">Last Name is required and must be a string or numbers.</small>
			</div>
		</div>
		<div class="row">
			<div class="large-6 medium-6 columns">
				<label for="password">Password <small>required</small></label>
				<input type="password" name="password" id="password" required pattern="alpha_numeric">
				<small class="error">Password is required and can be alpha-numeric.</small>
			</div>
			<div class="large-6 medium-6 columns">
				<label for="password">Confirm Password <small>required</small></label>
				<input type="password" name="password2" id="password2" required pattern="alpha_numeric">
				<small class="error">Password is required and can be alpha-numeric.</small>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<input type="checkbox" name="terms" id="terms" required value="yes">
				<label for="terms">I agree to the terms and conditions that do not exists. <small>required</small></label>
				<small class="error">You must accept the terms and conditions.</small>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<input type="submit" value="Register" class="small round button">
			</div>
		</div>
	</form>
@stop

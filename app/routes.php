<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array(
    'before' => 'auth', function()
	{
		$authors = DB::table('posts')
			->join('users', 'users.id', '=', 'posts.user_id')
			->select('users.username')
			->distinct()
			->get();
		$selectedAuthor = '';
		if (Input::get('author') !== null && Input::get('author') != '') {
			$posts = DB::table('posts')
				->join('users', 'users.id', '=', 'posts.user_id')
				->select('users.username', 'users.first_name', 'users.last_name', 'posts.title', 'posts.post', 'posts.id')
				->where('users.username', '=', Input::get('author'))
				->orderBy('posts.created_at', 'desc')
				->paginate(5);
			$selectedAuthor = Input::get('author');
		} else {
			$posts = DB::table('posts')
				->join('users', 'users.id', '=', 'posts.user_id')
				->select('users.username', 'users.first_name', 'users.last_name', 'posts.title', 'posts.post', 'posts.id')
				->orderBy('posts.created_at', 'desc')
				->paginate(5);
		}
		return View::make('index')->with('authors', $authors)->with('posts', $posts)->with('selectedAuthor', $selectedAuthor);
	}
));

Route::get('/register', function()
{
	return View::make('register');
});

Route::post('/register', function() {
	$user = new User;
	$user->email = Input::get('email');
	$user->username = Input::get('username');
	$user->first_name = Input::get('first_name');
	$user->last_name = Input::get('last_name');
	$user->password = Hash::make(Input::get('password'));
	$user->remember_token = '';
	if (Input::get('password') != Input::get('password2')) {
		return View::make('register')->with('message', 'Passwords do not match.');
	} elseif (Input::get('terms') != 'yes') {
		return View::make('register')->with('message', 'You must accept the terms and conditions.');
	} else {
		$check = DB::table('users')->where('username', '=', Input::get('username'))->orWhere(function($query) { $query->where('email', '=', Input::get('email')); })->get();
		if (sizeof($check) == 0) {
			$user->save();
			//$credentials = Input::only('username', 'password');
			//Auth::attemt($credentials);
			return View::make('index');
		} else {
			return View::make('register')->with('message', 'The email or username entered are already registered.');
		}
	}
});

Route::get('/login', function()
{
    return View::make('login');
});

Route::post('/login', function()
{
	$credentials = Input::only('username', 'password');
	if (Auth::attempt($credentials)) {
		return Redirect::intended('/');
	}
	return View::make('login')->with('messgae', 'Username or password invalid.');
});


Route::get('/logout', function()
{
    Auth::logout();
    return View::make('login')->with('message', 'You have successfully logged out.');
});

Route::get('/post', array(
    'before' => 'auth', function()
	{
		return View::make('post');
	}
));

Route::post('/post', array(
	'before' => 'auth', function()
	{
		$post = new Post;
		$post->user_id = Auth::user()->id;
		$post->title = Input::get('title');
		$post->post = Input::get('post');
		$post->save();
		return Redirect::intended('/');
	}
));

Route::get('/view', array(
	'before' => 'auth', function()
	{
		$post = DB::table('posts')
			->join('users', 'users.id', '=', 'posts.user_id')
			->select('users.username', 'users.first_name', 'users.last_name', 'posts.title', 'posts.post')
			->where('posts.id', '=', Input::get('post'))
			->get()[0];
		$comments = DB::table('comments')
			->join('users', 'users.id', '=', 'comments.user_id')
			->select('users.username', 'users.first_name', 'users.last_name', 'comments.comment')
			->where('comments.post_id', '=', Input::get('post'))
			->get();
		return View::make('view')->with('post', $post)->with('comments', $comments)->with('post_id', Input::get('post'));
	}
));

Route::post('/comment', array(
	'before' => 'auth', function()
	{
		$comment = new Comment();
		$comment->user_id = Auth::user()->id;
		$comment->post_id = Input::get('post_id');
		$comment->comment = Input::get('comment');
		$comment->save();

		$post = DB::table('posts')
			->join('users', 'users.id', '=', 'posts.user_id')
			->select('users.username', 'users.first_name', 'users.last_name', 'posts.title', 'posts.post')
			->where('posts.id', '=', Input::get('post_id'))
			->get()[0];
		$comments = DB::table('comments')
			->join('users', 'users.id', '=', 'comments.user_id')
			->select('users.username', 'users.first_name', 'users.last_name', 'comments.comment')
			->where('comments.post_id', '=', Input::get('post_id'))
			->get();
		return View::make('view')->with('post', $post)->with('comments', $comments)->with('post_id', Input::get('post'));
	}
));

Route::get('/recent/feed', function() {
	$posts = DB::table('posts')
		->join('users', 'users.id', '=', 'posts.user_id')
		->select('users.username', 'users.first_name', 'users.last_name', 'posts.title', 'posts.post', 'posts.id', 'posts.created_at');
	if (Input::get('author') !== null && Input::get('author') != '') {
		$posts->where('users.username', '=', Input::get('author'));
	}
	if (Input::get('limit') !== null && Input::get('limit') != '') {
		$posts->limit(10);
	}
	$posts->orderBy('posts.created_at', 'desc');
	$output = array();
	foreach ($posts->get() as $post) {
		$item = array(
				'title' => $post->title,
				'link' => URL::to('/view') . '?post=' . $post->id,
				'author' => $post->username . ' (' . $post->first_name . ' ' . $post->last_name . ')',
				'description' => substr($post->post, 0, 100),
				'created' => $post->created_at
			);
		$output[] = $item;
	}
	return json_encode($output);
});

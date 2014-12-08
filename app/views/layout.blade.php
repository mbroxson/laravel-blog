<DOCTYPE html>
<html>
	<head>
		<title>Blog</title>
		{{ HTML::style(asset('css/foundation.css')) }}
		{{ HTML::script(asset('js/vendor/modernizr.js')) }}
		{{ HTML::script(asset('js/vendor/jquery.js')) }}
		{{ HTML::script(asset('js/foundation.min.js')) }}
		{{ HTML::script(asset('ckeditor/ckeditor.js')) }}
	</head>
	<body>
		<div class="row">
			<div class="small-12 columns">
				<div class="off-canvas-wrap" data-offcanvas>
					<div class="inner-wrap">
						<nav class="top-bar show-for-medium-up" data-topbar>
							<ul class="title-area">
								<li class="name">
									<h1><a href="{{ URL::to('/') }}">Blog</a></h1>
								</li>
								<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
							</ul>

							<section class="top-bar-section">
								<ul class="right">
									<li><a href="{{ URL::to('/') }}">Home</a></li>
									<li><a href="{{ URL::to('/post') }}">Create Post</a></li>
									<li><a href="{{ URL::to('/recent/feed') }}">json feed</a></li>
									@if (Auth::check())
										<li><a href="{{ URL::to('/logout') }}">Logout</a></li>
									@else
										<li><a href="{{ URL::to('/login') }}">Login</a></li>
									@endif
								</ul>
							</section>
						</nav>

						<nav class="tab-bar show-for-small">
							<section class="left-small">
								<a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
							</section>
							<section class="middle tab-bar-section">
								<h1 class="title">Blog</h1>
							</section>
						</nav>

						<aside class="left-off-canvas-menu">
							<ul class="off-canvas-list">
								<li><label>Menu</label></li>
								<li><a href="{{ URL::to('/') }}">Home</a></li>
								<li><a href="{{ URL::to('/post') }}">Create Post</a></li>
								<li><a href="{{ URL::to('/recent/feed') }}">json feed</a></li>
								@if (Auth::check())
									<li><a href="{{ URL::to('/logout') }}">Logout</a></li>
								@else
									<li><a href="{{ URL::to('/login') }}">Login</a></li>
								@endif
							</ul>
						</aside>

						<section class="main-section">
							@yield('main-section')
						</section>
						<a class="exit-off-canvas"></a>
					</div>
				</div>
			</div>
		</div>
		<script>
			$(document).foundation();
		</script>
	</body>
</html>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			Piece by Peace
			@show
		</title>
		@section('meta_keywords')
		<meta name="keywords" content="your, awesome, keywords, here" />
		@show
		@section('meta_author')
		<meta name="author" content="Piece by peace" />
		@show
		@section('meta_description')
		<meta name="description" content="Página para encontrar tu propio voluntariado" />
                @show
		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
        <link rel="stylesheet" href="{{asset('template/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('template/bootstrap/css/bootstrap-responsive.min.css')}}">

		<style>
        body {
            padding: 60px 0;
        }
		@section("css")
		@show
		</style>

			<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
			<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->

			<!-- Icons -->
			<link href="{{asset('template/icons/general/stylesheets/general_foundicons.css')}}" media="screen" rel="stylesheet" type="text/css" />
			<link href="{{asset('template/icons/social/stylesheets/social_foundicons.css')}}" media="screen" rel="stylesheet" type="text/css" />
			<!--[if lt IE 8]>
			<link href="{{asset('template/icons/general/stylesheets/general_foundicons_ie7.css')}}" media="screen" rel="stylesheet" type="text/css" />
			<link href="{{asset('template/icons/social/stylesheets/social_foundicons_ie7.css')}}" media="screen" rel="stylesheet" type="text/css" />
			<![endif]-->
			<link rel="stylesheet" href="{{asset('template/fontawesome/css/font-awesome.min.css')}}">
			<!--[if IE 7]>
			<link rel="stylesheet" href="{{asset('template/fontawesome/css/font-awesome-ie7.min.css')}}">
			<![endif]-->
			<link href="{{asset('template/carousel/style.css" rel="stylesheet" type="text/css')}}" />
			<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">
			<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">

			<link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css">
			<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
			<link href="{{asset('template/custom.css')}}" rel="stylesheet" type="text/css" />
	</head>


	<body id="pageBody">

	<div id="decorative2">
		<div class="container">

			<div class="divPanel topArea notop nobottom">
				<div class="row-fluid">
					<div class="span12">

						<div id="divLogo" class="pull-left">
							<a href="{{{ URL::to('') }}}" id="divSiteTitle">Piece by peace</a><br />
							<a href="{{{ URL::to('') }}}" id="divTagLine">Eslogan</a>
						</div>

						<div id="divMenuRight" class="pull-right">
							<div class="navbar">
								<button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">
									NAVIGATION <span class="icon-chevron-down icon-white"></span>
								</button>
								<div class="nav-collapse collapse">
									<ul class="nav nav-pills ddmenu">
										<li class="dropdown active"><a href="{{{ URL::to('') }}}">Home</a></li>
										<li class="dropdown"><a href="#">About</a></li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle">Users <b class="caret"></b></a>
											<ul class="dropdown-menu">
												@if (Auth::check())
													@if (Auth::user()->hasRole('admin'))
														<li><a href="{{{ URL::to('admin') }}}">Admin Panel</a></li>
													@endif
													<li><a href="{{{ URL::to('user') }}}">Logged in as {{{ Auth::user()->username }}}</a></li>
													<li><a href="{{{ URL::to('user/logout') }}}">Logout</a></li>
												@else
													<li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">Login</a></li>
													<li {{ (Request::is('volunteer/create') ? ' class="active"' : '') }}><a href="{{{ URL::to('volunteer/create') }}}">{{{ Lang::get('site.volunteer') }}}</a></li>
													<li {{ (Request::is('ngo/create') ? ' class="active"' : '') }}><a href="{{{ URL::to('ngo/create') }}}">{{{ Lang::get('site.ngo') }}}</a></li>
													<li {{ (Request::is('company/create') ? ' class="active"' : '') }}><a href="{{{ URL::to('company/create') }}}">{{{ Lang::get('site.company') }}}</a></li>
												@endif
											</ul>
										</li>
									</ul>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>

		<!-- Container -->
		<div class="container">
			<!-- Notifications -->
			@include('notifications')
			<!-- ./ notifications -->

			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
		</div>
		<!-- ./ container -->

		<!-- the following div is needed to make a sticky footer -->
		<div id="push"></div>
		<div id="footerInnerSeparator"></div>
		</div>
		<!-- ./wrap -->


	<div id="footerOuterSeparator"></div>

	<div id="divFooter" class="footerArea">

		<div class="container">

			<div class="divPanel">

				<div class="row-fluid">
					<div class="span3" id="footerArea1">

						<h3>About Company</h3>

						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s.</p>

						<p>
							<a href="#" title="Terms of Use">Terms of Use</a><br />
							<a href="#" title="Privacy Policy">Privacy Policy</a><br />
							<a href="#" title="FAQ">FAQ</a><br />
							<a href="#" title="Sitemap">Sitemap</a>
						</p>

					</div>
					<div class="span3" id="footerArea2">

						<h3>Recent Blog Posts</h3>
						<p>
							<a href="#" title="">Lorem Ipsum is simply dummy text</a><br />
							<span style="text-transform:none;">2 hours ago</span>
						</p>
						<p>
							<a href="#" title="">Duis mollis, est non commodo luctus</a><br />
							<span style="text-transform:none;">5 hours ago</span>
						</p>
						<p>
							<a href="#" title="">Maecenas sed diam eget risus varius</a><br />
							<span style="text-transform:none;">19 hours ago</span>
						</p>
						<p>
							<a href="#" title="">VIEW ALL POSTS</a>
						</p>

					</div>
					<div class="span3" id="footerArea3">

						<h3>Sample Content</h3>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s.
							Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s.
						</p>

					</div>
					<div class="span3" id="footerArea4">

						<h3>Get in Touch</h3>

						<ul id="contact-info">
							<li>
								<i class="general foundicon-phone icon"></i>
								<span class="field">Phone:</span>
								<br />
								(123) 456 7890 / 456 7891
							</li>
							<li>
								<i class="general foundicon-mail icon"></i>
								<span class="field">Email:</span>
								<br />
								<a href="mailto:info@yourdomain.com" title="Email">info@yourdomain.com</a>
							</li>
							<li>
								<i class="general foundicon-home icon" style="margin-bottom:50px"></i>
								<span class="field">Address:</span>
								<br />
								123 Street<br />
								12345 City, State<br />
								Country
							</li>
						</ul>

					</div>
				</div>

				<br /><br />
				<div class="row-fluid">
					<div class="span12">
						<p class="copyright">
							Copyright © 2013 Your Company. All Rights Reserved.
						</p>

						<p class="social_bookmarks">
							<a href="#"><i class="social foundicon-facebook"></i> Facebook</a>
							<a href="#"><i class="social foundicon-twitter"></i> Twitter</a>
							<a href="#"><i class="social foundicon-pinterest"></i> Pinterest</a>
							<a href="#"><i class="social foundicon-rss"></i> Rss</a>
						</p>
					</div>
				</div>
				<br />

			</div>

		</div>

	</div>


	<!-- Javascripts
    ================================================== -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('template/jquery.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('template/default.js')}}" type="text/javascript"></script>


		<script src="{{asset('template/carousel/jquery.carouFredSel-6.2.0-packed.js')}}" type="text/javascript"></script><script type="text/javascript">$('#list_photos').carouFredSel({ responsive: true, width: '100%', scroll: 2, items: {width: 320,visible: {min: 2, max: 6}} });</script>

	@yield("js")

	</body>
</html>

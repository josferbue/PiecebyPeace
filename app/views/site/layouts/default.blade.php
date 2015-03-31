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
			<link href="http://fonts.googleapis.com/css?family=Palatino+Linotype" rel="stylesheet" type="text/css">
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
													<li {{ (Request::is('user/create') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}">{{{ Lang::get('site.sign_up') }}}</a></li>
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

	<div id="decorative1" style="position:relative">
		<div class="container">

			<div class="divPanel headerArea">
				<div class="row-fluid">
					<div class="span12">

						<div id="headerSeparator"></div>

						<div id="divHeaderText" class="page-content">
							<div id="divHeaderLine1">Your Header Text Here!</div><br />
							<div id="divHeaderLine2">2nd line header text for calling extra attention to featured content..</div><br />
							<div id="divHeaderLine3"><a class="btn btn-large btn-primary" href="#">More Info</a></div>
						</div>

						<div id="headerSeparator2"></div>

					</div>
				</div>

			</div>

		</div>
	</div>

	<div id="contentOuterSeparator"></div>

	<div class="container">

		<div class="divPanel page-content">

			<div class="row-fluid">

				<div class="span12" id="divMain">

					<h1>Welcome</h1>

					<p>Content on this page is for presentation purposes only. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
						Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
						Lorem ipsum dolor sit amet, consectetur adipiscing elit.
					</p>

					<hr style="margin:45px 0 35px" />

					<div class="lead">
						<h2>Lorem ipsum dolor sit amet.</h2>
						<h3>Vivamus leo ante, consectetur sit amet vulputate vel, dapibus sit amet lectus.</h3>
					</div>
					<br />

					<div class="list_carousel responsive">
						<ul id="list_photos">
							<li><img src="{{asset('template/images/carmel.jpg')}}" class="img-polaroid">  </li>
							<li><img src="{{asset('template/images/rula-sibai-pink-flowers.jpg')}}" class="img-polaroid">  </li>
							<li><img src="{{asset('template/images/girl-flowers.jpg')}}" class="img-polaroid">  </li>
							<li><img src="{{asset('template/images/night-city.jpg')}}" class="img-polaroid">  </li>
							<li><img src="{{asset('template/images/irish-hands.jpg')}}" class="img-polaroid">  </li>
							<li><img src="{{asset('template/images/Top_view.jpg')}}" class="img-polaroid">  </li>
							<li><img src="{{asset('template/images/vectorbeastcom-grass-sun.jpg')}}" class="img-polaroid">  </li>
							<li><img src="{{asset('template/images/sunset-hair.jpg')}}" class="img-polaroid">  </li>
							<li><img src="{{asset('template/images/stones-hi-res.jpg')}}" class="img-polaroid">  </li>
							<li><img src="{{asset('template/images/salzburg-x.jpg')}}" class="img-polaroid">  </li>
						</ul>
					</div>

					<hr style="margin:45px 0 35px" />

					<div class="lead">
						<h2>Featured Content.</h2>
						<h3>Content on this page is for presentation purposes only.</h3>
					</div>
					<br />

					<div class="row-fluid">
						<div class="span8">

							<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>

							<p>
								<img src="{{asset('template/images/spring-is-coming.jpg')}}" class="img-polaroid" style="margin:12px 0px;">
							</p>

							<p>Content on this page is for presentation purposes only. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
								Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
								Lorem Ipsum is simply dummy text of the printing and typesetting industry.
							</p>

						</div>
						<div class="span4 sidebar">

							<div class="sidebox">
								<h3 class="sidebox-title">Sample Sidebar Content</h3>
								<p>Lorem Ipsum is simply dummy text of the printing and <a href="#">typesetting industry</a>. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s.</p>
							</div>

							<br />

							<div class="sidebox">
								<h3 class="sidebox-title">Sample Sidebar Content</h3>
								<p>
								<div class="input-append">
									<input class="span8" id="inpEmail" size="16" type="text"><button class="btn" type="button">Action</button>
								</div>
								</p>
							</div>

						</div>
					</div>

				</div>

			</div>

			<div id="footerInnerSeparator"></div>
		</div>

	</div>

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
							<a href=""><i class="social foundicon-twitter"></i> Twitter</a>
							<a href="#"><i class="social foundicon-pinterest"></i> Pinterest</a>
							<a href="#"><i class="social foundicon-rss"></i> Rss</a>
						</p>
					</div>
				</div>
				<br />

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
		</div>
		<!-- ./wrap -->


	    <div id="footer">
	      <div class="container">
	        <p class="muted credit">Laravel 4 Starter Site on <a href="https://github.com/andrew13/Laravel-4-Bootstrap-Starter-Site">Github</a>.</p>
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

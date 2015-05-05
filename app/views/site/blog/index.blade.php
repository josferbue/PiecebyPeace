@extends('site.layouts.default')

{{-- Content --}}
@section('content')
	<div id="decorative1" style="position:relative">
		<div class="container">

			<div class="divPanel headerArea">
				<div class="row-fluid">
					<div class="span12">

						<div id="headerSeparator"></div>

						<div id="divHeaderText" class="page-content">
							<div id="divHeaderLine1">{{{ Lang::get('site.headerLine1') }}}</div><br />
							<div id="divHeaderLine2">{{{ Lang::get('site.headerLine2') }}}</div><br />
							<div id="divHeaderLine3"><a class="btn btn-large btn-primary" href="{{{ URL::to('about') }}}">{{{ Lang::get('site.headerLine3') }}}</a></div>
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

				<div class="span12" id="divmain">

					<div class="lead">
						<h2>lorem ipsum dolor sit amet.</h2>
						<h3>vivamus leo ante, consectetur sit amet vulputate vel, dapibus sit amet lectus.</h3>
					</div>
					<br />

					<div class="list_carousel responsive">
						<ul id="list_photos">
							@foreach($ngos as $ngo)
								<li><img src="{{{ URL::to($ngo->logo) }}}" class="img-responsive">  </li>
							@endforeach
						</ul>
					</div>

					<div class="list_carousel responsive">
						<ul id="list_photos" class="">
							@foreach($companies as $company)
								<li><img src="{{{ URL::to($company->logo) }}}" class="img-responsive">  </li>
							@endforeach
						</ul>
					</div>
				</div>

			</div>


		</div>

	</div>

@stop

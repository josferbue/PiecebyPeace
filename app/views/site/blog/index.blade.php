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

				<div class="span12" id="divMain">

					<div class="lead">
						<h3>Ngos.</h3>
					</div>
					<br />

					<div class="list_carousel responsive">
						<ul id="list_photos">
							@foreach($ngos as $ngo)
								<li><img src="{{{ URL::to($ngo->logo) }}}" class="img-polaroid" style="max-width: 150px">  </li>
							@endforeach
								@foreach($ngos as $ngo)
									<li><img src="{{{ URL::to($ngo->logo) }}}" class="img-polaroid" style="max-width: 150px">  </li>
								@endforeach
								@foreach($ngos as $ngo)
									<li><img src="{{{ URL::to($ngo->logo) }}}" class="img-polaroid" style="max-width: 150px">  </li>
								@endforeach
						</ul>
					</div>

					<div class="lead">
						<h3>Companies.</h3>
					</div>


						<div class="list_carousel responsive">
							<ul id="list_photos">
								@foreach($companies as $company)
									<li><img src="{{{ URL::to($company->logo) }}}" class="img-polaroid" style="max-width: 150px">  </li>
								@endforeach
							</ul>
						</div>


				</div>

			</div>
			<div id="footerInnerSeparator"></div>

		</div>

	</div>

@stop

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
					<h2>{{{ Lang::get('site.ngos') }}}</h2>
					</div>
					<div class="list_carousel responsive">
						<ul id="list_photos1">
							@foreach($ngos as $ngo)
								<li><img src="{{{ URL::to($ngo->logo) }}}" class="img-polaroid" style="max-width: 12em">  </li>
							@endforeach

								</ul>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span12" id="divMain">
					<div class="lead">
						<h2>{{{ Lang::get('site.companies') }}}</h2>
					</div>
						<div class="list_carousel responsive">
							<ul id="list_photos2">
								@foreach($companies as $company)
									<li><img src="{{{ URL::to($company->logo) }}}" class="img-polaroid" style="max-width: 12em ">  </li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div id="footerInnerSeparator"></div>

		</div>

	</div>

@stop
@section('js')
	<script src="{{asset('template/carousel/jquery.carouFredSel-6.2.0-packed.js')}}" type="text/javascript"></script>
	<script type="text/javascript">
		$('#list_photos1').carouFredSel({ responsive: true, width: '100%', scroll: 2, items: {width: 320 ,visible: {min: 2, max: 6}} });
		$('#list_photos2').carouFredSel({ responsive: true, width: '100%', scroll: 2, items: {width: 320 ,visible: {min: 2, max: 6}} });
	</script>
@stop
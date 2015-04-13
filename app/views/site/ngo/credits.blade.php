@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop



{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}

			<div class="pull-right">
				<a href="{{{ URL::to('admin/blogs/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Create</a>
			</div>
		</h3>
	</div>

	<table id="blogs" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-4">{{{ Lang::get('ngo/credits/table.credits') }}}</th>
				<th class="col-md-2">{{{ Lang::get('ngo/credits/table.price') }}}</th>
				<th class="col-md-2">{{{ Lang::get('ngo/credits/table.total') }}}</th>
				<th class="col-md-2"></th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
@stop

{{-- Scripts --}}
@section(js)

@stop
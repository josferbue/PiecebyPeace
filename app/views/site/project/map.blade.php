@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ Lang::get('project/list.titleVolunteer') }}} ::
    @parent
@stop

{{-- Content --}}
@section('content')
    <div style="max-heightwidth: 15em" class="page-header"><h2>{{{ Lang::get('project/list.titleMap') }}}</h2></div>
{{$mapHtml}}
@stop
@section('js')
{{$mapJs}}
@stop
@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ Lang::get('project/list.titleVolunteer') }}} ::
    @parent
@stop

{{-- Content --}}
@section('content')
    <div class="page-header"></div>
{{$mapHtml}}
@stop
@section('js')
{{$mapJs}}
@stop
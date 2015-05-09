@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ Lang::get('ngo/ngo.details').$ngo->name }}} ::
    @parent
@stop

{{-- Content --}}
@section('content')
    <div class="page-header">
        <h1>{{{ Lang::get('ngo/ngo.details').$ngo->name }}}</h1>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="container">
        <div class="row-fluid">
            <div class="pagination-centered">
                <img src="{{ URL::to($ngo->logo)}}" class="img-rounded" />
            </div>
        </div>
    </div>

    <h2><b> {{{ $ngo->name }}} </b></h2>

    <h4> {{{ $ngo->description }}} </h4>

    <h4><b>{{{ Lang::get('ngo/ngo.contactPhone') }}}: </b>{{{ $ngo->phone }}}</h4>

@stop

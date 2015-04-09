@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ Lang::get('campaign/campaign.title') }}} ::
    @parent
@stop

{{-- Content --}}
@section('content')
    <div class="page-header">
        <h1>{{{ Lang::get('campaign/campaign.title') }}}</h1>
    </div>

    {{--Comprobamos que existen campañas y las muestra--}}
    @if ($campaigns=='nothing')
        <div class="row">
            <div class="span3">
                <h3> {{{ Lang::get('campaign/campaign.notFound') }}}</h3>
            </div>
        </div>
    @endif

    @foreach ($campaigns as $campaign)

        <div class="row">

            <div class="span3">
                {{--<div class="thumbnail">--}}
                <a href="{{{ URL::to('campaign/details/'.$campaign->id) }}}"><img src="{{ URL::to($campaign->image)}}" class="img-rounded"
                     alt="{{{ Lang::get('campaign/campaign.notImage') }}}"/></a>

                {{--</div>--}}
            </div>

            <div class="span9">
                <div class="caption">

                    <h3> {{{ Lang::get('campaign/campaign.name') }}} </h3>

                    <a href="{{{ URL::to('campaign/details/'.$campaign->id) }}}"><p>{{$campaign->name }}</p></a>

                    <h3> {{{ Lang::get('campaign/campaign.description') }}} </h3>

                    <p>{{$campaign->description }}</p>

                </div>

            </div>

        </div>

        <hr>

    @endforeach

    <input type="button" onclick="window.location.href='{{{ URL::to('campaign/create') }}}'" value="{{{ Lang::get('campaign/campaign.create') }}}">
@stop
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
    @if (!isset($campaigns))
        <div class="row">
            <div class="span3">
                <h3> {{{ Lang::get('campaign/campaign.notFound') }}}</h3>
            </div>
        </div>
    @elseif($campaigns->getTotal()==0)
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
                <a href="{{{ URL::to('campaign/details/'.$campaign->id) }}}"><img src="{{ URL::to($campaign->image)}}"
                                                                                  class="img-rounded"
                                                                                  alt="{{{ Lang::get('campaign/campaign.notImage') }}}"/></a>

                {{--</div>--}}
            </div>

            <div class="span9">
                <div class="caption">

                    <h3> {{ HTML::link('campaign/details/'.$campaign->id, $campaign->name)}} </h3>

                    <p> {{{$campaign->description }}} </p>

                </div>

            </div>
            @if (Auth::check() && Auth::user()->hasRole('NonGovernmentalOrganization') && $campaign->ngo == Auth::user()->actor())
                <div class="span3">
                    {{--<div class="thumbnail">--}}
                    <input type="button" class="btn btn-info"
                           onclick="window.location.href='{{{ URL::to('ngo/createEmails/'.$campaign->id) }}}'"
                           value="{{{ Lang::get('ngo/ngo.sendEmail') }}}"/>

                    {{--</div>--}}
                </div>
            @endif
        </div>

        <hr>

    @endforeach

    <div class="pagination">
        <input type="button" class="btn btn-primary" onclick="window.location.href='{{ URL::to('/') }}'"
               value="{{ Lang::get('campaign/campaign.back') }}">
        @if(Auth::check() && Auth::user()->hasRole('NonGovernmentalOrganization'))
            <input type="button" class="btn btn-default"
                   onclick="window.location.href='{{{ URL::to('ngo/campaign/create') }}}'"
                   value="{{{ Lang::get('campaign/campaign.create') }}}">
        @endif
        <br>

        @if(isset($campaigns))
            <div class="pull-left">
                {{ $campaigns->links()}}
            </div>
        @endif
    </div>

    {{Session::put('backUrl', Request::url())}}

@stop
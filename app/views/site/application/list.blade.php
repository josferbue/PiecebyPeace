@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ $title }}} ::
    @parent
@stop
<LINK href="{{URL::to('template/bootstrap/css/listProject.css')}}" rel="stylesheet" type="text/css">

{{-- Content --}}
@section('content')
    <div class="page-header">
        <h1> {{{ $title}}}</h1>
    </div>

    {{Session::put('backUrl', Request::url())}}


    @if($applications->getTotal() == 0)
        <h3> {{{ Lang::get('application/list.empty') }}}</h3>

    @else
        <div class="listProject">
            @foreach ($applications as $application)
                <div class="row">
                    <div class="span3">
                        <img src="{{ URL::to($application->project->image)}}" class="img-rounded"
                             alt="{{Lang::get('project/list.notImage') }}"/>
                    </div>
                    <div class="span9">
                        <div class="caption">

                            <h3> {{ HTML::link('/project/view/'.$application->project->id , $application->project->name) }}  </h3>

                            <p>{{ $application->project->description}}</p>

                            <p2> {{$application->project->city}}, {{$application->project->country}} </p2>
                        </div>
                    </div>
                </div>
                <br>
                @if (Auth::user()->hasRole('NonGovernmentalOrganization'))
                    @if(isset($isPending))
                        <input type="button" class="btn btn-primary"
                               onclick="window.location.href='{{ URL::to('ngo/application/listInProject/'.$application->project->id.'/pending') }}'"
                               value="{{ Lang::get('application/list.listInProject') }}">
                    @else
                        <input type="button" class="btn btn-primary"
                               onclick="window.location.href='{{ URL::to('ngo/application/listInProject/'.$application->project->id.'/answered') }}'"
                               value="{{ Lang::get('application/list.listInProject') }}">
                    @endif
                @elseif(Auth::user()->hasRole('COMPANY'))
                    @if(isset($isPending))

                        <input type="button" class="btn btn-primary"
                               onclick="window.location.href='{{ URL::to('company/application/listInProject/'.$application->project->id.'/pending') }}'"
                               value="{{ Lang::get('application/list.listInProject') }}">
                    @else
                        <input type="button" class="btn btn-primary"
                               onclick="window.location.href='{{ URL::to('company/application/listInProject/'.$application->project->id.'/pending') }}'"
                               value="{{ Lang::get('application/list.listInProject') }}">
                    @endif

                @endif
                <hr/>
            @endforeach
        </div>
    @endif

    <hr>
    <div class="pagination">
        {{ $applications->links()}}
    </div>
    <input type="button" class="btn btn-primary"
           onclick="window.location.href='{{ URL::to(Session::get('backUrl')) }}'"
           value="{{ Lang::get('application/list.back') }}">
@stop


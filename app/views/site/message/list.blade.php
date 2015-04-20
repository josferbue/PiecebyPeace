@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ Lang::get('message/list.title') }}} ::
    @parent
@stop
<LINK href="{{URL::to('template/bootstrap/css/listMessages.css')}}" rel="stylesheet" type="text/css">
{{-- Content --}}
@section('content')
    <div class="page-header">
        @if($inbox)
            <h1>    {{{ Lang::get('message/list.titleInbox') }}}  </h1>
        @else
            <h1>    {{{ Lang::get('message/list.titleSent') }}}  </h1>
        @endif
    </div>

    {{Session::put('backUrl', Request::url())}}

    {{--Comprobamos que existen campañas y las muestra--}}
    @if ($emptyMessages)
        <div class="row">
            <div class="span12">
                <h3> {{{ Lang::get('message/list.empty') }}}</h3>
            </div>
        </div>
    @elseif(isset($messages))
        {{ $messages->links()}}
        {{--mostramos los links para paginar--}}
        <div class="listMessages">
            @foreach ($messages as $message)
                <ul class="nav nav-pills ddmenu">
                    <li class="dropdown ">
                        <a href="{{URL::to('message/view/'.$message->id)}}" class="list-group-item active">
                            @if($inbox)
                                 <span class="listMessages">{{{$message->from}}}</span>
                            @else
                                @if(substr($message->to, 0,1)=='(' && substr($message->to, -1)==')')
                                    <span class="listMessages">{{{ Lang::get('message/list.BroadcastAllVolunteers').' '.$message->to }}}</span>
                                @else
                                    <span class="listMessages">{{{$message->to}}}</span>
                                @endif
                            @endif
                            @if(!$message->read)
                                <i class="general foundicon-mail icon"></i>
                            @endif
                                <br> <br>
                            {{{$message->subject}}}
                        </a>
                    </li>
                </ul>
                <hr/>
            @endforeach
        </div>
    @endif
@stop
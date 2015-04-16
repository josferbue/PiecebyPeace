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
            <h1>    {{{ Lang::get('message/listInbox.title') }}}  </h1>
        @else
            <h1>    {{{ Lang::get('message/listSent.title') }}}  </h1>

        @endif
    </div>

    {{--Comprobamos que existen campañas y las muestra--}}
    @if ($emptyMessages)
        <div class="row">
            <div class="span3">
                <h3> {{{ Lang::get('message/list.notFound') }}}</h3>
            </div>
        </div>
    @elseif(isset($messages))
        {{ $messages->links()}}
        {{--mostramos los links para paginar--}}
        <div class="listMessages">
            @foreach ($messages as $message)
                <div class="list-group">
                    @if($inbox)
                        <a href="{{URL::to('message/view/'.$message->message_id)}}" class="list-group-item active"></a>
                        <h4 class="list-group-item-heading">{{{$message->from}}}</h4>
                        <p class="list-group-item-text">{{{$message->subject}}}</p>

                    @else
                        <a href="{{URL::to('message/view/'.$message->id)}}" class="list-group-item active"> </a>

                        <h4 class="list-group-item-heading">{{{$message->to}}}</h4>
                        <p class="list-group-item-text">{{{$message->subject}}}</p>
                    @endif
                </div>
                <hr/>
                <br>
            @endforeach
        </div>
    @endif
@stop
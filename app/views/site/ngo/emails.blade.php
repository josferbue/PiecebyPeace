@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ Lang::get('ngo/ngo.sendEmail') }}} ::
    @parent
@stop

{{-- Content --}}
@section('content')
    <div class="page-header">
        <h1>{{{ Lang::get('ngo/ngo.sendEmail') }}}</h1>
        <h4>{{{ Lang::get('ngo/ngo.numberEmails', array('max' => Volunteer::count())) }}}</h4>
    </div>
    <form method="POST" action="{{{URL::to('ngo/createEmailPayment')  }}}"
          enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
        <input type="hidden" name="idCampaing" value="{{{ $campaignId }}}">
        <input type="hidden" name="campaing" value="{{{ $campaignName }}}">

        <div class="tab-content">
            <div class="row">
                <div class="span6">
                    <h3><b>{{{ $campaignName }}}</b></h3>
                    <br/>
                </div>
            </div>
            <div class="row">
                <div class="span6">
                    <div class="form-group  {{{ $errors->has('numberEmails') ? 'error' : '' }}}">
                        <label for="numberEmails">{{{ Lang::get('ngo/ngo.numberEmailsTitle') }}}</label>
                        <input class="form-control" placeholder="{{{ Lang::get('ngo/ngo.inputNumberEmails') }}}" type="text"
                               name="numberEmails" id="numberEmails" value="0">
                        {{ $errors->first('numberEmails', '<span class="help-block">:message</span>') }}
                    </div>
                </div>
            </div>

            @if ( Session::get('error') )
                <div class="alert alert-error alert-danger">
                    @if ( is_array(Session::get('error')) )
                        {{ head(Session::get('error')) }}
                    @endif
                </div>
            @endif

            @if ( Session::get('notice') )
                <div class="alert">{{ Session::get('notice') }}</div>
            @endif

            <div class="form-actions form-group">
                <button type="submit"
                        class="btn btn-primary">{{{ Lang::get('ngo/ngo.send') }}}</button>
                <input type="button" class="btn btn-primary"
                       onclick="window.location.href='{{ URL::to('/') }}'"

                       value="{{ Lang::get('ngo/ngo.back') }}">
            </div>

        </div>
    </form>
@stop

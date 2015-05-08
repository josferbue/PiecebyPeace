@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ Lang::get('privacyPolicy.title') }}} ::
    @parent
@stop

{{-- Content --}}
@section('content')
    <LINK href="{{URL::to('template/bootstrap/css/faq.css')}}" rel="stylesheet" type="text/css">

    <div class="page-header">
        <h1> {{{ Lang::get('privacyPolicy.title') }}}</h1>
    </div>
    <div class="faq">
    <p> {{{ Lang::get('privacyPolicy.text1') }}} </p>

    <p> {{{ Lang::get('privacyPolicy.text2') }}} </p>

    <p> {{{ Lang::get('privacyPolicy.text3') }}} </p>

    <p> {{{ Lang::get('privacyPolicy.text4') }}} </p>

    <p> {{{ Lang::get('privacyPolicy.text5') }}} </p>

    <p> {{{ Lang::get('privacyPolicy.text6') }}} </p>
</div>
@stop


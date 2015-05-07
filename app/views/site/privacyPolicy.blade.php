@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ Lang::get('privacyPolicy.title') }}} ::
    @parent
@stop

{{-- Content --}}
@section('content')
    <div class="page-header">
        <h1> {{{ Lang::get('privacyPolicy.title') }}}</h1>
    </div>

    <p> {{{ Lang::get('privacyPolicy.text1') }}} </p>

    <p> {{{ Lang::get('privacyPolicy.text2') }}} </p>

    <p> {{{ Lang::get('privacyPolicy.text3') }}} </p>

    <p> {{{ Lang::get('privacyPolicy.text4') }}} </p>

    <p> {{{ Lang::get('privacyPolicy.text5') }}} </p>

    <p> {{{ Lang::get('privacyPolicy.text6') }}} </p>

@stop


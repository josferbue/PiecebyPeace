@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ Lang::get('about.title') }}} ::
    @parent
@stop

{{-- Content --}}
@section('content')
    <div class="page-header">
        <h1> {{{ Lang::get('about.title') }}}</h1>
    </div>

    <div class="span6">
        <br/>

        <p> {{{ Lang::get('about.text1') }}} </p>

        <p> {{{ Lang::get('about.text2') }}} </p>

        <p> {{{ Lang::get('about.text3') }}} </p>

        <p> {{{ Lang::get('about.text4') }}} </p>

        <p> {{{ Lang::get('about.text5') }}} </p>

    </div>

    <div class="span5">
        <img src="../template/images/header.png"
    </div>
@stop


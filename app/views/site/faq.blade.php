@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ Lang::get('faq.title') }}} ::
    @parent
@stop

{{-- Content --}}
@section('content')
    <LINK href="{{URL::to('template/bootstrap/css/faq.css')}}" rel="stylesheet" type="text/css">

    <div class="page-header">
        <h1> {{{ Lang::get('faq.title') }}}</h1>
    </div>
    <div class="faq">

        <h3> {{{ Lang::get('faq.section1') }}} </h3>

        <h6><b> {{{ Lang::get('faq.question1') }}} </b></h6>

        <p> {{{ Lang::get('faq.answer1') }}} </p>

        <h6><b> {{{ Lang::get('faq.question2') }}} </b></h6>

        <p> {{{ Lang::get('faq.answer2') }}} </p>

        <br/>

        <h3> {{{ Lang::get('faq.section2') }}} </h3>

        <h6><b> {{{ Lang::get('faq.question3') }}} </b></h6>

        <p> {{{ Lang::get('faq.answer3') }}} </p>

        <br/>

        <h3> {{{ Lang::get('faq.section3') }}} </h3>

        <h6><b> {{{ Lang::get('faq.question4') }}} </b></h6>

        <p> {{{ Lang::get('faq.answer4') }}} </p>

        <h6><b> {{{ Lang::get('faq.question5') }}} </b></h6>

        <p> {{{ Lang::get('faq.answer5') }}} </p>

        <br/>

        <h3> {{{ Lang::get('faq.section4') }}} </h3>

        <h6><b> {{{ Lang::get('faq.question6') }}} </b></h6>

        <p> {{{ Lang::get('faq.answer6') }}} </p>

        <h6><b> {{{ Lang::get('faq.question7') }}} </b></h6>

        <p> {{{ Lang::get('faq.answer7') }}} </p>

        <h6><b> {{{ Lang::get('faq.question8') }}} </b></h6>

        <p> {{{ Lang::get('faq.answer8') }}} </p>

        <br/>

        <h3> {{{ Lang::get('faq.section5') }}} </h3>

        <h6><b> {{{ Lang::get('faq.question9') }}} </b></h6>

        <p> {{{ Lang::get('faq.answer9') }}} </p>

        <h6><b> {{{ Lang::get('faq.question10') }}} </b></h6>

        <p> {{{ Lang::get('faq.answer10') }}} </p>

        <h6><b> {{{ Lang::get('faq.question11') }}} </b></h6>

        <p> {{{ Lang::get('faq.answer11') }}} </p>

    </div>
@stop


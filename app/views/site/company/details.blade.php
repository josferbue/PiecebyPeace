@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ Lang::get('company/company.details').$company->name }}} ::
    @parent
@stop

{{-- Content --}}
@section('content')
    <div class="page-header">
        <h1>{{{ Lang::get('company/company.details').$company->name }}}</h1>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="container">
        <div class="row-fluid">
            <div class="pagination-centered">
                <img src="{{ URL::to($company->logo)}}" class="img-rounded" />
            </div>
        </div>
    </div>

    <h2><b> {{{ $company->name }}} </b></h2>

    <h4> {{{ $company->description }}} </h4>

    <h4><b>{{{ Lang::get('company/company.sector') }}}: </b>{{{ $company->sector }}}</h4>

    <h4><b>{{{ Lang::get('company/company.contactPhone') }}}: </b>{{{ $company->phone }}}</h4>

@stop

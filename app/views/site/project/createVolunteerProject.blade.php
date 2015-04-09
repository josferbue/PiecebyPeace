@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ Lang::get('project/create.titleVolunteerProject') }}} ::
    @parent
@stop

{{-- Content --}}
@section('content')
    <div class="page-header">
        <h1>{{{ Lang::get('project/create.titleVolunteerProject') }}}</h1>
    </div>
    <form method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
        <!-- ./ csrf token -->
        <div class="row">
            <div class="span4">
                <div class="tab-content">
                    <div class="form-group{{{ $errors->has('name') ? 'error' : '' }}}">
                    <label for="name">{{{ Lang::get('project/create.name') }}}</label>
                    <input class="form-control" placeholder="{{{ Lang::get('project/create.name') }}}" type="text"
                           name="name" id="name" value="{{{ Input::old('name') }}}">
                    {{ $errors->first('name', '<span class="help-block">:message</span>') }}

                </div>


                <div class="form-group  {{{ $errors->has('description') ? 'error' : '' }}}">
                    <label for="description">{{{ Lang::get('project/create.description')}}}</label>
                        <textarea class="form-control" placeholder="{{{ Lang::get('project/create.description') }}}"
                                  rows="6" name="description" id="description"
                                  value="{{{ Input::old('description') }}}"></textarea>
                    {{ $errors->first('description', '<span class="help-block">:message</span>') }}
                </div>

                    <div class="form-group  {{{ $errors->has('maxVolunteers') ? 'error' : '' }}}">
                    <label for="maxVolunteers">{{{ Lang::get('project/create.maxVolunteers') }}}</label>
                    <input class="form-control" placeholder="{{{ Lang::get('project/create.maxVolunteers') }}}"
                           type="text"
                           name="maxVolunteers" id="maxVolunteers" value="{{{ Input::old('maxVolunteers') }}}">
                        {{ $errors->first('maxVolunteers', '<span class="help-block">:message</span>') }}

                    </div>
                <div class="form-group  {{{ $errors->has('image') ? 'error' : '' }}}">
                    <label for="image">{{{ Lang::get('project/create.image') }}}</label>
                    <input class="form-control" type="file" name="image" id="image">
                    {{ $errors->first('image', '<span class="help-block">:message</span>') }}
                </div>
                <button type="submit"
                        class="btn btn-primary">{{{ Lang::get('project/create.save') }}}</button>
            </div>
        </div>

        <div class="span4">

            <div class="form-group  {{{ $errors->has('startDate') ? 'error' : '' }}}">
            <label for="startDate">{{{ Lang::get('project/create.startDate') }}}</label>
            <input type="date" name="startDate" step="1" min="2014-01-01"
                   value="{{date("Y-m-d")}}">
                {{ $errors->first('startDate', '<span class="help-block">:message</span>') }}
            </div>
                <div class="form-group  {{{ $errors->has('finishDate') ? 'error' : '' }}}">
            <label for="finishDate">{{{ Lang::get('project/create.finishDate') }}}</label>
            <input type="date" name="finishDate" step="1" min="2014-01-01"
                   value="{{date("Y-m-d")}}">
                {{ $errors->first('finishDate', '<span class="help-block">:message</span>') }}
                </div>
            <div class="form-group">

                <label for="address">{{{ Lang::get('project/create.address') }}}</label>
                <input class="form-control" placeholder="{{{ Lang::get('project/create.address') }}}"
                       type="text"
                       name="address" id="address" value="{{{ Input::old('address') }}}">
            </div>
            <div class="form-group  {{{ $errors->has('city') ? 'error' : '' }}}">
                <label for="city">{{{ Lang::get('project/create.city') }}}</label>
                <input class="form-control" placeholder="{{{ Lang::get('project/create.city') }}}" type="text"
                       name="city" id="city" value="{{{ Input::old('city') }}}">
                {{ $errors->first('city', '<span class="help-block">:message</span>') }}

            </div>
            <div class="form-group  {{{ $errors->has('zipCode') ? 'error' : '' }}}">
                <label for="zipCode">{{{ Lang::get('project/create.zipCode') }}}</label>
                <input class="form-control" placeholder="{{{ Lang::get('project/create.zipCode') }}}"
                       type="text"
                       name="zipCode" id="zipCode" value="{{{ Input::old('zipCode') }}}">
                {{ $errors->first('zipCode', '<span class="help-block">:message</span>') }}

            </div>
            <div class="form-group  {{{ $errors->has('country') ? 'error' : '' }}}">
                <label for="country">{{{ Lang::get('project/create.country') }}}</label>
                <input class="form-control" placeholder="{{{ Lang::get('project/create.country') }}}"
                       type="text"
                       name="country" id="country" value="{{{ Input::old('country') }}}">
                {{ $errors->first('country', '<span class="help-block">:message</span>') }}

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


    </form>
@stop

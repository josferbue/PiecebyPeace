@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ Lang::get('user/user.register') }}} ::
    @parent
@stop

{{-- Content --}}
@section('content')
    <div class="page-header">
        <h1>{{{ Lang::get('site.ngo') }}}</h1>
    </div>

    <form method="POST" id="idForm"
          action="{{{ (Confide::checkAction('NgoController@store')) ?: URL::to('userNgo')  }}}"
          enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">

        <div class="tab-content">
            <div class="row">
                <div class="span3">
                    @if(!isset($isEdit))
                        <div class="form-group{{{ $errors->has('username') ? 'error' : '' }}}">
                            <label for="username">{{{ Lang::get('confide::confide.username') }}}</label>
                            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}"
                                   type="text"
                                   name="username" id="username" value="{{{ Input::old('username') }}}">
                            {{ $errors->first('username', '<span class="help-block">:message</span>') }}

                        </div>
                    @endif
                    <div class="form-group{{{ $errors->has('email') ? 'error' : '' }}}">
                        <label for="email">{{{ Lang::get('confide::confide.e_mail') }}}
                            <small>{{ Lang::get('confide::confide.signup.confirmation_required') }}</small>
                        </label>
                        <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}"
                               type="text"
                               name="email" id="email"
                               value="{{{ Input::old('email', isset($ngo) ? $ngo->userAccount->email : null) }}}">
                        {{ $errors->first('email', '<span class="help-block">:message</span>') }}

                    </div>
                    @if(isset($isEdit))
                        <div class="form-group">
                            <label for="oldPassword">{{{ Lang::get('ngo/ngo.oldPassword') }}}</label>
                            <input class="form-control" placeholder="{{{ Lang::get('ngo/ngo.oldPassword') }}}"
                                   type="password"
                                   name="oldPassword" id="oldPassword">
                        </div>
                    @endif
                    <div class="form-group{{{ $errors->has('password') ? 'error' : '' }}}">
                        @if(isset($isEdit))
                            <label for="password">{{{ Lang::get('ngo/ngo.newPassword') }}}</label>
                        @else
                            <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
                        @endif
                        <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}"
                               type="password"
                               name="password" id="password">
                        {{ $errors->first('password', '<span class="help-block">:message</span>') }}

                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
                        <input class="form-control"
                               placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}"
                               type="password" name="password_confirmation" id="password_confirmation">
                    </div>


                </div>
                <div class="span3">
                    <div class="form-group  {{{ $errors->has('name') ? 'error' : '' }}}">
                        <label for="name">{{{ Lang::get('ngo/ngo.name') }}}</label>
                        <input class="form-control" placeholder="{{{ Lang::get('ngo/ngo.name') }}}" type="text"
                               name="name"
                               id="name" value="{{{ Input::old('name', isset($ngo) ? $ngo->name : null) }}}">
                        {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group  {{{ $errors->has('description') ? 'error' : '' }}}">
                        <label for="description">{{{ Lang::get('ngo/ngo.description') }}}</label>
                        <input class="form-control" placeholder="{{{ Lang::get('ngo/ngo.description') }}}" type="text"
                               name="description" id="description"
                               value="{{{ Input::old('description', isset($ngo) ? $ngo->description : null) }}}">
                        {{ $errors->first('description', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group  {{{ $errors->has('phone') ? 'error' : '' }}}">
                        <label for="phone">{{{ Lang::get('ngo/ngo.phone') }}}</label>
                        <input class="form-control" placeholder="{{{ Lang::get('ngo/ngo.phone') }}}" type="text"
                               name="phone" id="phone"
                               value="{{{ Input::old('phone', isset($ngo) ? $ngo->phone : null) }}}">
                        {{ $errors->first('phone', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group  {{{ $errors->has('logo') ? 'error' : '' }}}">
                        <label for="logo">{{{ Lang::get('ngo/ngo.logo') }}}</label>
                        <input class="form-control" type="file" name="logo" id="logo">
                        {{ $errors->first('logo', '<span class="help-block">:message</span>') }}
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
                @if(!isset($isEdit))
                    <button type="submit"
                            class="btn btn-primary">{{{ Lang::get('confide::confide.signup.submit') }}}</button>
                @else
                    <input type="button" class="btn btn-primary" onclick="submitUpdate()"
                           value="{{ Lang::get('ngo/ngo.update') }}">

                @endif
                <input type="button" class="btn btn-primary"
                       onclick="window.location.href='{{ URL::to('/') }}'"

                       value="{{ Lang::get('ngo/ngo.back') }}">
            </div>

        </div>
    </form>
@stop

@section('js')

    <script type="text/javascript">
        function submitUpdate() {

            $("#idForm").attr("action", "{{{URL::to('userNgo/edit')}}}");

            $("#idForm").submit();
        }
    </script>
@stop




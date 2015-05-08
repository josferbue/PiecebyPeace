@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    @if(!isset($isEdit))

        {{{ Lang::get('user/user.register') }}} ::
    @else
        {{{ Lang::get('site.editUser') }}} ::

    @endif
    @parent
@stop


{{-- Content --}}
@section('content')
    <LINK href="{{URL::to('template/bootstrap/css/uploadFile.css')}}" rel="stylesheet" type="text/css">

    <div class="page-header">
        @if(!isset($isEdit))

            <h1>{{{ Lang::get('site.company') }}}</h1>
        @else
            <h1> {{{ Lang::get('site.editUser') }}} </h1>

        @endif
    </div>
    <form method="POST" id="idForm"
          action="{{{ (Confide::checkAction('CompanyController@store')) ?: URL::to('userCompany')  }}}"
          enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">

        <div class="row">
            <div class="span4">
                <div class="tab-content">
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
                               value="{{{ Input::old('email', isset($company) ? $company->userAccount->email : null) }}}">
                        {{ $errors->first('email', '<span class="help-block">:message</span>') }}

                    </div>
                    @if(isset($isEdit))
                        <div class="form-group">
                            <label for="oldPassword">{{{ Lang::get('company/company.oldPassword') }}}</label>
                            <input class="form-control" placeholder="{{{ Lang::get('company/company.oldPassword') }}}"
                                   type="password"
                                   name="oldPassword" id="oldPassword">
                        </div>
                    @endif

                    <div class="form-group{{{ $errors->has('password') ? 'error' : '' }}}">
                        @if(isset($isEdit))
                            <label for="password">{{{ Lang::get('company/company.newPassword') }}}</label>
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
                               placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password"
                               name="password_confirmation" id="password_confirmation">
                    </div>
                </div>
            </div>

            <div class="span4">
                <div class="tab-content">
                    <div class="form-group  {{{ $errors->has('name') ? 'error' : '' }}}">
                        <label for="name">{{{ Lang::get('company/company.name') }}}</label>
                        <input class="form-control" placeholder="{{{ Lang::get('company/company.name') }}}" type="text"
                               name="name" id="name" value="{{{ Input::old('name', isset($company) ? $company->name : null) }}}">
                        {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group  {{{ $errors->has('sector') ? 'error' : '' }}}">
                        <label for="sector">{{{ Lang::get('company/company.sector') }}}</label>
                        <input class="form-control" placeholder="{{{ Lang::get('company/company.sector') }}}"
                               type="text" name="sector" id="sector" value="{{{ Input::old('sector', isset($company) ? $company->sector : null) }}}">
                        {{ $errors->first('sector', '<span class="help-block">:message</span>') }}
                    </div>

                    <div class="form-group  {{{ $errors->has('phone') ? 'error' : '' }}}">
                        <label for="phone">{{{ Lang::get('company/company.phone') }}}</label>
                        <input class="form-control" placeholder="{{{ Lang::get('company/company.phone') }}}"
                               type="text"  name="phone" id="phone" value="{{{ Input::old('phone', isset($company) ? $company->phone : null) }}}">
                        {{ $errors->first('phone', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group  {{{ $errors->has('logo') ? 'error' : '' }}}">
                        <label for="logo">{{{ Lang::get('company/company.logo') }}}</label>

                        <div class="btn btn-default btn-file">
                            {{{ Lang::get('site.uploadFile') }}} <input type="file" name="logo" id="logo">
                        </div>
                        {{ $errors->first('logo', '<span class="help-block">:message</span>') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="span6">

            <div class="form-group  {{{ $errors->has('description') ? 'error' : '' }}}">
                <label for="description">{{{ Lang::get('company/company.description') }}}</label>
                        <textarea class="field span7" placeholder="{{{ Lang::get('company/company.description') }}}"
                                  rows="9" name="description" id="description"
                                >{{{ Input::old('description', isset($company) ? $company->description : null) }}}</textarea>
                {{ $errors->first('description', '<span class="help-block">:message</span>') }}
            </div>
        </div>
        </div>

        <div class="row">
            <div class="span6">
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="terms" name="terms" value="true" /> {{ Lang::get('company/company.termsMessage') }}
                        </label>
                    </div>
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
                       value="{{ Lang::get('company/company.update') }}">

            @endif
            <input type="button" class="btn btn-primary"
                   onclick="window.location.href='{{ URL::to('/') }}'"

                   value="{{ Lang::get('company/company.back') }}">
        </div>

        </div>
    </form>
@stop

@section('js')

    <script type="text/javascript">
        function submitUpdate() {

            $("#idForm").attr("action", "{{{URL::to('userCompany/edit')}}}");

            $("#idForm").submit();
        }
    </script>
@stop


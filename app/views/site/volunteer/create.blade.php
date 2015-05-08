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
    <div class="page-header">
        @if(!isset($isEdit))

            <h1>{{{ Lang::get('site.volunteer') }}}</h1>
        @else
            <h1> {{{ Lang::get('site.editUser') }}} </h1>

        @endif
    </div>
    <form method="POST" id="idForm"
          action="{{{ (Confide::checkAction('VolunteerController@store')) ?: URL::to('userVolunteer')  }}}"
          accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">

        <div class="tab-content">
            <div class="row">
                <div class="span4">
                    @if(!isset($isEdit))
                        <div class="form-group{{{ $errors->has('username') ? 'error' : '' }}}">
                            <label for="username">{{{ Lang::get('confide::confide.username') }}}</label>
                            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}"
                                   type="text"
                                   name="username" id="username" value="{{{ Input::old('username') }}}">
                            {{ $errors->first('username', '<span class="help-block">:message</span>') }}

                        </div>
                    @endif

                    @if(isset($isEdit))
                        <div class="form-group">
                            <label for="oldPassword">{{{ Lang::get('volunteer/volunteer.oldPassword') }}}</label>
                            <input class="form-control" placeholder="{{{ Lang::get('ngo/ngo.oldPassword') }}}"
                                   type="password"
                                   name="oldPassword" id="oldPassword">
                        </div>
                    @endif
                    <div class="form-group{{{ $errors->has('password') ? 'error' : '' }}}">
                        @if(isset($isEdit))
                            <label for="password">{{{ Lang::get('volunteer/volunteer.newPassword') }}}</label>
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
                    <div class="form-group  {{{ $errors->has('name') ? 'error' : '' }}}">
                        <label for="name">{{{ Lang::get('volunteer/volunteer.name') }}}</label>
                        <input class="form-control" placeholder="{{{ Lang::get('volunteer/volunteer.name') }}}"
                               type="text" name="name" id="name"
                               value="{{{ Input::old('name', isset($volunteer) ? $volunteer->name : null) }}}">
                        {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group  {{{ $errors->has('surname') ? 'error' : '' }}}">
                        <label for="surname">{{{ Lang::get('volunteer/volunteer.surname') }}}</label>
                        <input class="form-control" placeholder="{{{ Lang::get('volunteer/volunteer.surname') }}}"
                               type="text" name="surname" id="surname"
                               value="{{{ Input::old('surname', isset($volunteer) ? $volunteer->surname : null) }}}">
                        {{ $errors->first('surname', '<span class="help-block">:message</span>') }}
                    </div>
                </div>
                <div class="span4">
                    <div class="form-group{{{ $errors->has('email') ? 'error' : '' }}}">
                        <label for="email">{{{ Lang::get('confide::confide.e_mail') }}}
                            <small>{{ Lang::get('confide::confide.signup.confirmation_required') }}</small>
                        </label>
                        <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}"
                               type="text"
                               name="email" id="email"
                               value="{{{ Input::old('email', isset($volunteer) ? $volunteer->userAccount->email : null) }}}">
                        {{ $errors->first('email', '<span class="help-block">:message</span>') }}

                    </div>

                    <div class="form-group">
                        <label for="address">{{{ Lang::get('volunteer/volunteer.address') }}}</label>
                        <input class="form-control" placeholder="{{{ Lang::get('volunteer/volunteer.address') }}}"
                               type="text" name="address" id="address"
                               value="{{{ Input::old('address', isset($volunteer) ? $volunteer->address : null) }}}">
                    </div>
                    <div class="form-group  {{{ $errors->has('city') ? 'error' : '' }}}">
                        <label for="city">{{{ Lang::get('volunteer/volunteer.city') }}}</label>
                        <input class="form-control" placeholder="{{{ Lang::get('volunteer/volunteer.city') }}}"
                               type="text" name="city" id="city"
                               value="{{{ Input::old('city', isset($volunteer) ? $volunteer->city : null) }}}">
                        {{ $errors->first('city', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group  {{{ $errors->has('zipCode') ? 'error' : '' }}}">
                        <label for="zipCode">{{{ Lang::get('volunteer/volunteer.zipCode') }}}</label>
                        <input class="form-control" placeholder="{{{ Lang::get('volunteer/volunteer.zipCode') }}}"
                               type="text" name="zipCode" id="zipCode"
                               value="{{{ Input::old('zipCode', isset($volunteer) ? $volunteer->zipCode : null) }}}">
                        {{ $errors->first('zipCode', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('country') ? 'error' : '' }}}">
                        <div class="col-md-12">
                            <label for="country">{{{ Lang::get('volunteer/volunteer.country') }}}</label>
                            <input class="form-control" placeholder="{{{ Lang::get('volunteer/volunteer.country') }}}"
                                   type="text" name="country" id="country"
                                   value="{{{ Input::old('country', isset($volunteer) ? $volunteer->country : null) }}}">
                            {{ $errors->first('country', '<span class="help-block">:message</span>') }}
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">

                <div class="span6">

                    <div class="form-group">
                        <label for="biography">{{{ Lang::get('volunteer/volunteer.biography') }}}</label>
                        <textarea class="field span7" placeholder="{{{ Lang::get('volunteer/volunteer.biography') }}}"
                                  rows="9" name="biography"
                                  id="biography">{{{ Input::old('biography', isset($volunteer) ? $volunteer->biography : null) }}}</textarea>
                    </div>
                </div>
            </div>
            @if(!isset($isEdit))
                <div class="row">
                    <div class="span6">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="terms" name="terms"
                                           value="true"/> {{ Lang::get('volunteer/volunteer.termsMessage') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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
                           value="{{ Lang::get('volunteer/volunteer.update') }}">

                    <input type="button" class="btn btn-primary"
                           onclick="window.location.href='{{ URL::to('volunteer/delete') }}'"

                           value="{{ Lang::get('volunteer/volunteer.delete') }}">

                @endif
                <input type="button" class="btn btn-primary"
                       onclick="window.location.href='{{ URL::to('/') }}'"

                       value="{{ Lang::get('volunteer/volunteer.back') }}">
            </div>


        </div>
    </form>
@stop
@section('js')

    <script type="text/javascript">
        function submitUpdate() {

            $("#idForm").attr("action", "{{{URL::to('userVolunteer/edit')}}}");

            $("#idForm").submit();
        }
    </script>
@stop



@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ $title }}} ::
    @parent
@stop
<LINK href="{{URL::to('template/bootstrap/css/separateButton.css')}}" rel="stylesheet" type="text/css">

{{-- Content --}}
@section('content')
    <div class="page-header">
        <h1> {{{ $title}}}</h1>
    </div>


    @if($applications->getTotal() == 0)
        <h3> {{{ Lang::get('application/list.empty') }}}</h3>

    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>{{{ Lang::get('application/view.volunteer') }}}</th>
                    <th>{{{ Lang::get('application/list.viewDetails') }}}</th>

                </tr>
                </thead>
                @foreach($applications as $application)
                    <tr>
                        <td>{{{$application->volunteer->name.' '.$application->volunteer->surname }}}</td>

                        <td>
                            @if (Auth::user()->hasRole('NonGovernmentalOrganization'))
                                <input type="button" class="btn btn-primary"
                                       onclick="window.location.href='{{ URL::to('ngo/application/view/'.$application->id) }}'"
                                       value="{{ Lang::get('application/list.viewDetails') }}">

                            @elseif(Auth::user()->hasRole('COMPANY'))
                                <input type="button" class="btn btn-primary"
                                       onclick="window.location.href='{{ URL::to('company/application/view/'.$application->id) }}'"
                                       value="{{ Lang::get('application/list.viewDetails') }}">
                            @endif

                        </td>

                        <td id="{{$application->id}}">
                            @if( $application->result==0)
                                <div class="separateButton">

                                    <input type="button" class="btn btn-primary"
                                           onclick="ConfirmAccept('{{$application->id}}');"
                                           value="{{ Lang::get('application/view.accept') }}">
                                    <input type="button" class="btn btn-danger"
                                           onclick="ConfirmDenied('{{$application->id}}');"
                                           value="{{ Lang::get('application/view.deny') }}">
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif

    <hr>
    <div class="pagination">
        {{ $applications->links()}}
    </div>
    <input type="button" class="btn btn-primary"
           onclick="window.location.href='{{ URL::to($backUrl) }}'"
           value="{{ Lang::get('application/list.back') }}">
@stop

@section('js')
    <script type="text/javascript">
        function ConfirmAccept(idApplication) {


            var mensaje = confirm('{{ Lang::get('application/view.confirmAccept') }}');
            if (mensaje) {

                @if(Auth::Check() && Auth::user()->hasRole('COMPANY'))
                if (window.location.href.indexOf("PiecebyPeace/public/") > -1) {
                    window.location.href = '/PiecebyPeace/public/company/application/answer/' + idApplication + '/2'
                } else {
                    window.location.href = '/company/application/answer/' + idApplication + '/2'
                }

                @else
                    if (window.location.href.indexOf("public") > -1) {

                    window.location.href = '/PiecebyPeace/public/ngo/application/answer/' + idApplication + '/2'
                }
                else {
                    window.location.href = '/ngo/application/answer/' + idApplication + '/2'
                }

                @endif








            }
        }
        function ConfirmDenied(idApplication) {
            var mensaje = confirm('{{ Lang::get('application/view.confirmDeny') }}');
            if (mensaje) {
                @if(Auth::Check() && Auth::user()->hasRole('COMPANY'))

                if (window.location.href.indexOf("public") > -1) {

                    window.location.href = '/PiecebyPeace/public/company/application/answer/' + idApplication + '/1'
                }

                else {
                    window.location.href = '/company/application/answer/' + idApplication + '/1'
                }

                @else
                    if (window.location.href.indexOf("public") > -1) {

                    window.location.href = '/PiecebyPeace/public/ngo/application/answer/' + idApplication + '/1'
                }
                else {
                    window.location.href = '/ngo/application/answer/' + idApplication + '/1'
                }

                @endif


            }
        }
    </script>
@stop
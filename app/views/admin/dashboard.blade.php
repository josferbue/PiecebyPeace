@extends('site.layouts.default')

@section('css')





@stop



@section('content')
    <div class="page-header">
        <h1>{{{ Lang::get('site.dashboard') }}}</h1>

    </div>
    <div id="linechart" style="width:100%; height:20em;"></div>

    <hr style="margin:45px 0 35px" />
    <div class="row">
        <div class="span6" id="piechart" style="height:22em;"></div>
        <div class="span6" id="donut" style="height:22em;"></div>
    </div>
    <hr style="margin:45px 0 35px" />
    <div class="row">
        @if(!empty($projectMax))
        {{--*/ $project = Project::find($projectMax->project_id) /*--}}


        <div class="span3">
            <strong><h4>{{{ Lang::get('admin/dashboard.projectMaxTitle') }}}</h4></strong>
            <img src="{{ URL::to($project->image)}}" class="img-rounded"
                 alt="{{Lang::get('project/list.notImage') }}"/>
        </div>
        <div class="span3">
            <div class="caption">
                {{--<a href="{{{ URL::to('campaign/details/'.$campaign->id) }}}"><p>{{$campaign->name }}</p></a>--}}
                <hr style="margin:45px 0 35px" />
                <h4> {{ HTML::link('/project/view/'.$project->id , $project->name) }}  </h4>

                {{Session::put('backUrl', Request::url())}}

                <p>{{ $project->description}}</p>

                <p2> {{ $project->city}}, {{ $project->country}} </p2>

            </div>
            <p> <strong>{{$projectMax->voluntarios}} {{ Lang::get('admin/dashboard.volunteers') }}</strong></p>

        </div>
        @endif
            @if(!empty($csrMax))
        {{--*/ $csr = Project::find($csrMax->project_id) /*--}}
        <div class="span3">
            <strong> <h4>{{{ Lang::get('admin/dashboard.csrMaxTitle') }}}</h4></strong>
            <img src="{{ URL::to($csr->image)}}" class="img-rounded"
                 alt="{{Lang::get('project/list.notImage') }}"/>
        </div>
        <div class="span3">
              <div class="caption">
                {{--<a href="{{{ URL::to('campaign/details/'.$campaign->id) }}}"><p>{{$campaign->name }}</p></a>--}}
                <hr style="margin:45px 0 35px" />
                <h4> {{ HTML::link('/project/view/'.$csr->id , $csr->name) }}  </h4>

                {{Session::put('backUrl', Request::url())}}

                <p>{{ $csr->description}}</p>

                <p2> {{ $csr->city}}, {{ $csr->country}} </p2>


            </div>
            <p> <strong>{{$csrMax->voluntarios}} {{ Lang::get('admin/dashboard.volunteers') }}</strong></p>
        </div>
                @endif
    </div>
    <hr style="margin:45px 0 35px" />
    @if(!empty($campaign))
    <strong><h4>{{{ Lang::get('admin/dashboard.campaign') }}}</h4></strong>
    <div class="row">
        <div class="span3">

            {{--<div class="thumbnail">--}}
            <a href="{{{ URL::to('campaign/details/'.$campaign->id) }}}"><img src="{{ URL::to($campaign->image)}}"
                                                                              class="img-rounded"
                                                                              alt="{{{ Lang::get('campaign/campaign.notImage') }}}"/></a>

            {{--</div>--}}
        </div>

        <div class="span9">
            <div class="caption">

                <h4> {{ HTML::link('campaign/details/'.$campaign->id, $campaign->name) }} </h4>

                <p> {{$campaign->description }} </p>

            </div>
            <strong>{{$campaign->visits }} {{{ Lang::get('admin/dashboard.visits') }}} </strong>
        </div>
    </div>
    @endif
@stop

@section('js')

    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/highcharts-3d.js"></script>
    <script>

        $(function () {
            $('#linechart').highcharts({
                title: {
                    text: '{{Lang::get('admin/charts.lineTitle')}}',
                    x: -20 //center
                },

                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    title: {
                        text: '{{Lang::get('admin/charts.lineUnit')}}'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: '{{Lang::get('admin/charts.lineUnit')}}'
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: '{{Lang::get('admin/charts.lineNGO')}}',
                    data:  Laracasts.lineDataSet1
                }, {
                    name: '{{Lang::get('admin/charts.lineVolunteer')}}',
                    data:  Laracasts.lineDataSet2
                }, {
                    name: '{{Lang::get('admin/charts.lineCompany')}}',
                    data:  Laracasts.lineDataSet3
                }]

            });
        });

        $(function () {
            $('#piechart').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: '{{Lang::get('admin/charts.pieTitle')}}'
                },

                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: '{{Lang::get('admin/charts.pieUsers')}}',
                    data: Laracasts.pieDataSet
                }]
            });
        });



        $(function () {
            $('#donut').highcharts({
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45
                    }
                },
                title: {
                    text: '{{Lang::get('admin/charts.donutTitle')}}'
                },

                plotOptions: {
                    pie: {
                        innerSize: 100,
                        depth: 45,
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: '{{Lang::get('admin/charts.pieProyects')}}',
                    data: Laracasts.donutDataSet
                }]
            });
        });
    </script>
@stop
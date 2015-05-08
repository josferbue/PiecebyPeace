@extends('site.layouts.default')

@section('css')





@stop



@section('content')
    <div class="page-header">
        <h1>{{{ Lang::get('site.dashboard') }}}</h1>

    </div>
    <div id="linechart" style="width:100%; height:20em;"></div>

    <div id="piechart" style="width:100%; height:22em;"></div>
    <div id="donut" style="width:100%; height:22em;"></div>

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
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
                    name: 'Users',
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
                    text: 'Contents of Highsoft\'s weekly fruit delivery'
                },

                plotOptions: {
                    pie: {
                        innerSize: 100,
                        depth: 45
                    }
                },
                series: [{
                    name: 'Delivered amount',
                    data: [
                        ['Bananas', 8],
                        ['Kiwi', 3],
                        ['Mixed nuts', 1],
                        ['Oranges', 6],
                        ['Apples', 8],
                        ['Pears', 4],
                        ['Clementines', 4],
                        ['Reddish (bag)', 1],
                        ['Grapes (bunch)', 1]
                    ]
                }]
            });
        });
    </script>
@stop
@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ Lang::get('project/list.title') }}} ::
    @parent
@stop

{{-- Content --}}
@section('content')
    <div class="page-header">
        <h1>{{{ Lang::get('project/list.title') }}}</h1>
    </div>

    <form method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

        <div class="row">


            <div class="span4">


                <label for="categories">{{{ Lang::get('project/list.categories') }}}</label>
                <select class="selectpicker" name="category">

                    @foreach ($categories as $category)
                        <option>{{ $category->name }}</option>
                    @endforeach

                </select>

                <label for="categories">{{{ Lang::get('project/list.locations') }}}</label>

                <select class="selectpicker" name="city">

                    @foreach ($locations as $country =>$cities)
                        <optgroup label={{ $country }}>
                            @foreach ($cities as $city)
                                <option>{{ $city }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach

                </select>

            </div>
            <div class="span4">


                <label for="dateFrom">{{{ Lang::get('project/list.dateFrom') }}}</label>
                <input type="date" name="startDate" step="1" min="2014-01-01"
                       value="<?php echo date("Y-m-d");?>">

                <label for="dateTo">{{{ Lang::get('project/list.dateTo') }}}</label>
                <input type="date" name="finishDate" step="1" min="2014-01-01"
                       value="<?php echo date("Y-m-d");?>">

            </div>


        </div>
        <div class="row">
            <div class="span6">

                <button type="submit"
                        class="btn btn-primary">{{{ Lang::get('project/list.search') }}}</button>

            </div>
        </div>
    </form>



    {{--Comprobamos que existen proyectos y los muestra los proyectos--}}
    @if ($projects=='nothing')
        <div class="row">
            <div class="span3">
                <h3> {{{ Lang::get('project/list.notFound') }}}</h3>
            </div>
        </div>

    @elseif($projects!='')
        @foreach ($projects as $project)

            <div class="row">

                <div class="span3">
                    {{--<div class="thumbnail">--}}
                    <img src="../{{ $project->image}}" class="img-rounded"
                         alt={{{ Lang::get('project/list.notImage') }}}/>


                    {{--</div>--}}
                </div>
                <div class="span9">
                    <div class="caption">
                        <h3>
                            {{ HTML::link('/project/view/'.$project->id , $project->name) }}
                        </h3>

                        <p>{{ $project->description}}</p>

                        <p>
                            {{ $project->city}}, {{ $project->country}}
                        </p>
                    </div>

                </div>


            </div>
            <hr style="color: #0056b2;"/>
        @endforeach
    @endif
@stop

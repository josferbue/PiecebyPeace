@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ Lang::get('project/list.title') }}} ::
    @parent
@stop

{{-- Content --}}
@section('content')
    <div class="page-header" action="projects">
        <h1>{{{ Lang::get('project/list.title') }}}</h1>
    </div>

    <form method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <div class="row">


            <div class="span3">


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
            <div class="span3">


                <label for="dateFrom">{{{ Lang::get('project/list.dateFrom') }}}</label>
                <input type="date" name="startDate" step="1" min="2014-01-01"
                       value="<?php echo date("Y-m-d");?>">

                <label for="dateTo">{{{ Lang::get('project/list.dateTo') }}}</label>
                <input type="date" name="finishDate" step="1" min="2014-01-01"
                       value="<?php echo date("Y-m-d");?>">

            </div>


        </div>
        <div class="row">
            <div class="span3">

                <button type="submit"
                        class="btn btn-primary">{{{ Lang::get('project/list.search') }}}</button>

            </div>
        </div>
    </form>
@stop

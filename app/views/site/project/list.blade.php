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

    @if(!isset($viewNgoMyProjects))
        <form method="POST" accept-charset="UTF-8">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
            <!-- ./ csrf token -->


            <div class="row">
                <div class="span4">
                    <label for="categories">{{{ Lang::get('project/list.categories') }}}</label>
                    <select class="selectpicker" name="category">

                        @foreach ($categories as $category)
                            @if( Input::old('category')==$category->id)

                                <option selected="selected" value={{ $category->id }}>{{{ $category->name }}}</option>
                            @else
                                <option value={{ $category->id }}>{{{ $category->name }}}</option>

                            @endif
                        @endforeach
                    </select>

                    <label for="locations">{{{ Lang::get('project/list.locations') }}}</label>


                    <select class="selectpicker" name="city">


                        @foreach ($locations as $country =>$cities)
                            <optgroup label={{ $country }}>
                                @foreach ($cities as $city)
                                    @if( Input::old('city')==$city)
                                        <option selected="selected">{{ $city }}</option>
                                    @else
                                        <option>{{ $city }}</option>

                                    @endif
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>

                </div>
                <div class="span4">
                    <label for="startDate">{{{ Lang::get('project/list.dateFrom') }}}</label>
                    <input type="date" name="startDate" step="1" min="2014-01-01"
                           value="{{ Input::old('startDate',date("Y-m-d"))}}">

                    <label for="finishDate">{{{ Lang::get('project/list.dateTo') }}}</label>
                    <input type="date" name="finishDate" step="1" min="2014-01-01"
                           value="{{ Input::old('finishDate',date("Y-m-d"))}}">
                </div>


            </div>

            <div class="form-actions form-group">

                <button type="submit"
                        class="btn btn-primary">{{{ Lang::get('project/list.search') }}}</button>

                <input type="button" class="btn btn-primary"
                       onclick="window.location.href='{{ URL::to('/') }}'"

                       value="{{ Lang::get('project/list.back') }}">
            </div>


        </form>
    @else
        <div class="form-actions form-group">

            <input type="button" class="btn btn-primary"
                   onclick="window.location.href='{{ URL::to('/') }}'"

                   value="{{ Lang::get('project/list.back') }}">
        </div>

    @endif

    {{--Comprobamos que existen proyectos y los muestra los proyectos--}}
    @if ($projects=='nothing')
        @if(!isset($viewNgoMyProjects))
            <div class="row">
                <div class="span3">
                    <h3> {{{ Lang::get('project/list.notFound') }}}</h3>
                </div>
            </div>
        @elseif($viewNgoMyProjects=true)

            <div class="row">
                <div class="span3">
                    <h3> {{{ Lang::get('project/list.ngoEmptyProject') }}}</h3>
                </div>
            </div>

        @endif
    @elseif($projects!='')
        @foreach ($projects as $project)

            <div class="row">

                <div class="span3">
                    {{--<div class="thumbnail">--}}
                    <img src="{{ URL::to($project->image)}}" class="img-rounded"
                         alt="{{Lang::get('project/list.notImage') }}"/>


                    {{--</div>--}}
                </div>
                <div class="span9">
                    <div class="caption">
                        <h3>
                            {{ HTML::link('/project/view/'.$project->id , $project->name) }}
                            {{Session::put('backUrl', Request::url())}}
                        </h3>

                        <p>{{ $project->description}}</p>

                        <p>
                            {{ $project->city}}, {{ $project->country}}
                        </p>
                    </div>

                </div>


            </div>
            <hr/>
        @endforeach
    @endif
@stop

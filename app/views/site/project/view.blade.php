@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
     {{{ Lang::get('project/view.title') }}} ::
     @parent
@stop

{{-- Content --}}
@section('content')
     <div class="page-header">
          <h1>{{{ Lang::get('project/view.title') }}}</h1>
     </div>




     <div class="row">


          <div class="span6">
               <div class="de">

                    <h3>  {{{ Lang::get('project/view.name') }}} </h3>

                    <p>{{$project->name }}</p>

                    <h3>  {{{ Lang::get('project/view.description') }}} </h3>

                    <p>{{$project->description }}</p>
               </div>

          </div>

          <div class="span3">
               <img src="{{ URL::to($project->image)}}" class="img-rounded"
                    alt="{{{ Lang::get('project/view.notImage') }}}"/>


               {{--</div>--}}
          </div>


     </div>
     <div class="row">


          <div class="span6">
               <div class="caption">

                    <h3>  {{{ Lang::get('project/view.name') }}} </h3>

                    <p>{{$project->name }}</p>

                    <h3>  {{{ Lang::get('project/view.description') }}} </h3>

                    <p>{{$project->description }}</p>

                    <h3>  {{{ Lang::get('project/view.maxVolunteers') }}} </h3>

                    <p>{{$project->maxVolunteers }}</p>

                    <h3>  {{{ Lang::get('project/view.availableVolunteers') }}} </h3>

                    <p>{{$availableVolunteers}}</p>


               </div>

          </div>
          <div class="span6">
               <div class="caption">
                    <h3>  {{{ Lang::get('project/view.location') }}} </h3>

                    <p>{{$project->addres }} {{$project->city }}, {{$project->country }}. {{$project->zipCode }}</p>

                    <h3>  {{{ Lang::get('project/view.startDate') }}} </h3>

                    <p>{{$project->startDate }}</p>

                    <h3>  {{{ Lang::get('project/view.finishDate') }}} </h3>

                    <p>{{$project->finishDate }}</p>

                    <h3>  {{{ Lang::get('project/view.ngo') }}} </h3>

                    <p>{{$project->ngo->name }}</p>
               </div>

          </div>
     </div>


@stop

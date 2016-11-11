@extends('layouts.loggedout')

@section('content')

  <h1 class="col-sm-8 col-sm-offset-4">{!! trans('site.register') !!}</h1>

  {!! Form::open(['route' => 'register.store', 'class' => 'form-horizontal']) !!}

    <div class="form-group">
  {!! Form::label('name', 'Name', ['class' => 'col-sm-4 control-label']) !!}
  <div class="col-sm-8">
    {!! Form::text('name', '', ['class' => 'form-control', 'required' => true]) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('email', 'Email', ['class' => 'col-sm-4 control-label']) !!}
  <div class="col-sm-8">
    {!! Form::email('email', '', ['class' => 'form-control', 'required' => true]) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('password', 'Password', ['class' => 'col-sm-4 control-label']) !!}
  <div class="col-sm-8">
    {!! Form::password('password',['class' => 'form-control', 'required' => true]) !!}
  </div>
</div>
<div class="form-group">
 {!! Form::label('password_confirmation', 'Password confirm', ['class' => 'col-sm-4 control-label']) !!}
  <div class="col-sm-8">
    {!! Form::password('password_confirmation',['class' => 'form-control', 'required' => true]) !!}
  </div>
</div>
<div class="form-group">
  <div class="col-sm-8 col-sm-offset-4">
   {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!}
  </div>
</div>

{!! Form::close() !!}


@stop
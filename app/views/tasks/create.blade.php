@extends('layout/main')


@section('content')



    <h1>Create New Tasks</h1>


    @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach


    {{ Form::open(array('route' => 'user-tasks-store', 'method' => 'post')) }}

      {{ Form::label('task', 'Create New Task');}}
      {{ Form::text('name'); }}

      {{Form::submit('Create');}}

    {{ Form::close() }}

@stop
@extends('layout/main')


@section('content')
    <h1>Edit Tasks</h1>

    {{ Form::open() }}

    {{ Form::close() }}

        {{Form::model($task, ['route' => ['user-tasks-update', $task->id]])}}

        <div class="field">
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
            @if($errors->has('name'))
                {{ $errors->first('name') }}
            @endif
        </div>

        <div class="field">
            {{ Form::label('completed', 'Complete:') }}
            {{ Form::checkbox('completed') }}
        </div>



        {{ Form::submit('Update!'); }}

        {{Form::close()}}

@stop
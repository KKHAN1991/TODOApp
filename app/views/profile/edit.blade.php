@extends('layout/main')


@section('content')
    {{Form::model($user->profile, ['route' => ['profile-user-post', $user->username]])}}

    {{Input::old('first_name')}}
    <div class="field">
    {{ Form::label('first_name', 'FirstName:') }}
    {{ Form::text('first_name') }}
    @if($errors->has('first_name'))
        {{ $errors->first('first_name') }}
    @endif
    </div>

    <div class="field">
    {{ Form::label('last_name', 'LastName:') }}
    {{ Form::text('last_name') }}
    @if($errors->has('last_name'))
        {{ $errors->first('last_name') }}
    @endif
    </div>


    {{ Form::submit('Update!'); }}

    {{Form::close()}}
@stop
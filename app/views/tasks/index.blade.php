@extends('layout/main')


@section('content')
    <h1>Your Tasks</h1>

    {{ Form::open(array('route' => 'user-tasks-create', 'method' => 'get')) }}
        {{  Form::submit('Create New Task'); }}
    {{ Form::close() }}

    <ul>
    @foreach ($tasks as $task)
        <li>


                <div class="fields">
                    <input type="checkbox" name="task" value="{{ $task->id }}" {{ $task->
                    completed ? 'checked' : ''}}/>

                    <a href="{{ URL::route('user-tasks-edit', $task->id); }}">{{$task->name}}</a>


                    {{ Form::open(array('route' => array('user-tasks-delete', $task->id), 'method' => 'delete')) }}
                            {{  Form::submit('Delete'); }}
                    {{ Form::close() }}

                    {{--{{--}}
                        {{--link_to_route('user-tasks-delete', 'Delete', $task->id);--}}
                    {{--}}--}}
                    {{--<small><a href="{{ URL::Route('user-tasks-delete', $task->id) }}">x</a></small>--}}
                    {{--<input type="hidden" name="_method" value="delete">--}}


                </div>


        </li>
    @endforeach
    </ul>

@stop


@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{ $match->team1->name }} vs {{ $match->team2->name }}</h3>

    {!! Form::open(['method' => 'POST', 'route' => ['admin.matches.post_predict', $match->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('result1', trans('global.matches.fields.result1').'', ['class' => 'control-label']) !!}
                    {!! Form::number('result1', old('result1'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('result1'))
                        <p class="help-block">
                            {{ $errors->first('result1') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('result2', trans('global.matches.fields.result2').'', ['class' => 'control-label']) !!}
                    {!! Form::number('result2', old('result2'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('result2'))
                        <p class="help-block">
                            {{ $errors->first('result2') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


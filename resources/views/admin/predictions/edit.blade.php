@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.predictions.title')</h3>
    
    {!! Form::model($prediction, ['method' => 'PUT', 'route' => ['admin.predictions.update', $prediction->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', trans('global.predictions.fields.user').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('user_id'))
                        <p class="help-block">
                            {{ $errors->first('user_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('match_id', trans('global.predictions.fields.match').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('match_id', $matches, old('match_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('match_id'))
                        <p class="help-block">
                            {{ $errors->first('match_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('result_team1', trans('global.predictions.fields.result-team1').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('result_team1', old('result_team1'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('result_team1'))
                        <p class="help-block">
                            {{ $errors->first('result_team1') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('result_team2', trans('global.predictions.fields.result-team2').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('result_team2', old('result_team2'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('result_team2'))
                        <p class="help-block">
                            {{ $errors->first('result_team2') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('points', trans('global.predictions.fields.points').'', ['class' => 'control-label']) !!}
                    {!! Form::text('points', old('points'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('points'))
                        <p class="help-block">
                            {{ $errors->first('points') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


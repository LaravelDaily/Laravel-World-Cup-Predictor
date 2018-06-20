@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.matches.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.matches.fields.team1')</th>
                            <td field-key='team1'>{{ $match->team1->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.matches.fields.team2')</th>
                            <td field-key='team2'>{{ $match->team2->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.matches.fields.start-time')</th>
                            <td field-key='start_time'>{{ $match->start_time }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.matches.fields.result1')</th>
                            <td field-key='result1'>{{ $match->result1 }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.matches.fields.result2')</th>
                            <td field-key='result2'>{{ $match->result2 }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.matches.fields.comment')</th>
                            <td field-key='comment'>{!! $match->comment !!}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#predictions" aria-controls="predictions" role="tab" data-toggle="tab">Predictions</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="predictions">
<table class="table table-bordered table-striped {{ count($predictions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.predictions.fields.user')</th>
                        <th>@lang('global.predictions.fields.match')</th>
                        <th>@lang('global.predictions.fields.result-team1')</th>
                        <th>@lang('global.predictions.fields.result-team2')</th>
                        <th>@lang('global.predictions.fields.points')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($predictions) > 0)
            @foreach ($predictions as $prediction)
                <tr data-entry-id="{{ $prediction->id }}">
                    <td field-key='user'>{{ $prediction->user->name or '' }}</td>
                                <td field-key='match'>{{ $prediction->match->start_time or '' }}</td>
                                <td field-key='result_team1'>{{ $prediction->result_team1 }}</td>
                                <td field-key='result_team2'>{{ $prediction->result_team2 }}</td>
                                <td field-key='points'>{{ $prediction->points }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.predictions.restore', $prediction->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.predictions.perma_del', $prediction->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('prediction_view')
                                    <a href="{{ route('admin.predictions.show',[$prediction->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('prediction_edit')
                                    <a href="{{ route('admin.predictions.edit',[$prediction->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('prediction_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.predictions.destroy', $prediction->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.matches.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

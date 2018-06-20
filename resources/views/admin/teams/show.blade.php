@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.teams.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.teams.fields.name')</th>
                            <td field-key='name'>{{ $team->name }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#matches" aria-controls="matches" role="tab" data-toggle="tab">Matches</a></li>
<li role="presentation" class=""><a href="#matches" aria-controls="matches" role="tab" data-toggle="tab">Matches</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="matches">
<table class="table table-bordered table-striped {{ count($matches) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.matches.fields.team1')</th>
                        <th>@lang('global.matches.fields.team2')</th>
                        <th>@lang('global.matches.fields.start-time')</th>
                        <th>@lang('global.matches.fields.result1')</th>
                        <th>@lang('global.matches.fields.result2')</th>
                        <th>@lang('global.matches.fields.comment')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($matches) > 0)
            @foreach ($matches as $match)
                <tr data-entry-id="{{ $match->id }}">
                    <td field-key='team1'>{{ $match->team1->name or '' }}</td>
                                <td field-key='team2'>{{ $match->team2->name or '' }}</td>
                                <td field-key='start_time'>{{ $match->start_time }}</td>
                                <td field-key='result1'>{{ $match->result1 }}</td>
                                <td field-key='result2'>{{ $match->result2 }}</td>
                                <td field-key='comment'>{!! $match->comment !!}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.matches.restore', $match->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.matches.perma_del', $match->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('match_view')
                                    <a href="{{ route('admin.matches.show',[$match->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('match_edit')
                                    <a href="{{ route('admin.matches.edit',[$match->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('match_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.matches.destroy', $match->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="matches">
<table class="table table-bordered table-striped {{ count($matches) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.matches.fields.team1')</th>
                        <th>@lang('global.matches.fields.team2')</th>
                        <th>@lang('global.matches.fields.start-time')</th>
                        <th>@lang('global.matches.fields.result1')</th>
                        <th>@lang('global.matches.fields.result2')</th>
                        <th>@lang('global.matches.fields.comment')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($matches) > 0)
            @foreach ($matches as $match)
                <tr data-entry-id="{{ $match->id }}">
                    <td field-key='team1'>{{ $match->team1->name or '' }}</td>
                                <td field-key='team2'>{{ $match->team2->name or '' }}</td>
                                <td field-key='start_time'>{{ $match->start_time }}</td>
                                <td field-key='result1'>{{ $match->result1 }}</td>
                                <td field-key='result2'>{{ $match->result2 }}</td>
                                <td field-key='comment'>{!! $match->comment !!}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.matches.restore', $match->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.matches.perma_del', $match->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('match_view')
                                    <a href="{{ route('admin.matches.show',[$match->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('match_edit')
                                    <a href="{{ route('admin.matches.edit',[$match->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('match_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.matches.destroy', $match->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.teams.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

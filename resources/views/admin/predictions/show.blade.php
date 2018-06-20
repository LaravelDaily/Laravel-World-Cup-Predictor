@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.predictions.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.predictions.fields.user')</th>
                            <td field-key='user'>{{ $prediction->user->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.predictions.fields.match')</th>
                            <td field-key='match'>{{ $prediction->match->start_time or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.predictions.fields.result-team1')</th>
                            <td field-key='result_team1'>{{ $prediction->result_team1 }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.predictions.fields.result-team2')</th>
                            <td field-key='result_team2'>{{ $prediction->result_team2 }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.predictions.fields.points')</th>
                            <td field-key='points'>{{ $prediction->points }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.predictions.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

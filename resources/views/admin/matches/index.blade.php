@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.matches.title')</h3>
    @can('match_create')
    <p>
        <a href="{{ route('admin.matches.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.matches.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.matches.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($matches) > 0 ? 'datatable' : '' }} @can('match_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('match_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                            <th>@lang('global.matches.fields.team1')</th>
                            <th>@lang('global.matches.fields.team2')</th>
                            <th>@lang('global.matches.fields.start-time')</th>
                            <th>My prediction</th>
                            <th>Result</th>
                            <th>Points</th>
                            <th>@lang('global.matches.fields.comment')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($matches) > 0)
                        @foreach ($matches as $match)
                            <tr data-entry-id="{{ $match->id }}">
                                @can('match_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='team1'>{{ $match->team1->name or '' }}</td>
                                <td field-key='team2'>{{ $match->team2->name or '' }}</td>
                                <td field-key='start_time'>{{ $match->start_time }}</td>
                                    <td field-key='prediction'>
                                        @if (isset($predictions[$match->id]))
                                            {{ $predictions[$match->id]->result_team1 }}
                                            :
                                            {{ $predictions[$match->id]->result_team2 }}
                                        @endif
                                    </td>
                                <td field-key='result'>{{ $match->result1 }} : {{ $match->result2 }}</td>
                                    <td field-key='points'>
                                        @if (isset($predictions[$match->id]))
                                            {{ $predictions[$match->id]->points }}
                                        @else
                                            0
                                        @endif
                                    </td>
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
                                        @if (!isset($predictions[$match->id]))
                                        <a href="{{ route('admin.matches.predict',[$match->id]) }}" class="btn btn-xs btn-primary">Predict</a>
                                        @endif
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
@stop

@section('javascript') 
    <script>
        @can('match_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.matches.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection
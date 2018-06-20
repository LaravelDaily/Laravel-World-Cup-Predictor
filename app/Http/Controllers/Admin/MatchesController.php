<?php

namespace App\Http\Controllers\Admin;

use App\Match;
use App\Prediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMatchesRequest;
use App\Http\Requests\Admin\UpdateMatchesRequest;

class MatchesController extends Controller
{
    /**
     * Display a listing of Match.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('match_access')) {
            return abort(401);
        }

        $predictions = Prediction::where('user_id', Auth::id())->get()->keyBy('match_id');

        if (request('show_deleted') == 1) {
            if (! Gate::allows('match_delete')) {
                return abort(401);
            }
            $matches = Match::onlyTrashed()->get();
        } else {
            $matches = Match::all();
        }

        return view('admin.matches.index', compact('matches', 'predictions'));
    }

    /**
     * Show the form for creating new Match.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('match_create')) {
            return abort(401);
        }
        
        $team1s = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $team2s = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.matches.create', compact('team1s', 'team2s'));
    }

    /**
     * Store a newly created Match in storage.
     *
     * @param  \App\Http\Requests\StoreMatchesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatchesRequest $request)
    {
        if (! Gate::allows('match_create')) {
            return abort(401);
        }
        $match = Match::create($request->all());



        return redirect()->route('admin.matches.index');
    }


    /**
     * Show the form for editing Match.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('match_edit')) {
            return abort(401);
        }
        
        $team1s = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $team2s = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $match = Match::findOrFail($id);

        return view('admin.matches.edit', compact('match', 'team1s', 'team2s'));
    }

    /**
     * Update Match in storage.
     *
     * @param  \App\Http\Requests\UpdateMatchesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMatchesRequest $request, $id)
    {
        if (! Gate::allows('match_edit')) {
            return abort(401);
        }
        $match = Match::findOrFail($id);

        if ($match->result1 != $request->result1 || $match->result2 != $request->result2)
        {
            $predictions = Prediction::where('match_id', $match->id)->get();
            foreach ($predictions as $prediction)
            {
                $points = 0;
                if ($prediction->result1 == $request->result1 && $prediction->result2 == $request->result2)
                {
                    $points += 3;
                }
                if (($prediction->result_team1 > $prediction->result_team2 && $request->result1 > $request->result2)
                    || ($prediction->result_team1 == $prediction->result_team2 && $request->result1 == $request->result2)
                    || ($prediction->result_team1 < $prediction->result_team2 && $request->result1 < $request->result2))
                {
                    $points += 1;
                }
                $prediction->update(['points' => $points]);
            }
        }

        $match->update($request->all());



        return redirect()->route('admin.matches.index');
    }


    /**
     * Display Match.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('match_view')) {
            return abort(401);
        }
        
        $team1s = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $team2s = \App\Team::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$predictions = \App\Prediction::where('match_id', $id)->get();

        $match = Match::findOrFail($id);

        return view('admin.matches.show', compact('match', 'predictions'));
    }


    /**
     * Remove Match from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('match_delete')) {
            return abort(401);
        }
        $match = Match::findOrFail($id);
        $match->delete();

        return redirect()->route('admin.matches.index');
    }

    /**
     * Delete all selected Match at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('match_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Match::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Match from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('match_delete')) {
            return abort(401);
        }
        $match = Match::onlyTrashed()->findOrFail($id);
        $match->restore();

        return redirect()->route('admin.matches.index');
    }

    /**
     * Permanently delete Match from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('match_delete')) {
            return abort(401);
        }
        $match = Match::onlyTrashed()->findOrFail($id);
        $match->forceDelete();

        return redirect()->route('admin.matches.index');
    }

    public function predict($match_id)
    {
        if (! Gate::allows('match_view')) {
            return abort(401);
        }

        $match = Match::find($match_id);
        $prediction = Prediction::where('user_id', Auth::id())->first();

        return view('admin.matches.predict', compact('match', 'prediction'));

    }

    public function postPredict(Request $request, $match_id)
    {
        if (! Gate::allows('match_view')) {
            return abort(401);
        }

        $match = Match::findOrFail($match_id);

        Prediction::firstOrCreate([
            'user_id' => Auth::id(),
            'match_id' => $match_id,
            'result_team1' => $request->result1,
            'result_team2' => $request->result2,
        ]);

        return redirect()->route('admin.predictions.index');
    }

}

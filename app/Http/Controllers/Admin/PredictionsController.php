<?php

namespace App\Http\Controllers\Admin;

use App\Prediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePredictionsRequest;
use App\Http\Requests\Admin\UpdatePredictionsRequest;

class PredictionsController extends Controller
{
    /**
     * Display a listing of Prediction.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('prediction_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('prediction_delete')) {
                return abort(401);
            }
            $predictions = Prediction::onlyTrashed()->get();
        } else {
            $predictions = Prediction::all();
        }

        return view('admin.predictions.index', compact('predictions'));
    }

    /**
     * Show the form for creating new Prediction.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('prediction_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $matches = \App\Match::get()->pluck('start_time', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.predictions.create', compact('users', 'matches'));
    }

    /**
     * Store a newly created Prediction in storage.
     *
     * @param  \App\Http\Requests\StorePredictionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePredictionsRequest $request)
    {
        if (! Gate::allows('prediction_create')) {
            return abort(401);
        }
        $prediction = Prediction::create($request->all());



        return redirect()->route('admin.predictions.index');
    }


    /**
     * Show the form for editing Prediction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('prediction_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $matches = \App\Match::get()->pluck('start_time', 'id')->prepend(trans('global.app_please_select'), '');

        $prediction = Prediction::findOrFail($id);

        return view('admin.predictions.edit', compact('prediction', 'users', 'matches'));
    }

    /**
     * Update Prediction in storage.
     *
     * @param  \App\Http\Requests\UpdatePredictionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePredictionsRequest $request, $id)
    {
        if (! Gate::allows('prediction_edit')) {
            return abort(401);
        }
        $prediction = Prediction::findOrFail($id);
        $prediction->update($request->all());



        return redirect()->route('admin.predictions.index');
    }


    /**
     * Display Prediction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('prediction_view')) {
            return abort(401);
        }
        $prediction = Prediction::findOrFail($id);

        return view('admin.predictions.show', compact('prediction'));
    }


    /**
     * Remove Prediction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('prediction_delete')) {
            return abort(401);
        }
        $prediction = Prediction::findOrFail($id);
        $prediction->delete();

        return redirect()->route('admin.predictions.index');
    }

    /**
     * Delete all selected Prediction at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('prediction_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Prediction::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Prediction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('prediction_delete')) {
            return abort(401);
        }
        $prediction = Prediction::onlyTrashed()->findOrFail($id);
        $prediction->restore();

        return redirect()->route('admin.predictions.index');
    }

    /**
     * Permanently delete Prediction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('prediction_delete')) {
            return abort(401);
        }
        $prediction = Prediction::onlyTrashed()->findOrFail($id);
        $prediction->forceDelete();

        return redirect()->route('admin.predictions.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Http\Requests\StateRequest;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::all();
        return view('state.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('state.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateRequest $request)
    {
        try {
            State::create($request->validated());
        } catch (\Exception $e) {
            //Log::error($e);
            Log::error(['code' => $e->getCode(), 'message' => $e->getMessage()]);

            return redirect()->back()->withInput()->with(['message' => 'Error Saving the record']);

        }

        return redirect()->route('state.index')->with(['message' => 'Successfully added Record']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        return view('state.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StateRequest $request, State $state)
    {
        try {
            $state ->update($request->validated());
        } catch (\Exception $e) {
            //Log::error($e);
            Log::error(['code' => $e->getCode(), 'message' => $e->getMessage()]);

            return redirect()->back()->withInput()->with(['message' => 'Error Saving the record']);

        }

        return redirect()->route('state.index')->with(['message' => 'Successfully updated Record']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        try {
            $state->delete();
        } catch (\Exception $e) {
            //Log::error($e);
            Log::error(['code' => $e->getCode(), 'message' => $e->getMessage()]);

            return redirect()->back()->withInput()->with(['message' => 'Error Saving the record']);
        }

        return redirect()->route('state.index')->with(['message' => 'Successfully deleted Record']);
    }
}

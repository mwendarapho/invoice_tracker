<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $staffs=json_encode(Staff::all());
       // return response($staff,200);
        $staffs=Staff::all();
        return view('staff.index',compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest  $request)
    {
        try {
            Staff::create($request->validated());
        } catch (\Exception $e){
            //Log::error($e);
            Log::error(['code'=>$e->getCode(),'message'=>$e->getMessage()]);

            return redirect()->back()->withInput()->with(['message'=>'Error Saving the record']);

        }

        return redirect()->route('staff.index')->with(['message'=>'Successfully added Record']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        return view('staff.edit',compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffRequest $request, Staff $staff)
    {
        try {
            $staff->update($request->validated());
        } catch (\Exception $e){

            Log::error(['code'=>$e->getCode(),'message'=>$e->getMessage()]);

            return redirect()->back()->withInput()->with(['message'=>'Error updating the record']);

        }

        return redirect()->route('staff.index')->with(['message'=>'Successfully update Record']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Staff $staff)
    {
        try {
            $staff->delete();
        } catch (\Exception $e){
            Log::error(['code'=>$e->getCode(),'message'=>$e->getMessage()]);

            return redirect()->back()->withInput()->with(['message'=>'Error deleting the record']);

        }

        return redirect()->route('staff.index')->with(['message'=>'Successfully deleted Record']);

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerImportRequest;
use App\Models\Customer;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Imports\CustomersImport;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        try {
            Customer::create($request->validated());
        } catch (\Exception $e) {
            //Log::error($e);
            Log::error(['code' => $e->getCode(), 'message' => $e->getMessage()]);

            return redirect()->back()->withInput()->with(['message' => 'Error Saving the record']);

        }

        return redirect()->route('customer.index')->with(['message' => 'Successfully added Record']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        try {
            $customer->update($request->validated());
        } catch (\Exception $e) {
            //Log::error($e);
            Log::error(['code' => $e->getCode(), 'message' => $e->getMessage()]);

            return redirect()->back()->withInput()->with(['message' => 'Error updating the record']);

        }

        return redirect()->route('customer.index')->with(['message' => 'Successfully updated Record']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
        } catch (\Exception $e) {
            //Log::error($e);
            Log::error(['code' => $e->getCode(), 'message' => $e->getMessage()]);

            return redirect()->back()->withInput()->with(['message' => 'Error deleting the record']);

        }

        return redirect()->route('customer.index')->with(['message' => 'Successfully delete Record']);
    }

    public function import(CustomerImportRequest $request)
    {
        try {
            Excel::import(new CustomersImport, $request->file('customersFile'));
        } catch (\Exception $e) {
            Log::error(['code' => $e->getCode(), 'message' => $e->getMessage()]);
            return redirect()->back()->withInput()->with(['message' => 'Error importing file']);
        }
        return redirect()->route('customer.index')->with(['message' => 'Imported successfully']);

    }

    public function getImportFile()
    {
        return view('customers.import');
    }
}

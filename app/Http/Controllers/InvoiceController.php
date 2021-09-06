<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;


class InvoiceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = DB::table('invoices as T1')
            ->join('states as T2', 'T1.states_id', '=', 'T2.id')
            ->join('customers as T3', 'T1.customers_code', '=', 'T3.code')
            ->join('staff as T4', 'T1.staff_code', '=', 'T4.code')
            ->latest('T1.created_at')
            ->select('T1.id', 'T1.invoice_no', 'T1.created_at', 'T2.name as state', 'T3.name as customer', 'T4.name as staff')
            ->get();


        // {{ $invoice->invoice_no.'-'.$invoice->staff.'-'.$invoice->state }}

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            /*
                    $validated = $request->validate([

                        'invoice_no' => 'required',
                        'customers_code' => 'required',
                        'states_id'=> 'required',
                        'staff_code'=> 'required|unique:invoices',

                    ]);*/


            $data = $request->all();
            $userdata = (explode(" ", $data['user_id']));

            //seperate customers code and invoice code
            $invoicedata = (explode(" ", $data['invoice_no']));


            //check  data input order
            if (count($userdata) != 2 || count($invoicedata) != 3) {

                return redirect()->route('invoice.index');

            }

            $data = array_merge($userdata, $invoicedata);


            $data1['states_id'] = (int)filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
            $data1['states_id'] = (int)filter_var($data[2], FILTER_SANITIZE_NUMBER_INT);

            //validate scanner
            if ($data[0] != $data[2]) {

                return redirect()->route('invoice.index');

            }


            $data1['staff_code'] = $data[1];
            $data1['customers_code'] = $data[3];
            $data1['invoice_no'] = $data[4];

            $existingInvoices = Invoice::where('invoice_no', $data1['invoice_no'])
                ->where('states_id', $data1['states_id'])
                ->get();


            if (count($existingInvoices) > 0) {
                $existingInvoices = array($existingInvoices[0]->invoice_no, $existingInvoices[0]->states_id);
                $newInvoice = array($data1['invoice_no'], $data1['states_id']);

                //check if a record[invoice and state] exists
                if ($this->doesInvoiceExist($newInvoice, $existingInvoices)) {
                    return redirect()->route('invoice.index');
                }
            } else {
                Invoice::create($data1);
            }


        } catch (\Exception $e) {
            //return redirect()->route('invoice.index')->with(['message'=>'Error, Try again']);
            dd($e->getMessage());
            return back()->withError($e->getMessage());
        }


        return redirect()->route('invoice.index')->with(['message' => 'Invoice saved']);

    }

    public function doesInvoiceExist($a, $b)
    {
        return (
            is_array($a)
            && is_array($b)
            && count($a) == count($b)
            && array_diff($a, $b) === array_diff($b, $a)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}

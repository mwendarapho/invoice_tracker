<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $query=DB::table('invoices as T1')
            ->join('states as T2','T1.states_id','=','T2.id')
            ->join('customers as T3','T1.customers_code','=','T3.code')
            ->join('staff as T4','T1.staff_code','=','T4.code')
            ->latest('T1.created_at')
            ->select('T1.id','T1.invoice_no','T1.created_at','T2.name as state','T3.name as customer','T4.name as staff')
            ->get();
        $invoices=$query;

       // dd($invoices);
        return view('invoices.index',compact('invoices'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
/*
        $validated = $request->validate([

            'invoice_no' => 'required',
            'customers_code' => 'required',
            'states_id'=> 'required',
            'staff_code'=> 'required|unique:invoices',

        ]);*/



        $data=$request->all();
        $userdata=(explode(" ",$data['user_id']));

        //seperate customer code and invoice code
        $invoicedata=(explode(" ",$data['invoice_no']));


        //check  data input order

        if( count($userdata)!=2 || count($invoicedata)!=3 ){

            return redirect()->route('invoice.index');

        }

        $data=array_merge($userdata,$invoicedata);


        $data1['states_id'] = (int) filter_var($data[0], FILTER_SANITIZE_NUMBER_INT);
        $data1['states_id'] = (int) filter_var($data[2], FILTER_SANITIZE_NUMBER_INT);

        //validate scanner

    if ($data[0]!=$data[2]){

            return redirect()->route('invoice.index');

        }

        $data1['staff_code']=$data[1];
        $data1['customers_code']=$data[3];
        $data1['invoice_no']=$data[4];



       // dd($data1);

        Invoice::create($data1);

        return redirect()->route('invoice.index')->with(['message'=>'Invoice saved']);

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

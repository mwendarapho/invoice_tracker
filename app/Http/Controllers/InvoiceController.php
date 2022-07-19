<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Services\InvoiceService;
use Carbon\Carbon;




use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;


class InvoiceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InvoiceService $service)
    {

        $invoices= $service->getDispatchInvoice();

        //dd($invoices);
        


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

        

            $data = (new InvoiceService)->checkData($request->all());
            
             //check  data input order
             //validate scanner
             

             
             if ((count($data) != 5) || ($data[0] != $data[2]) || ($data[0] != $data[2])) {
                return redirect()->route('invoice.index')->with(['status'=>'Incorrect data, scan again!']);
                
            }

            $data1['invoice_no'] = $data[4];
            $data1['state_id'] = (int)filter_var($data[2], FILTER_SANITIZE_NUMBER_INT);

            $data1['staff_code'] = $data[1];
            $data1['customers_code'] = $data[3];
            
            $customer=Customer::where('code','=', $data1['customers_code'])->pluck('id');
            $staff=Staff::where('code','=', $data1['staff_code'])->pluck('id');

          

            if(count($customer)==0 || count($staff)==0){
                return redirect()->route('invoice.index')->with(['status'=>'Incorrect data, scan again!']);
            }

            $data1['customer_id']=$customer[0];
            $data1['staff_id']=$staff[0];

            //$existingInvoices = Invoice::where('invoice_no', $data1['invoice_no'])
                //->where('state_id', $data1['state_id'])
             //   ->get();
            //dd($existingInvoices);
            $existingInvoices=(new InvoiceService)->existingInvoices($data1['invoice_no']);

            if (count($existingInvoices) > 0) {

                $existingInvoices = array($existingInvoices[0]->invoice_no, $existingInvoices[0]->state_id);
                $newInvoice = array($data1['invoice_no'], $data1['state_id']);

                //check if a record[invoice and state] exists
                if ((new InvoiceService)->doesInvoiceExist($newInvoice, $existingInvoices)) {
                    return redirect()->route('invoice.index')->with(['status' => 'Already saved']);
                }else{
                    unset($data1["staff_code"],$data1["customers_code"]);
                    

                   // dd($data1);
                    //DB::table('invoices')->update($data1);
                    DB::table('invoices')
                    ->where('invoice_no',$data1['invoice_no'])
                    ->update(
                        [
                            'state_id' => $data1['state_id'],
                            'updated_at'=>Carbon::now(),
                        
                        ]
                        
                    );
                    

                }
            } else {
                
                //prune data
                unset($data1["staff_code"],$data1["customers_code"]);
                //dd($data1);
                Invoice::create($data1);
                
            }


        } catch (\Exception $e) {
            //return redirect()->route('invoice.index')->with(['message'=>'Error, Try again']);
            dd($e->getMessage());
            return back()->withError($e->getMessage());
        }


        return redirect()->route('invoice.index')->with(['status' => 'Invoice saved']);

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
    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update($request->all());
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

    public function allocate(Request $request){
        $validated = $request->validate([

            'invoices' => 'required',
            'staff_id'=> 'required',

        ]);
       

       foreach ($validated['invoices'] as $invoice){

        Invoice::where('id',$invoice)
        ->update([
            'staff_id'=>$validated['staff_id'],
            'state_id'=>4, //out for delivery,
            'updated_at'=> Carbon::now(),
        ]);
            

       }

       return redirect()->route('region');


        
    }

}

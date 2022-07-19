<?php

namespace App\Services;


use App\Models\Invoice;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;

class InvoiceService{

    /**
     * @return boolean
     * 
     * 
     * **/
    public function isCustomerInNairobi(){       

        return True;
    }

    public function getDispatchInvoice(){

        return Invoice::where('state_id','!=',4)
                ->latest('invoices.updated_at')
                ->join('states as T2', 'state_id', '=', 'T2.id')
                ->join('customers as T3', 'customer_id', '=', 'T3.id')
                ->join('staff as T4', 'staff_id', '=', 'T4.id')
                ->select('invoice_no','T2.name as state','T3.name as customer','T4.name as staff','invoices.updated_at')
                //->orderBy('updated_at')
                ->get();
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
 * 
 * @return type array
 */
    public function checkData($userinput) :array  {

            $userdata = (explode(" ", $userinput['user']));            

            //seperate customers code and invoice code
            $invoicedata = (explode(" ", $userinput['invoice']));

           // dd(array_merge($userdata, $invoicedata));


            return array_merge($userdata, $invoicedata);


    }

    public function existingInvoices( $data1) {
        $invoices = Invoice::where('invoice_no', $data1)
                //->where('state_id', $data1['state_id'])
                ->get();
            //dd($existingInvoices);

            return($invoices);

    }

    public function getRegion($town=''){

        if($town=='upcountry'){
            return  Invoice::where('state_id','=','3') 
                ->join('states as T2', 'state_id', '=', 'T2.id')
                ->join('customers as T3', 'customer_id', '=', 'T3.id')
                ->join('staff as T4', 'staff_id', '=', 'T4.id')
                ->where('T3.province','!=',"Nairobi")
                ->select('invoices.id', 'invoices.invoice_no', 'invoices.created_at', 'T2.name as state', 'T3.name as customer','T3.town as town','T3.province as province', 'T4.name as staff')
                ->get();
        }
            return  Invoice::where('state_id','=','3') 
                ->join('states as T2', 'state_id', '=', 'T2.id')
                ->join('customers as T3', 'customer_id', '=', 'T3.id')
                ->join('staff as T4', 'staff_id', '=', 'T4.id')
                ->where('T3.town','=',$town)
                ->select('invoices.id', 'invoices.invoice_no', 'invoices.created_at', 'T2.name as state', 'T3.name as customer','T3.town as town','T3.province as province', 'T4.name as staff')
                ->get();    
            
    }



}
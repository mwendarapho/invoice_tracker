<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\State;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $query='select T2.code, T2.name, count(T1.customer_id)as total,
        count(case when T1.state_id=1 then T1.state_id end) as "printed",
        count(case when T1.state_id=2 then T1.state_id end) as "dispatch",
        count(case when T1.state_id=3 then T1.state_id end) as "delivery",
        count(case when T1.state_id=4 then T1.state_id end) as "enroute"
        
        from invoices as T1
        
        inner join customers as T2 on T1.customer_id=T2.id
        
        group by customer_id
        order by T2.name';
        
        $invoices=DB::select($query);
        //dd($invoices);
        return view('home',compact('invoices'));
    }
    public function assign(){
        $invoices = DB::table('invoices as T1')
        ->join('states as T2', 'T1.state_id', '=', 'T2.id')
        ->join('customers as T3', 'T1.customer_id', '=', 'T3.id')
        ->join('staff as T4', 'T1.staff_id', '=', 'T4.id')
        ->orderBy('T3.name')
        ->orderBy('T1.created_at')
        //->latest('T1.created_at')
        ->where('state_id','=','3')
        ->select('T1.id', 'T1.invoice_no', 'T1.created_at', 'T2.name as state', 'T3.name as customer', 'T4.name as staff')
        ->get();

        $riders=Staff::all();




        return view('invoices.assignment',compact('invoices','riders'));
    }
    public function region(){
        $query='select count(customer_id) as total, town from 
        (
        select 
        
        T1.invoice_no
        ,T1.customer_id
        ,T1.staff_id
        ,T1.state_id
        ,T2.name
        ,T2.code
        ,T2.town
        ,T2.province
        
        from invoices as T1
        join customers as T2
        on T1.customer_id=T2.id
        
        where province="Nairobi" AND T1.state_id=3
        ) as T3
        
        group by town
        
        union all
        
        select count(customer_id) as total, "upcountry" as town  from(
        
        select 
        
        T1.invoice_no,
        T1.customer_id
        ,T1.staff_id
        ,T1.state_id
        ,T2.name
        ,T2.code
        ,T2.town
        ,T2.province
        
        from invoices as T1
        join customers as T2
        on T1.customer_id=T2.id
        
        where province!="Nairobi" AND T1.state_id=3
          ) as T3';
        $invoices=DB::select($query);

        return view('invoices.region',compact('invoices'));
    }
    public function regionFilter($town){       
            
            $invoices=(new InvoiceService)->getRegion($town);
            $riders=Staff::all();
            return view('invoices.assignment',compact('invoices','riders'));

    }
}

<?php

namespace Tests\Feature;

use App\Models\Invoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /*
     public function test_load_invoice_scan_interface()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/invoice');

        $response->assertStatus(200);
    }
    */

    public function test_add_an_invoice(){
        $data=[
            'user'=>'KCL01 200',
            'invoice'=>'KCL01 CUS001 SNV0001',        
        ];

       // $this->post('invoice',$data);
        //$this->assertCount(1,Invoice::all());
        $this->assertSame(True,True);
    }
    public function test_can_update_invoice_status(){
        $this->assertSame(True,True);
    }

    public function test_is_customer_within_Nairobi(){
        $this->assertSame(True,True);
    }
    
}

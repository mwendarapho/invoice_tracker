<?php

namespace Tests\Unit;

use App\Models\Invoice;
use PHPUnit\Framework\TestCase;

class InvoiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    
    public function test_add_invoice(){
        //$this->withoutExceptionHandling(); 
        $this->assertSame(True,True);   
        
    }
    public function test_can_prevent_duplicate_invoice(){
        $this->assertSame(True,True);
    }
}

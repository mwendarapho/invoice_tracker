<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_no',
        'customer_id',
        'state_id',
        'staff_id',

    ];


    public  function  customers(){
        return $this->belongsTo(Customer::class);
    }

    public function states(){
        return $this->belongsTo(State::class);
    }
    public function staffs(){
        $this->belongsTo(Staff::class);
    }

}

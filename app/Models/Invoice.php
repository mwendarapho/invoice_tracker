<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_no',
        'customers_code',
        'states_id',
        'staff_code',

    ];


    public  function  customer(){
        return $this->belongsTo(Customer::class);
    }

    public function state(){
        return $this->hasMany(State::class);
    }
    public function staff(){
        $this->belongsTo(Staff::class,'staff_code');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    
    protected $fillable = [ 'name'];

    public  function invoices(){
        return$this->hasMany(Invoice::class);
    }
    /*public function customers(){
        return $this->belongsToM(Customer::class,Invoice::class);
    }*/
    public function customers(){
        $this->hasManyThrough(Customer::class,Invoice::class);
    }
   
    public function staffs()
    {
        return $this->belongsToThrough(Staff::class, Invoice::class);
    }
    

}

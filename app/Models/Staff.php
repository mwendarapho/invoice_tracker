<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','name','station',
    ];

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
    
    public function customers()
    {
        return $this->hasManyThrough(Customer::class, Invoice::class);
    }
    
    
    
}

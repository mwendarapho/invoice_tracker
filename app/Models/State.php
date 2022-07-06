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
    public function customer(){
        return $this->belongsTo(Customer::class,Invoice::class);
    }

}

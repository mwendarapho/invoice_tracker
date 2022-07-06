<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'code',
        'town',
        'province',
    ];
    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
    public function states(){
        return $this->hasManyThrough(State::class,Invoice::class);
    }
}

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

    public function invoice(){
        return $this->hasMany(Invoice::class);
    }
}

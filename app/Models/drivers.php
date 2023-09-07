<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drivers extends Model
{
    protected $fillable = ['username','email','password'];

    public function bookings()
    {
        return $this->hasMany(Bookings::class,'driver_id');
    }
}

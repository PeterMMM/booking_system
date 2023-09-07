<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class bookings extends Model
{
    protected $fillable = ['customer_id','driver_id','start_time','end_time','accepted','customer_id'];

    public function customers()
    {
        return $this->hasMany(Customers::class,'customer_id');
    }
    public function drivers()
    {
        return $this->hasMany(Drivers::class,'driver_id');
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
}

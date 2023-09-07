<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bookings;
class customers extends Model
{
    protected $fillable = ['username','email','password'];

    public function bookings()
    {
        return $this->hasMany(Bookings::class,'customer_id');
    }
}

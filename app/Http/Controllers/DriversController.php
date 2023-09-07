<?php

namespace App\Http\Controllers;
use App\Models\Drivers;
use Illuminate\Http\Request;

class DriversController extends Controller
{
    public function index()
    {
        $drivers = Drivers::select('id', 'username')->get();
        return response()->json(['drivers' => $drivers]);
    }
}

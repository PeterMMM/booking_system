<?php

namespace App\Http\Controllers;
use App\Models\Drivers;
use Illuminate\Http\Request;

class DriversController extends Controller
{
    public function index()
    {
        $drivers = Drivers::select('id', 'username')->get();

        // Check if $drivers is empty, and return an empty array if it is
        if ($drivers->isEmpty()) {
            return response()->json(['drivers' => 'No Driver Yet!']);
        }
    
        return response()->json(['drivers' => $drivers]);
    }
}

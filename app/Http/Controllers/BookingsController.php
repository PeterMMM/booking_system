<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Bookings;
use App\Models\Drivers;

class BookingsController extends Controller
{
    //Create Booking
    public function create(Request $request){
        $request->validate([
            'customer_id'=> 'required',
            'driver_id' => 'required',
            'start_time' => 'required',
            'end_time'=> 'required',
        ]);

        $overlap = Bookings::where("driver_id", $request->driver_id)
        ->where(function ($query) use ($request) {
            $query->whereBetween('start_time',[$request->start_date, $request->end_time])
            ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
            ->orWhere(function ($query) use ($request){
                $query->where('start_time','<', $request->start_time)
                ->where('end_time','>',$request->end_time);
            });
        })->first();

        if($overlap){
            return response()->json([
                'message'=> 'Overlap Error! Time Slop not avaliable!',
                'error'=>' Time Slop not avaliable!',
                'overlap'=>$overlap
            ]);
        }else{
        //Entry Data
            $newbooking = Bookings::create([
                'customer_id' => $request->customer_id,
                'driver_id' => $request->driver_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time
            ]);
            return response()->json([
                'message'=> 'Successfully Booked',
                'newbooking'=> $newbooking
            ]);
        }
    }

    //Bookings List base on Cus Id or Dri Id
    public function index(Request $request){

        if(isset($request->driver_id)){
            // $bookings = Bookings::where('driver_id',$request->driver_id)->get();
            $bookings = Bookings::join('drivers', 'bookings.driver_id', '=', 'drivers.id')
            ->where('bookings.driver_id', $request->driver_id)
            ->select('bookings.*', 'drivers.username as driver_name')
            ->get();
        }elseif(isset($request->customer_id)){
            // $bookings = Bookings::where('customer_id',$request->customer_id)->get();
            $bookings = Bookings::join('drivers', 'bookings.driver_id', '=', 'drivers.id')
            ->where('bookings.customer_id', $request->customer_id)
            ->select('bookings.*', 'drivers.username as driver_name')
            ->get();
        }
        return response()->json([
            'message'=> 'Bookings List',
            'bookings'=> $bookings
        ]);
    }

    
    //Bookings Detail
    public function show($id){

        if(isset($id)){
            $booking = Bookings::where('id',$id)->get();
        }
        return response()->json([
            'message'=> 'Bookings Detail',
            'booking'=> $booking
        ]);
    }
    
    //Bookings accept
    public function accept($id){

        if(isset($id)){
            Bookings::where('id',$id)->update(array('accepted' => 1));
            $booking = Bookings::where('id',$id)->get();
        }
        return response()->json([
            'message'=> 'Bookings accepted',
            'booking'=> $booking
        ]);
    }

    //Bookings accept
    public function reject($id){

        if(isset($id)){
            Bookings::where('id',$id)->update(array('accepted' => 2));
            $booking = Bookings::where('id',$id)->get();
        }
        return response()->json([
            'message'=> 'Bookings rejected',
            'booking'=> $booking
        ]);
    }

}

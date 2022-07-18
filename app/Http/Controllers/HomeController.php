<?php

namespace App\Http\Controllers;

use App\Models\m_services;
use App\Models\m_vessels;
use App\Models\t_booking_details;
use App\Models\t_bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
    
        $data=DB::table('t_booking_details')
        // ->
        ->join('t_bookings', 't_booking_details.booking_id', '=', 't_bookings.id')
        ->join('m_services', 't_booking_details.service_id', '=', 'm_services.id')
        ->get();

     $group= $data->groupBy('booking_id');

    //  dd($group);
    $array=[];
    
     foreach($group as $item){
         $total=0;
         
         foreach($item as $itemdata){
            // dd($itemdata);
          $total+=$itemdata->service_tariff;
         }
         $item[0]->total =$total;
         $array[]=$item[0];
     }

    //  dd($array);

        return view('welcome',["vessel"=>m_vessels::all(),"service"=>m_services::all(),"data"=>$array]);
    }

    public function addvessel(Request $request){
        // dd($request->all());
    m_vessels::create($request->except('_token'));
    return redirect('/');
    }

    public function addservice(Request $request){
        // dd($request->all());
        m_services::create($request->except('_token'));
        return redirect('/');
    }

    public function addtransaction(Request $request){
        //  dd($request->all());
    
        $data_booking = t_bookings::where('customer_name',$request->customer_name )->where('vessel_id',$request->vessel_id)->first();

            if($data_booking === null){
                $booking = t_bookings::create([
                    'vessel_id' => $request->vessel_id,
                    'booking_date' => now(),
                    'customer_name' => $request->customer_name
                ]);
                
                t_booking_details::create([
                    'vessel_id'=> $request->vessel_id,
                    'booking_id'=> $booking->id,
                    'service_id'=> $request->service_id
                ]);
            }else{
                t_booking_details::create([
                    'vessel_id'=> $request->vessel_id,
                    'booking_id'=> $data_booking->id,
                    'service_id'=> $request->service_id
                ]);
            }
    return redirect('/');
    }

}

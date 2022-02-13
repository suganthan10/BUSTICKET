<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Reservation;

class AjaxController extends Controller
{
    public function seatno(Request $request)
    {
        $data = $request->all();
        $travel_date = $data['travel_date'];
        $start_location = $data['start_location'];
        $end_location = $data['end_location'];
        $vehicle_no = $data['vehicle_no'];

        $bus=ApiController::get_api_data('bus/'.$vehicle_no);
    	$bus = json_decode(trim($bus), TRUE);
    	$no_seats=$bus[0]['no_seats'];
 

        $html="<div class=\"row\">";

        for ($i=1; $i <= $no_seats; $i++) {

        $reservations = Reservation::where('travel_date', $travel_date)->where('start_location', $start_location)->where('end_location', $end_location)->where('vehicle_no', $vehicle_no)->where('seat_no', $i)->get();

        if(count($reservations)){
        	$html .="<div class=\"col-md-2\">";
	        $html .="<label for=\"radioSeat".$i."\" style=\"background-color: red\">X</label>";
        }else{

	        $html .="<div class=\"col-md-2\">
	                <input type=\"radio\" id=\"radioSeat".$i."\" name=\"radioSeat\" value=\"".$i."\" onClick=\"getSeat(".$i.")\">";
	        if($i%4==0 || $i%4==1){       
	        	$html .="<label for=\"radioSeat".$i."\">".sprintf('%02u', $i)."W</label>";
	    	}else{
	    		$html .="<label for=\"radioSeat".$i."\">".sprintf('%02u', $i)."</label>";	
	    	}
	    }

        $html .="</div>";

              if($i%2==0){
              	$html .="<div class=\"col-md-2\"></div>";
              }

              if($i%4==0){
              	$html .="</div><div class=\"row\">";
              }
        }

        $html .="</div>";

        return response()->json(['success'=>$html]);
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\ApiController;

class CustomerController extends Controller
{
    public function show()
    {


    	if (Auth::user()){	

    		$userid=auth()->user()->id;
    		$reservations = Reservation::where('user_id', $userid)->orderBy('id', 'DESC')->get();
    		$resdata=array();
    		$i=0;
    		foreach ($reservations as $reservation) {

    			$startlocation=$reservation['start_location'];
		     	$endlocation=$reservation['end_location'];

		     	$city=ApiController::get_api_data('city/'.$startlocation);
		    	$city = json_decode(trim($city), TRUE);
		    	$start_location=$city[0]['city_name'];

		    	$city=ApiController::get_api_data('city/'.$endlocation);
		    	$city = json_decode(trim($city), TRUE);
		    	$end_location=$city[0]['city_name'];

		    	$res_id= Crypt::encrypt($reservation['id']);

    			$resdata[$i]['no']=$i+1;
    			$resdata[$i]['id']=$reservation['id'];
    			$resdata[$i]['travel_date']=$reservation['travel_date'];
    			$resdata[$i]['start_location']=$start_location;
    			$resdata[$i]['end_location']=$end_location;
    			$resdata[$i]['res_id']=$res_id;
    			$i++;
    		}
    		
        	return view('dashboard.index')->with('reservations',$resdata);

        }else{
        	return redirect('/login');
        }
    }

    public function view($id){
     	$resid = Crypt::decrypt($id);
     	$data = Reservation::find($resid);

     	$startlocation=$data['start_location'];
     	$endlocation=$data['end_location'];
     	$vehicleno=$data['vehicle_no'];

     	$city=ApiController::get_api_data('city/'.$startlocation);
    	$city = json_decode(trim($city), TRUE);
    	$start_location=$city[0]['city_name'];

    	$city=ApiController::get_api_data('city/'.$endlocation);
    	$city = json_decode(trim($city), TRUE);
    	$end_location=$city[0]['city_name'];

    	$bus=ApiController::get_api_data('bus/'.$vehicleno);
    	$bus = json_decode(trim($bus), TRUE);
    	$bus_no=$bus[0]['bus_no'];
    	$bus_name=$bus[0]['bus_name'];
    	$start_time=$bus[0]['start-time'];

     	$apidata = array(
		    'start_location' => $start_location,
		    'end_location' => $end_location,
		    'bus_no' => $bus_no,
		    'bus_name' => $bus_name,
		    'start_time' => $start_time,
		);
		     	return view('dashboard.view')->with('data',$data)->with('apidata', $apidata);
     }

    
}

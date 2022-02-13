<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Crypt;

class ReservationController extends Controller
{
    public function show()
    {
    	$cities=self::get_api_data('cities');
    	$cities = json_decode(trim($cities), TRUE);

    	$buses=self::get_api_data('buses');
    	$buses = json_decode(trim($buses), TRUE);
    
    	if (Auth::user()){	
        	return view('reservation.index')->with('cities',$cities)->with('buses',$buses);
        }else{
        	return redirect('/login');
        }
    }

    public function book(ReservationRequest $request) 
    {
        $reservation = Reservation::create($request->validated());

        $insertedId = $reservation->id;
        $insId= Crypt::encrypt($insertedId);

        if($insertedId){
        	return redirect('/reservation/'.$insId);
        }else{
        	return redirect('/reservation')->with('error', "Something went wrong, please try again.");
        }

        
    }

     public function view($id){
     	$resid = Crypt::decrypt($id);
     	$data = Reservation::find($resid);

     	$startlocation=$data['start_location'];
     	$endlocation=$data['end_location'];
     	$vehicleno=$data['vehicle_no'];

     	$city=self::get_api_data('city/'.$startlocation);
    	$city = json_decode(trim($city), TRUE);
    	$start_location=$city[0]['city_name'];

    	$city=self::get_api_data('city/'.$endlocation);
    	$city = json_decode(trim($city), TRUE);
    	$end_location=$city[0]['city_name'];

    	$bus=self::get_api_data('bus/'.$vehicleno);
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
		     	return view('reservation.view')->with('data',$data)->with('apidata', $apidata);
     }

     public function get_api_data($requesturl){
     	$burl="http://localhost/VV/ticket-reservation/public/";
	    $url = $burl."api/".$requesturl;

	    $curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return $response;

	}
}

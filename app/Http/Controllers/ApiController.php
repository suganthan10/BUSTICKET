<?php

namespace App\Http\Controllers;
use App\Models\City;
use App\Models\Bus;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAllCities() {
      	$cities = City::get()->toJson(JSON_PRETTY_PRINT);
    	return response($cities, 200);
    }

    public function getCity($id) {
      	if (City::where('id', $id)->exists()) {
	        $city = City::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
	        return response($city, 200);
	    } else {
	        return response()->json([
	          "message" => "City not found"
	        ], 404);
	    }
    }

    public function getAllBuses() {
      	$cities = Bus::get()->toJson(JSON_PRETTY_PRINT);
    	return response($cities, 200);
    }

    public function getBus($id) {
      	if (Bus::where('id', $id)->exists()) {
	        $bus = Bus::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
	        return response($bus, 200);
	    } else {
	        return response()->json([
	          "message" => "Bus not found"
	        ], 404);
	    }
    }
}

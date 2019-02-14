<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ListItem;
use App\City;
use App\Developer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function store(Request $request) {
    	$listItem = $request->all();

    	ListItem::create($listItem);
    }

    public function show($id) {
      try {
        $listItem = ListItem::findOrFail($id);

        $city_collection = City::find($listItem->city_id);
        $city = $city_collection->name;
        $country = $city_collection->country;

        $developer = Developer::find($listItem->developer_id);
        $dev_name = $developer->name;
        
        $estate_element = new \stdClass();

        $estate_element->name = $dev_name;
        $estate_element->city = $city;
        $estate_element->country = $country;
        $estate_element->price = $listItem->price;
        $estate_element->isOnSale = ($listItem->isOnSale == 1) ? 'Yes' : 'No';


      } catch (\Exception $e) {
        return response()->json(['error'=> 'Estate not found'], 401);  
      }
      
      return response()->json($estate_element);
    }

    public function index(Request $request)
    {

		$query = DB::table('lists');

		if($request->has('price')) {
		    $query->where('price', '<', $request->price);
		}
    	if ($request->has('isOnSale')) {
    		$query->where('isOnsale', '=', $request->isOnSale);
    	}

    	if ($request->has('country')) { 
    		$query->where('city_id', '=', $request->country);
    	}

    	$result = [];

    	$estates = $query->get();

    	foreach ($estates as $estate) {
    		$estate_element = new \stdClass();
    		$country = City::find($estate->city_id)->country;
    		$estate_element->id = $estate->id;
    		$estate_element->country = $country;
    		$estate_element->name = $estate->name;
    		$estate_element->price = $estate->price;
    		$estate_element->isOnSale = $estate->isOnSale;
    		$result[] = $estate_element;
    	}

        return response()->json($result);
    }  
}
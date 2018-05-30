<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CityTest;

class CityTestController extends Controller
{
    public function index()
    {
        return view('citytest');
    }

    public function getCity(Request $request){
		//print_r($request->all());
		$columns = array(
			0 => 'city_name',
			1 => 'status',
			3 => 'action'
		);
		
		$totalData = CityTest::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value')))
		{
			$cities = CityTest::offset($start)
					->limit($limit)
					->orderBy($order,$dir)
					->get();
			$totalFiltered = CityTest::count();
		}else
		{
			$search = $request->input('search.value');
			$cities = CityTest::where('city_name', 'like', "%{$search}%")
					->orWhere('status','like',"%{$search}%")
					->offset($start)
					->limit($limit)
					->orderBy($order, $dir)
					->get();
			$totalFiltered = CityTest::where('city_name', 'like', "%{$search}%")
							->orWhere('status','like',"%{$search}%")
							->count();
		}		
					
		
		$data = array();
		
		if($cities){
			foreach($cities as $i){
				$nestedData['city_name'] = $i->city_name;
				$nestedData['status'] = $i->status;
				$nestedData['action'] = '
					<a href="#" class="btn btn-primary ">Edit</a>
					<a href="#" class="btn btn-primary ">Delete</a>
				';
				$data[] = $nestedData;
			}
		}
		
		$json_data = array(
			"draw"			=> intval($request->input('draw')),
			"recordsTotal"	=> intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data"			=> $data
		);
		
		echo json_encode($json_data);
	}

}

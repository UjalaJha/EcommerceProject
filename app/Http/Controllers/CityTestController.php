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
	 public function jsondata(Request $request)
    {
        $table = "city";
        $table_id = 'city_id';
        $default_sort_column = 'city_name';
        $default_sort_order = 'asc';
        $totalData = City::count();
        $condition = true;
        $page = $request->input('iDisplayStart');
        $rows = $request->input('iDisplayLength'); 
        //$sort=$default_sort_column;
        //$order=$default_sort_order;
        $colArray = array(
            0 => 'city_name',
            1 => 'status',
            3 => 'action'
        );
        if($request->input('iSortCol_0')!=NULL)
        {
            $sort= $colArray[$request->input('iSortCol_0')];
        }else
        {
            $sort=$default_sort_column;
        }
        if($request->input('sSortDir_0')!=NULL)
        {
            $order=strval($request->input('sSortDir_0'));
        }else
        {
            $order=$default_sort_order;
        }
        
        $cities = City::orderBy($sort, $order)
                    ->offset($page)
                    ->limit($rows)
                    ->get();

        $totalFiltered = City::count();

        if(empty($request->input('sSearch_0')))
        {
            $cities = City::orderBy($sort, $order)
                    ->offset($page)
                    ->limit($rows)
                    ->get();
            $totalFiltered = City::count();
        }
        else
        {
            $search = $request->input('sSearch_0');
            $cities = City::where('city_name', 'like', "%{$search}%")
                    ->orWhere('status','like',"%{$search}%")
                    ->orderBy($sort, $order)
                    ->limit($rows,$page)
                    ->get();
            $totalFiltered = City::where('city_name', 'like', "%{$search}%")
                            ->orWhere('status','like',"%{$search}%")
                            ->count();
        }   
        $result = array();   
        $result["sEcho"]= $request->input('sEcho');
        $result["iTotalRecords"] =  $totalFiltered; 
        $result["iTotalDisplayRecords"]=  $totalFiltered;
        $items = array();
        if($cities){
            foreach($cities as $i)
            {
                $temp = array();
                array_push($temp, $i->city_name);
                array_push($temp, $i->status);
                $actionCol = "";
                $actionCol ='<button class="delete-modal btn btn-primary" data-identity="'.$i->city_id.'"
                            data-name="'.$i->city_name.'">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                            </button>
                            <button class="edit-modal btn btn-primary"
                            data-info="'.$i->city_id.','.$i->city_name.','.$i->status.'">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                            </button>';
                array_push($temp, $actionCol);
                array_push($items, $temp);
            }
        }
        $result["aaData"] = $items;
        $result["success"]=true;
        // convert the result array to json format
        echo json_encode($result);
        exit;   
        
    }
}

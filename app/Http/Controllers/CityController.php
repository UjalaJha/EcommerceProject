<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\City;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('city');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    public function editdata(Request $request)
    {
         $rules = array (
            'city_name' => 'required|alpha',
            );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
        return Response::json ( array (             
                'errors' => $validator->getMessageBag()->toArray () 
        ) );
        else {
            $data = City::find ( $request->city_id );
            $data->city_name = ($request->city_name);
            $data->status = ($request->status);
            $data->save ();
            return response ()->json ( $data );
        }
    }


    
    public function delete(Request $request)
    {
        City::find($request->id)->delete ();
        return response()->json();
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
        }else
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
                $actionCol ='<button class="delete-modal btn btn-info" data-identity="'.$i->city_id.'"
                            data-name="'.$i->city_name.'">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                            </button>
                            <button class="edit-modal btn btn-danger"
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

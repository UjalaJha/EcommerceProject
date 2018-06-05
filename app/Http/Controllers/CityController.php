<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\City;
use DB;
use Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Redirect;


class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // error_log('Some message here.');
        // $this->info('Display this on the screen');
        // Log::info('Showing user profile for user: ');
        //print_r("Hello");
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
        //
    }

    //Fetch and edit data from DB 
    public function editdata(Request $request)
    {
         
        $data = City::find($request->city_id);
        $data->city_name = ($request->city_name);
        $data->status = ($request->status);
        $data->save();
        return response()->json($data);
    }
    

    //Fetch and delete data from DB 
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


    

    public function export()
    {
        
        $data = City::get()->toArray();
        return Excel::create('city list', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download('pdf');
    }
    public function import(Request $request)
    {
        
        if(Input::hasFile('import_file'))
        {
            
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if (Schema::hasTable('data'))
            {
                $request->session()->flash('alert-warning', 'The data already exists!');
                return redirect('/city');
            }
            else
            {
               Schema::create('data', function($table)
                {
                    $table->increments('id');
                    $table->integer('pid');
                    $table->string('name');
                });
                if(!empty($data) && $data->count())
                {               
                    foreach ($data as $key => $value) {
                        $insert[] = ['pid' => $value->pid, 'name' => $value->name];
                    }
                    if(!empty($insert)){
                        DB::table('data')->insert($insert);
                        $request->session()->flash('alert-success', 'Data was successful Imported!');
                        return redirect('/city');
                        //echo ('Record inserted successfully.');
                    }
                    else 
                    {
                        $request->session()->flash('alert-warning', 'Data import was unsuccessful!');
                        return redirect('/city');
                    }
                }
                else
                {
                     $request->session()->flash('alert-warning', 'No data to import!');
                        return redirect('/city');
                }
                
            }   
        }
        else
        {
            $request->session()->flash('alert-warning', 'File not added!');
            return redirect('/city');
        } 
        
    }  
}
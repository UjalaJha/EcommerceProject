<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\City;

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
        //
    }

    public function fetch(){
    
    //call getrecords function from the Testmodel
    //print_r($_GET);
    //die();
    $city = new City();
    $get_result = $city->getRecords($_GET);
    

    //Response from server 
    //declare result as an array
    $result = array();
    //sEcho --
    $result["sEcho"]= $_GET['sEcho'];
    //iTotalRecords -- total records before filtering
    $result["iTotalRecords"] = $get_result['totalRecords']; 
    //iTotalDisplayRecords -- total records after filtering                         
    $result["iTotalDisplayRecords"]= $get_result['totalRecords'];                             
    
    //declare items as array
    $items = array();
    for($i=0;$i<sizeof($get_result['query_result']);$i++){
        $temp = array();
        array_push($temp, $get_result['query_result'][$i]->city_name );
        array_push($temp, $get_result['query_result'][$i]->status );
        array_push($items, $temp);
    }

    //2D array of data
    $result["aaData"] = $items;
    $result["success"]=true;

    // convert the result array to json format
    echo json_encode($result);
    exit;   
    
 }


}

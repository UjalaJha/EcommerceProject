<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use App\ProductImages;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
// use Illuminate\Contracts\Validation\Validator;
// use Illuminate\Foundation\Validation\ValidatesRequests;
use Validator;
use Illuminate\Support\Facades\Redirect;

//use App\Http\Controllers\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product');
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
    public function purchase()
    {

        return view('productbuy');
    }
    public function printcopy()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('pdf');
        // $pdf = PDF::loadView('pdf.invoice', $data);
        return $pdf->stream();
    }
    public function deletepicture(Request $request)
    {

        ProductImages::find($request->product_image_id)->delete ();
        return response()->json();
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addedit($id=null)
    {
        $data=null;
        $data=Product::find($id);
        $images=ProductImages::where('product_id',$id)->get();
        return view('addeditproduct')->with('data',$data)->with('images',$images);

    }
    public function submitform(Request $request)
    {
    
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            //for edited entries
            if(!empty($request->product_id))
            {
                $this->validate($request, [
                'product_name' => 'required',
                'product_code' => 'required',
                'meta_title' => 'required'
                ]);

                $result=null;
                $product_id=$_POST['product_id'];
                $result=new Product;
                $result = Product::find($product_id);  
                $result->product_name = $_POST['product_name'];
                $result->product_code= $_POST['product_code'];
                $result->product_price = $_POST['product_price'];
                $result->quantity = $_POST['quantity'];
                $result->status = $_POST['status'];
                $result->created_on = date('Y-m-d H:i:s');  
                //created_by hardcoded
                $result->created_by = '22'; 
                $result->product_description = $_POST['product_description'];
                $result->product_short_description = $_POST['product_short_description'];
                $result->meta_title = $_POST['meta_title'];
                $result->meta_description = $_POST['meta_description'];
                $result->meta_keywords = $_POST['meta_keywords'];
                $result->save();
                $id=$result->product_id;


                if(!empty($request->catalog_image_title ))
                {
                  foreach($request->catalog_image_title as $key=>$value)
                { 
                    if($request->file.$key)
                    {
                        $file = $request->File('file'.$key)->getPathName();
                        $imageName = $request->File('file'.$key)->getClientOriginalName();
                        $path = base_path() . '/public/cover_images/';
                        $request->File('file'.$key)->move($path , $imageName);
                        $fileNameToStore = $imageName;
                    }
                    else
                    {
                        $fileNameToStore='noimage.jpg';
                    }


                    $picture = array(); 
                    //$picture['product_image_name']=$request->catalog_image_name[$key];
                    $picture['product_image_title']=$request->catalog_image_title[$key];
                    $picture['product_image_name']= $fileNameToStore;
                    $picture['product_image_price']=$request->catalog_image_price[$key];
                    $picture['default_img']=$request->default[$key];
                    $picture['product_image_status']=$request->catalog_image_status[$key];
                    $picture['created_on'] = date('Y-m-d H:i:s'); 
                    $picture['product_id']=$id;
                    $check=$request->catalog_image_id[$key];
                    if($check>1)
                    {

                    }
                    else
                    {
                        ProductImages::insert($picture); 
                    }
                   

                }  
                }
                


                if(!empty($result))
                {
              
                    echo json_encode(array('success'=>'1','msg'=>'Record Inserted Successfully.'));
                    exit;
                }
                else
                {
                    echo json_encode(array('success'=>'0','msg'=>'Problem in data update.'));
                    exit;
                }
                
            }
            else
            {
                //for new entries
                // $this->validate($request, [
                // 'product_name' => 'required|unique:tbl_products',
                // 'product_code' => 'required|unique:tbl_products',
                // 'meta_title' => 'required'
                // ]);
                $validator = Validator::make($request->all(), [
                    'product_name' => 'required|unique:tbl_products',
                    'product_code' => 'required|unique:tbl_products',
                    'meta_title' => 'required',
                ]);

                //to edit json
                if ($validator->fails()) {
                   $errors = [];
                    foreach($validator->getMessageBag()->toArray() as $key=>$messages) {
                        $errors[$key] = $messages[0];
                    }
                    return response()->json($errors, 322);
                }

                $result=new Product;
                $result->product_name = $request->product_name;
                $result->product_code= $request->product_code;
                $result->product_price = $request->product_price;
                $result->quantity = $request->quantity ;
                $result->status = $request->status;
                $result->created_on = date('Y-m-d H:i:s');  
                //created_by hardcoded
                $result->created_by = '22'; 
                $result->product_description = $request->product_description;
                $result->product_short_description = $request->product_short_description;
                $result->meta_title = $request->meta_title;
                $result->meta_description = $request->meta_description;
                $result->meta_keywords = $request->meta_keywords;
                $result->save();

                $id=$result->product_id;

                foreach($request->catalog_image_title as $key=>$value)
                { 
                    
                    if($request->file.$key)
                    {
                        $file = $request->File('file'.$key)->getPathName();
                        $imageName = $request->File('file'.$key)->getClientOriginalName();
                        $path = base_path() . '/public/cover_images/';
                        $request->File('file'.$key)->move($path , $imageName);
                        $fileNameToStore = $imageName;
                    }
                    else
                    {
                        $fileNameToStore='noimage.jpg';
                    }


                    $picture = array(); 
                    //$picture['product_image_name']=$request->catalog_image_name[$key];
                    $picture['product_image_title']=$request->catalog_image_title[$key];
                    $picture['product_image_name']= $fileNameToStore;
                    $picture['product_image_price']=$request->catalog_image_price[$key];
                    $picture['default_img']=$request->default[$key];
                    $picture['product_image_status']=$request->catalog_image_status[$key];
                    $picture['created_on'] = date('Y-m-d H:i:s'); 
                    $picture['product_id']=$id;


                    ProductImages::insert($picture);                
                }

                if(!empty($result))
                {
              
                    echo json_encode(array('success'=>'1','msg'=>'Record Inserted Successfully.'));
                    exit;
                }
                else
                {
                    echo json_encode(array('success'=>'0','msg'=>'Problem in data update.'));
                    exit;
                }
            }
                           
        }
        else
        {
            return false;
        }
        
            
        
    
    }

    public function destroy($id)
    {
        //
    }
    public function jsondata(Request $request)
    {
        $table = "tbl_products";
        $table_id = 'product_id';
        $default_sort_column = 'product_id';
        $default_sort_order = 'desc';
        $totalData = Product::count();
        $condition = true;
        $page = $request->input('iDisplayStart');
        $rows = $request->input('iDisplayLength'); 
        //$sort=$default_sort_column;
        //$order=$default_sort_order;
        $colArray = array(
            0 => 'product_name',
            1 => 'product_code',
            3 => 'product_price',
            4 => 'quantity',
            5 => 'status'
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
        
        $products = Product::orderBy($sort, $order)
                    ->offset($page)
                    ->limit($rows)
                    ->get();
        $totalFiltered = Product::count();
        if(empty($request->input('sSearch_0')))
        {
            $products = Product::orderBy($sort, $order)
                    ->offset($page)
                    ->limit($rows)
                    ->get();
            $totalFiltered = Product::count();
        }else
        {
           for($i=0;$i<7;$i++)
            {
                if(($request->input('sSearch_'.$i)) && $request->input('sSearch_'.$i)!='')
                {
                    $condition .= " && $colArray[$i] like '%".$request->input('sSearch_'.$i)."%'";
                }
                
            }
            $search1 = $request->input('Searchkey_0');
            $search2 = $request->input('Searchkey_1');
            
            $products = Product::where([['product_name','like', "%{$search1}%"],['product_code','like',
                "%{$search2}%"]])
                    ->orderBy($sort, $order)
                    ->offset($page)
                    ->limit($rows)
                    ->get();
            $totalFiltered =  Product::where([['product_name','like','dem%'],['product_code','like','121%']])
                            ->orWhere('product_code','like','121%')
                            ->count();
        }
        
        


        $result = array();   
        $result["sEcho"]= $request->input('sEcho');
        $result["iTotalRecords"] =  $totalFiltered; 
        $result["iTotalDisplayRecords"]=  $totalFiltered;
        $items = array();
        if($products){
            foreach($products as $i)
            {
                $temp = array();
                array_push($temp, $i->product_name);
                array_push($temp, $i->product_code);
                array_push($temp, $i->product_price);
                array_push($temp, $i->quantity);
                $status_type = "";
                if($i->status=='Active')
                {
                    $status_type = '<span title="click to Deactivate">Deactivate</span>';
                }else{
                    $status_type = '<span title="click to Activate">Activate</span>';
                }
                $status_change = '<span style="cursor: pointer;" onclick="changestatus('.$i->product_id.');">'.$status_type.'</span>';
                
                array_push($temp, $status_change);

                $actionCol = "";

                $actionCol .='<a href="/productaddedit/'.$i->product_id.'"><i class="fa fa-edit"></i></a>';
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

    function changestatus($product_id){

        $data=Product::find($product_id);

        if($data->status=='Active')
        {
            $data->status='In-active';
            $data->save();
        }
        else
        {
            $data->status='Active';
            $data->save();
        }
        echo 1;
       
      }


}

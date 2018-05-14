<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'city_id';
    protected $table ='city';
    public $timestamps = false;


    function getRecords($get){
        

        // //database parameters
        $table = 'city';
        $table_id = 'city_id';
        $default_sort_column = 'city_name';
        $default_sort_order = 'asc';
        $condition = "1=1";
        
        $colArray = array('i.city_name');

        $page = $get['iDisplayStart'];											
		$rows = $get['iDisplayLength'];										
		                                    
        
    
        $sort = isset($get['iSortCol_0']) ? strval($colArray[$get['iSortCol_0']]) : $default_sort_column;  
        $order = isset($get['sSortDir_0']) ? strval($get['sSortDir_0']) : $default_sort_order;

        for($i=0;$i<7;$i++)
        {
            if(isset($get['sSearch_'.$i]) && $get['sSearch_'.$i]!='')
            {
                $condition .= " && $colArray[$i] like '%".$_GET['sSearch_'.$i]."%'";
            }
            
        }
        

        //query builder 
        $query = DB::table('city');
		$query->where("($condition)");
		$query->orderBy($sort, $order);
		$query->limit($rows,$page);
		$query = $query -> get();
        
        // $this -> db -> select('*');
        // $this -> db -> from('city as i');
        // $this->db->where("($condition)");
        // $this->db->order_by($sort, $order);
        // $this->db->limit($rows,$page);
        // $query = $this -> db -> get();
        

        $this -> db -> select('*');
        $this -> db -> from('city as i');
        $this->db->where("($condition)");
        $this->db->order_by($sort, $order);
        $query1 = $this -> db -> get();

        if($query -> num_rows() >= 1)
        {
            $totcount = $query1-> num_rows();
            return array("query_result" => $query->result(),"totalRecords"=>$totcount);
        }
        else
        {
            return false;
        }
        
        
    }
}

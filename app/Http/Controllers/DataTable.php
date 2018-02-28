<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use jDate;
class DataTable extends Controller
{
    public function DataTableAll($role,$id,Request $request){
        //Get DataTabel Sended Data
        $columns = array( 
          0 => 'fld_User_Id',
          1 => 'fld_User_Id',
          2 => 'fld_Browser',
          3 => 'fld_Ip',
          4 => 'fld_Table_Name',
          6 => 'created_at'
      );
        $totalData= Log::count();
        $totalFiltered = $totalData ; 
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        //End

        switch ($role) {
            //User Logs
            case 'user':
            if(empty($request->input('search.value'))){
                $logs=Log::where('fld_User_Id','=',$id)->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            }
            else {
                $search = $request->input('search.value'); 
                $logs=Log::where('fld_User_Id','=',$id)->where(function($q) use ($search) {
                    $q->where('fld_Ip','LIKE',"%$search%")
                    ->orWhere('fld_Browser','LIKE',"%$search%")
                    ->orWhere('fld_Table_Name','LIKE',"%$search%");
                })->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            }
            $data = array();
            if(!empty($logs))
            {
                $i=1;
                foreach ($logs as $log)
                {
                    $nestedData['id']=$log->id;
                    $nestedData['DT_Row_Index']=$i;
                    $nestedData['fld_User_Id'] = $log->fld_User_Id;
                    $nestedData['fld_Ip'] = $log->fld_Ip;
                    $nestedData['fld_Browser'] =  $log->fld_Browser;
                    $nestedData['fld_Table_Name'] =  $log->fld_Table_Name;
                    $nestedData['created_at'] =  jDate::forge($log->created_at)->format('%y/%m/%d %H:%M');
                       // $nestedData['fld_User_Name'] =  $log->fld_User_Name;
                    $data[] = $nestedData;
                    $i++;

                }
            }
            $json_data = array(
                "draw"            => intval($request->input('draw')),  
                "recordsTotal"    => intval($totalData),  
                "recordsFiltered" => intval($totalFiltered), 
                "data"            => $data   
            );
            echo json_encode($json_data);        
            break;
            //End User Logs

            //Table Logs
            case 'table':
            if(empty($request->input('search.value'))){
                $logs=Log::where('fld_Table_Name','=',$id)->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            }
            else {
                $search = $request->input('search.value'); 
                $logs=Log::where('fld_Table_Name','=',$id)->where(function($q) use ($search) {
                    $q->where('fld_Ip','LIKE',"%$search%")
                    ->orWhere('fld_Browser','LIKE',"%$search%")
                    ->orWhere('fld_User_Id','LIKE',"%$search%");
                })->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            }
            $data = array();
            if(!empty($logs))
            {
                $i=1;
                foreach ($logs as $log)
                {
                    $nestedData['id']=$log->id;
                    $nestedData['DT_Row_Index']=$i;
                    $nestedData['fld_User_Id'] = $log->fld_User_Id;
                    $nestedData['fld_Ip'] = $log->fld_Ip;
                    $nestedData['fld_Browser'] =  $log->fld_Browser;
                    $nestedData['fld_Table_Name'] =  $log->fld_Table_Name;
                    $nestedData['created_at'] =  jDate::forge($log->created_at)->format('%y/%m/%d %H:%M');
                       // $nestedData['fld_User_Name'] =  $log->fld_User_Name;
                    $data[] = $nestedData;
                    $i++;

                }
            }
            $json_data = array(
                "draw"            => intval($request->input('draw')),  
                "recordsTotal"    => intval($totalData),  
                "recordsFiltered" => intval($totalFiltered), 
                "data"            => $data   
            );
            echo json_encode($json_data); 
            break;
            //End Table Logs

        }
    }
}

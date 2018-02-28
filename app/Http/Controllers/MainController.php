<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Log;
use jDate;
use Illuminate\Http\Response;
class MainController extends Controller
{
	public function newLog($json){
		$json=json_decode($json);
		$log=new Log;
		$log->fld_User_Id=$json->user;
		$log->fld_Table_Name=$json->table;
		$log->fld_Ip=$json->ip;
		$log->fld_Browser=$json->browser;
		$log->fld_Changed_Items=json_encode($json->changes);
		$log->save();
		echo "Saved Succsesfully";
	}
	public function DataTableAll(Request $request){
		$logs=Log::all();
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
		if(empty($request->input('search.value'))){
                $logs=Log::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            }
            else {
                $search = $request->input('search.value'); 
                $logs=Log::where('fld_User_Id','=',$id)->where(function($q) use ($search) {
                    $q->where('fld_Ip','LIKE',"%$search%")
                    ->orWhere('fld_Browser','LIKE',"%$search%")
                     ->orWhere('fld_Table_Name','LIKE',"%$search%")
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
	}
	public function fieldsLog($id){
		$Log=Log::find($id);
		$fieldsLog=json_decode($Log->fld_Changed_Items, true);
		return datatables()->collection($fieldsLog)->addIndexColumn()->toJson();
	}
	public function allLog(){
		return view('index');
	}
	public function userLogs($userId){
		return view('userLogs')->with('userId',$userId);
	}
	public function tableLogs($tableId){
		return view('tableLogs')->with('tableId',$tableId);
	}

}

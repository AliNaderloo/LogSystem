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
		$log->fld_Changed_Items=json_encode($json->changes);
		$log->save();
		echo "Saved Succsesfully";
	}
	public function DataTable(){
		$logs=Log::all();
		foreach ($logs as $log) {
			$log->created_at = jDate::forge($log->created_at)->format('datetime');
		}
		return datatables()->collection($logs)->addIndexColumn()->toJson();
	}
	public function fieldsLog($id){
		$Log=Log::find($id);
		$fieldsLog=json_decode($Log->fld_Changed_Items, true);
		return datatables()->collection($fieldsLog)->addIndexColumn()->toJson();
	}
	public function allLog(){
		return view('index');
	}
}

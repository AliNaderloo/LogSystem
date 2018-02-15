<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
class MainController extends Controller
{
 public function newLog(Request $req){
   $log=new Log;
   $log->fld_User_Id=$req->input('user_Id');
   $log->fld_Table_Name=$req->input('table_Name');
   $log->fld_Changed_Items=$req->input('changed_Items');
   $log->save();
 }
}

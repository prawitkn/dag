<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class DagSchoolController extends Controller
{
    public function index()
    {	
    	date_default_timezone_set('Asia/Bangkok');
    	$mytime = date('Y-m-d H:i:s');
        // return view('online_store.index')->with(compact('mytime'));

        if(Auth::user()->isAdmin()){
        	return view('dag_school.dashboard')->with(compact('mytime'));
        }	
        if(Auth::user()->isOnlineStoreSalesAdmin()){
        	return view('dag_school.dashboard')->with(compact('mytime'));
        }
    }
}

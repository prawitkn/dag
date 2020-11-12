<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\OssServiceData;
use App\OssServiceTopic;
use App\OssServiceType;

class OssServiceDataController extends Controller
{
    //
    public function list_view()
    {	
    	return view('oss.service-data.index');
    }
    public function list(){
		// $res = [];		
		// $programs = DB::table('dags_programs as a')->select('a.*'
		// 	)
		// 	->get();

		// $res = [
		// 	'success'=> 'success',
		// 	'count'=> $programs->count(),
		// 	'items'=> $programs,
		// 	'msg'=> 'เรียบร้อย.',
		// ];

		// return $res;		
	}
    public function new()
    {	
    	$service_types = OssServiceType::where('status','=',1)->get();
    	$service_topics = OssServiceTopic::where('status','=',1)->get();

    	return view('oss.service-data.new')->with(compact('service_types','service_topics'));
    }

    public function create(Request $req){
		$res = [];
		
		$tmp = $req->all();
		try{
			$issue_date = str_replace('/', '-', $req['issue_date']);
			$issue_date = date('Y-m-d', strtotime($issue_date));
			
			$service_data = new OssServiceData;
			$service_data->issue_date = $issue_date;
			$service_data->service_type_id = $req['service_type_id'];
			$service_data->service_topic_id =  $req['service_topic_id'];
			$service_data->remark =  $req['remark'];
			$service_data->created_by = Auth::user()->id;

			$service_data->save();		

			$res = [
				'success'=> 'success',
				'msg'=> 'สำเร็จ',
			];
			return $res;			
		}catch(Exception $e){
            Log::warning(sprintf('Exception: %s', $e->getMessage()));

            $res = [
                'success' => 'false',
                'row_count' => 0,
                'items' => [],
                'msg' => $e->getMessage(),
            ];
			return $res;
        }         
		
	}


    public function list_by_service_type(Request $req){
    	$res = [];     
    	if($req->has('service_type_id')){
    		$service_topics = OssServiceTopic::where('service_type_id','=',$req['service_type_id'])->where('status','=',1)->get();

	    	return $res = [
	            'success' => 'success',
	            'row_count' => $service_topics->count(),
	            'items' => $service_topics,
	            'msg' => '',
	        ];
    	}else{
    		return $res = [
			            'success' => 'success',
			            'row_count' => 0,
			            'items' => [],
			            'msg' => 'Not found.',
			        ];
    	}
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\DagsMainCourse;
use App\DagsProgram;

class DagsProgramMainCourseController extends Controller
{
    public function list_view()
    {	
    	return view('dag_school.main_courses.index');
    }
    public function list(){
		$res = [];		
		$main_courses = DB::table('dags_program_main_courses as a')->select('a.*'
			)
			->get();

		$res = [
			'success'=> 'success',
			'count'=> $main_courses->count(),
			'items'=> $main_courses,
			'msg'=> 'เรียบร้อย.',
		];

		return $res;		
	}

	public function new_view(Request $request){		
		$programs = DagsProgram::where('status','=',1)->get();
    	return view('dag_school.main_courses.new')->with(compact('programs'));   
	}

	 public function create(Request $req){
		$res = [];

		// return($reference_item_ids);
		$tmp = $req->all();
	

		try{
			$os = UserOnlineStore::where('user_id','=',Auth::user()->id)->first();

			// $first_ship_to = OsUserShipTo::where('customer_id','=',$os->customer_id)
			// 							->where('user_id','=',$os->user_id)->orderByRaw('is_default DESC')->first();
			// if(!$first_ship_to){
			// 	$res = [
			// 		'success'=> 'fail',
			// 		'msg'=> 'ไม่พบสาขาโดยรหัสผู้ใช้',
			// 	];
			// 	return $res;
			// }
			$issue_date = str_replace('/', '-', $req['issue_date']);
			$issue_date = date('Y-m-d', strtotime($issue_date));
			// $issue_date_str = date('Ymd', strtotime($issue_date));
			// $req['issue_date'] = $issue_date;

			$due_date = $issue_date;
			// $due_date = date('Y-m-d', strtotime("+1 day", $due_date));
			// $req['due_date'] = $due_date;

			if(Auth::user()->id){
				$user_ship_tos = OsUserShipTo::where('customer_id','=',$os->customer_id)
										->where('user_id','=',$os->user_id)->orderByRaw('is_default DESC')->get();
				if($user_ship_tos){
					foreach($user_ship_tos as $key => $item){
						$order = new OsOrder;
						$order->issue_date = $issue_date;
						$order->due_date = $due_date;
						$order->customer_id = $os->customer_id;
						$order->ship_to_id = $item->ship_to_id;
						$order->created_by = $os->user_id;
						// Check before insert new order by branche
						$check_order = OsOrder::where('customer_id','=',$os->customer_id)
							->where('ship_to_id','=',$item->ship_to_id)
							->where('issue_date','=',$issue_date)->first();
						if(!$check_order){
							$order->save();							
						}

						//reset brance
						$ship_to = OsShipToCustomer::find($item->ship_to_id);
						$ship_to->last_updated_at = null;
						$ship_to->save();
				  	} //foreach
				} //if($user_ship_tos)
			}

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

	public function edit_view(Request $req, $id)
    {

        $main_course = DagsMainCourse::where('id','=',$id)->first();

        return view('dag_school.main_courses.edit')->with(compact('main_course'));
    }

    public function update(Request $req){
        $res = [];      
        try{
            if($req->isMethod('post')){                
                // check duplicate product_category code
               	$main_course = DagsMainCourse::where('main_course_name','=',$req['main_course_name'])
                	->where('id','<>',$req['id'])->first();
                if($main_course){
                	$res = [
		                'success' => 'false',
		                'msg' => 'ผิดพลาด : ข้อมูลซ้ำ รหัส '.$req['main_course_name'].' มีในฐานข้อมูลแล้ว',
		            ];
        			return $res;
                }

                $main_course = DagsMainCourse::find($req['id']);

                if(!$main_course){
                    // Error 
                    $res = [
		                'success' => 'false',
		                'msg' => 'ไม่พบข้อมูล',
		            ];
        			return $res;
                }else{ 
                    // Update
                    $main_course['main_course_name'] = $req['main_course_name'];
                    $main_course['status'] = ($req['status']?1:0);
                    $main_course['updated_by'] = Auth::user()->id;
                    $main_course->save(); 
                }
                
                $res = [
                    'success' => 'success',
                    'row_count' => 1,
                    'items' => $main_course,
                    'msg' => 'บันทึกข้อมูลสำเร็จ.',
                ];
            } // if post
        }catch(Exception $e){
            Log::warning(sprintf('Exception: %s', $e->getMessage()));

            $res = [
                'success' => 'false',
                'row_count' => 0,
                'items' => [],
                'msg' => $e->getMessage(),
            ];
        }         
        return $res;
    }
}
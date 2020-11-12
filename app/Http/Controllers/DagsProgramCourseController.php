<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\DagsProgram;
use App\DagsProgramCourse;

class DagsProgramCourseController extends Controller
{
    public function list_view()
    {	
        // $program = DagsProgram::find($program_id);
        $programs = DagsProgram::where('status','=',1)->get();
    	return view('dag_school.courses.index')->with(compact('programs'));
    }
    public function list(Request $req){
		$res = [];		
		$courses = DB::table('dags_program_courses as a')->select('a.*'
			)
        ->where('a.program_id','=',$req['program_id'])
        ->orderBy('course_hierarchy','ASC')
			->get();

		$res = [
			'success'=> 'success',
			'count'=> $courses->count(),
			'items'=> $courses,
			'msg'=> 'เรียบร้อย.',
		];

		return $res;		
	}

	public function edit_view(Request $req, $item_id)
    {
    	$program_course = DB::table('dags_program_courses as a')
    	->leftjoin('dags_programs as b','b.id','=','a.program_id')
    	->where('a.id','=',$item_id)
    	->select('a.id','a.program_id','a.course_hierarchy','a.course_no','a.course_name','a.course_description','a.course_hours','a.credit','a.status'
    	, 'b.program_name')
    	->first();

        return view('dag_school.courses.edit')->with(compact('program_course'));
    }

    public function update(Request $req){
        $res = [];      
        try{
            if($req->isMethod('post')){                
                // check duplicate product_category code
           //     	$customer = DagsProgramCourse::where('customer_name','=',$req['customer_name'])
           //      	->where('id','<>',$req['id'])->first();
           //      if($customer){
           //      	$res = [
		         //        'success' => 'false',
		         //        'msg' => 'ผิดพลาด : ข้อมูลซ้ำ รหัส '.$req['customer_name'].' มีในฐานข้อมูลแล้ว',
		         //    ];
        			// return $res;
           //      }
                

                $program_course = DagsProgramCourse::find($req['id']);

                if(!$program_course){
                    // Error 
                    $res = [
		                'success' => 'false',
		                'msg' => 'ไม่พบข้อมูล',
		            ];
        			return $res;
                }else{ 
                    // Update
                    $program_course['course_hierarchy'] = $req['course_hierarchy'];
                    $program_course['course_no'] = $req['course_no'];
                    $program_course['course_name'] = $req['course_name'];
                    $program_course['course_description'] = $req['course_description'];
                    $program_course['course_hours'] = $req['course_hours'];
                    $program_course['credit'] = $req['credit'];
                    $program_course['status'] = ($req['status']?1:0);
                    $program_course['updated_by'] = Auth::user()->id;
                    $program_course->save(); 
                }
                
                $res = [
                    'success' => 'success',
                    'row_count' => 1,
                    'items' => $program_course,
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

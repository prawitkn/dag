<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\DagsProgramClass;

class DagsProgramClassStudentController extends Controller
{
    public function list_view()
    {	
        $program_classes = DB::table('dags_program_classes as a')
        ->join('dags_programs as b','b.id','=','a.program_id')
        ->select('a.id','a.program_class_name'
    	,'b.program_name')
    	->where('a.status','=',1)
        ->get();

    	return view('dag_school.class_students.index')->with(compact('program_classes'));
    }
    public function list(Request $req){
		$res = [];		
		$program_class_students = DB::table('dags_program_classes as a')
		->join('dags_program_class_students as b','b.program_class_id','=','a.id')
		->join('dags_programs as c','c.id','a.program_id')
		->leftjoin('dags_students as d','d.id','=','b.student_id')
		->select('a.program_class_name','b.status' 
		,'c.program_name','d.student_name','d.org_name')
        ->where('a.id','=',$req['program_class_id'])
        ->orderBy('d.id','ASC')
			->get();

		$res = [
			'success'=> 'success',
			'count'=> $program_class_students->count(),
			'items'=> $program_class_students,
			'msg'=> 'เรียบร้อย.',
		];

		return $res;		
	}

	// public function edit_view(Request $req, $item_id)
 //    {
 //    	$program_course = DB::table('dags_program_classes as a')
 //    	->leftjoin('dags_programs as b','b.id','=','a.program_id')
 //    	->where('a.id','=',$item_id)
 //    	->select('a.id','a.program_id','a.course_hierarchy','a.course_no','a.course_name','a.course_description','a.course_hours','a.credit','a.status'
 //    	, 'b.program_name')
 //    	->first();

 //        return view('dag_school.classes.edit')->with(compact('program_course'));
 //    }

 //    public function update(Request $req){
 //        $res = [];      
 //        try{
 //            if($req->isMethod('post')){                
 //                // check duplicate product_category code
 //           //     	$customer = DagsProgramClass::where('customer_name','=',$req['customer_name'])
 //           //      	->where('id','<>',$req['id'])->first();
 //           //      if($customer){
 //           //      	$res = [
	// 	         //        'success' => 'false',
	// 	         //        'msg' => 'ผิดพลาด : ข้อมูลซ้ำ รหัส '.$req['customer_name'].' มีในฐานข้อมูลแล้ว',
	// 	         //    ];
 //        			// return $res;
 //           //      }
                

 //                $program_course = DagsProgramClass::find($req['id']);

 //                if(!$program_course){
 //                    // Error 
 //                    $res = [
	// 	                'success' => 'false',
	// 	                'msg' => 'ไม่พบข้อมูล',
	// 	            ];
 //        			return $res;
 //                }else{ 
 //                    // Update
 //                    $program_course['course_hierarchy'] = $req['course_hierarchy'];
 //                    $program_course['course_no'] = $req['course_no'];
 //                    $program_course['course_name'] = $req['course_name'];
 //                    $program_course['course_description'] = $req['course_description'];
 //                    $program_course['course_hours'] = $req['course_hours'];
 //                    $program_course['credit'] = $req['credit'];
 //                    $program_course['status'] = ($req['status']?1:0);
 //                    $program_course['updated_by'] = Auth::user()->id;
 //                    $program_course->save(); 
 //                }
                
 //                $res = [
 //                    'success' => 'success',
 //                    'row_count' => 1,
 //                    'items' => $program_course,
 //                    'msg' => 'บันทึกข้อมูลสำเร็จ.',
 //                ];
 //            } // if post
 //        }catch(Exception $e){
 //            Log::warning(sprintf('Exception: %s', $e->getMessage()));

 //            $res = [
 //                'success' => 'false',
 //                'row_count' => 0,
 //                'items' => [],
 //                'msg' => $e->getMessage(),
 //            ];
 //        }         
 //        return $res;
 //    }
}

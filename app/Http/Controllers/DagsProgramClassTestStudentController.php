<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\DagsProgramClassTestStudent;

class DagsProgramClassTestStudentController extends Controller
{
    public function list_view()
    {	
        $program_classes = DB::table('dags_programs as a')
        ->join('dags_program_classes as b','b.program_id','=','a.id')
        ->select('a.program_name'
        	, 'b.id', 'b.program_class_name')
    	->where('a.status','=',1)
        ->get();

    	return view('dag_school.test_students.index')->with(compact('program_classes'));
    }
    public function test_list(Request $req)
    {	
    	$res = [];     
    	if($req->has('class_id')){
    		$tests = DB::select('select b.course_name
    			, c.id, c.program_course_test_name, c.score 
    			FROM dags_program_classes as a
    			join dags_program_courses as b ON b.program_id=a.program_id
    			join dags_program_course_tests as c ON c.program_course_id=b.id 
    			WHERE a.status=1 
    			AND a.id='.$req['class_id']);

    		// $test_id = $req['test_id'];		
	    //     $tests = DB::table('dags_program_classes as a')
	    //     ->join('dags_program_courses as b','b.program_id','=','a.id')
	    //     ->join('dags_program_course_tests as c', function($join) use ($req)
					// {
					// 	$join->on('c.program_course_id','=','b.id');
					// 	$join->on('c.id','=',$req['test_id']);
					// })
	    //     ->select('b.course_name'
	    //     	, 'c.id', 'c.program_course_test_name')
	    // 	->where('a.status','=',1)
	    //     ->where('a.id','=',$req['class_id'])
	    //     ->get();

	    	return $res = [
	            'success' => 'success',
	            // 'row_count' => $tests->count(),
	            'items' => $tests,
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
    public function student_list(Request $req)
    {	
    	$res = [];     
    	if($req->has('class_id') && $req->has('test_id')){
    		$students = DB::select('select a.program_class_name
    			, b.id as class_student_id 
    			, c.student_name, c.org_name 
    			, (SELECT IFNULL(x.score,0) FROM dags_program_class_test_students as x
    					WHERE x.program_course_test_id='.$req['test_id'].' 
    					AND x.class_student_id=b.id) as score
    			FROM dags_program_classes as a
    			join dags_program_class_students as b ON b.program_class_id=a.id 
    				AND b.status=1 
    			join dags_students as c ON c.id=b.student_id  
    				AND c.status=1
    			WHERE a.status=1 
    			AND a.id='.$req['class_id']);

	    	return $res = [
	            'success' => 'success',
	            // 'row_count' => $students->count(),
	            'items' => $students,
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
    public function list(Request $req){
		$res = [];		
		$program_class_students = DB::table('dags_programs as x')
		->join('dags_program_courses as a','a.program_id','=','x.id')
		->join('dags_program_course_tests as b','b.program_course_id','=','a.id')
		->select('b.id', 'a.course_hierarchy', 'a.course_no', 'a.course_name'
			, 'b.program_course_test_name', 'b.status')
        ->where('x.id','=',$req['program_id'])
        ->orderBy('a.course_hierarchy','ASC')
			->get();
			
		$res = [
			'success'=> 'success',
			'count'=> $program_class_students->count(),
			'items'=> $program_class_students,
			'msg'=> 'เรียบร้อย.',
		];

		return $res;		
	}

	public function score_update(Request $req){
		$res = [];

		// return($reference_item_ids);
		$tmp = $req->all();

		try{
			$program = DB::table('dags_program_course_tests as a')
			->join('dags_program_courses as b','b.id','=','a.program_course_id')
			->select('b.program_id')
			->where('a.id','=',$req['test_id'])
			->first();
			if(!$program){
				return $res = [
	                'success' => 'false', 
	                'msg' => 'ไม่พบหลักสูตรโดยรหัสแบบทดสอบ'
	            ];
			}


			// $chk = '';
			$count=0;
			foreach ($req['class_student_ids'] as $key => $item) {
				# code...
				if($req['scores'][$key]>0){
					$student_test = DagsProgramClassTestStudent::where('program_course_test_id','=',$req['test_id'])
						->where('class_student_id','=',$item)->first();
					if($student_test){
						// update
						$student_test = DagsProgramClassTestStudent::find($student_test->id);
						$student_test->score = $req['scores'][$key];
						$student_test->updated_by = Auth::user()->id;
						$student_test->save();
						// $chk.=$item;
					}else{
						$data = array('program_course_test_id' => $req['test_id']
						, 'class_student_id' => $item
						, 'score' => $req['scores'][$key]			
						, 'status' => 1
						, 'created_by' => Auth::user()->id);

						DagsProgramClassTestStudent::insert($data); 
						// $chk.=$item;
					}

					$count+=1;
				}
			}

			// INSERT course test hireacy 
			$result = DB::table('dags_programs as x')
		->join('dags_program_courses as a','a.program_id','=','x.id')
		->join('dags_program_course_tests as b','b.program_course_id','=','a.id')
		->select('b.id', 'a.course_hierarchy', 'a.course_no', 'a.course_name'
			, 'b.program_course_test_name', 'b.status')
        ->where('x.id','=',$req['program_id'])
        ->orderBy('a.course_hierarchy','ASC')
			->get();

		// Insert if not exists
		DB::statement('
			INSERT INTO dags_program_class_test_students (program_course_test_id, class_student_id)
			SELECT a.id, b.id as class_student_id  
			FROM dags_program_course_tests as a 
			CROSS JOIN dags_program_class_students as b ON b.program_class_id='.$req['class_id'].'
			WHERE a.program_course_id IN (SELECT x.id FROM dags_program_courses as x 
			                              					WHERE RIGHT(x.course_hierarchy,4)="0000"
			                              					AND RIGHT(x.course_hierarchy,6)<>"000000"
			                              					)
			AND NOT EXISTS (SELECT m.id FROM dags_program_class_test_students m
			                  				WHERE m.program_course_test_id=a.id
			                  				AND m.class_student_id=b.id )
        ');


			return $res = [
				'success'=> 'success',
				'msg'=> 'บันทึกเรียบร้อย',
				// 'chk'=> $chk,
			];			
		}catch(Exception $e){
            Log::warning(sprintf('Exception: %s', $e->getMessage()));

            return $res = [
                'success' => 'false',
                'row_count' => 0,
                'items' => [],
                'msg' => $e->getMessage(),
            ];
        }         
		
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

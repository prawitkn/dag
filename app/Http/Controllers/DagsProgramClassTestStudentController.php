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
    		$tests = DB::table('dags_program_classes as a')
    		->join('dags_program_courses as b', function( $join ) use ($req){
                $join->on('b.program_id','=','a.program_id');
                $join->where('b.is_calc','=',1);
            })
    		->join('dags_program_course_tests as c','c.program_course_id','=','b.id')
    		->select('b.id as course_id', 'b.course_name'
    			, 'c.id', 'c.program_course_test_name', 'c.score'
    			)
    		->where('a.status','=',1) 
    		->where('a.id','=',$req['class_id'])
    		->orderBy('b.id','ASC')
    		->orderBy('c.id','ASC');
    		$tests = $tests->get();
    		// dd($tests); exit();
    		// dd($tests->toSql()); exit();
    		// echo $tests->toSql(); exit();
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

		try{
			$program_class_id = $req['class_id']; 

			$program = DB::table('dags_program_course_tests as a')
			->join('dags_program_courses as b','b.id','=','a.program_course_id')
			->select('a.program_course_id','a.program_course_test_name','a.score'
				, 'b.program_id','b.course_hierarchy','b.course_no','b.course_name','b.course_description','b.course_hours','b.credit')
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
				} //if
			} //foreach

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
				INSERT INTO dags_program_class_test_students (program_course_test_id, class_student_id, created_by)
				SELECT a.id, b.id as class_student_id,'.Auth::user()->id.'   
				FROM dags_program_course_tests as a 
				CROSS JOIN dags_program_class_students as b ON b.program_class_id='.$program_class_id.'
				WHERE a.program_course_id IN (SELECT x.id FROM dags_program_courses as x 
				                              					WHERE x.is_calc=1 
				                              					)
				AND NOT EXISTS (SELECT m.id FROM dags_program_class_test_students m
				                  				WHERE m.program_course_test_id=a.id
				                  				AND m.class_student_id=b.id )
			');

			// Update Course Test is finished
			DB::statement('UPDATE dags_program_course_tests as a 
				SET a.is_finished=1 
				WHERE a.id='.$req['test_id'].' 
	        ');

	        // Update Course is finished
			DB::statement('UPDATE dags_program_courses as a 
				SET a.is_finished=1 
				, a.score=(SELECT SUM(x.score) FROM dags_program_course_tests as x
							WHERE x.program_course_id=a.id) 
				WHERE a.id='.$program->program_course_id.' 
	        ');
		

			// Update Student Score
			DB::statement('UPDATE dags_program_class_students as a 
				INNER JOIN (SELECT x.class_student_id, SUM(x.score) as total_score FROM dags_program_class_test_students as x
							INNER JOIN dags_program_course_tests as y ON y.id = x.program_course_test_id AND y.is_finished=1 
							INNER JOIN dags_program_courses as z ON z.id = y.program_course_id 
							INNER JOIN dags_program_classes as xx ON xx.program_id = z.program_id AND xx.id = '.$program_class_id.' 
							GROUP BY x.class_student_id) as tmp 
				SET a.score=tmp.total_score 
				WHERE a.program_class_id = '.$program_class_id.' 
				AND a.id = tmp.class_student_id 
	        ');

			// Get Total Score
			// $program_finished = DB::table('dags_program_courses as a')
			// ->select(DB::raw('SUM(a.score) as total_score'))
			// ->where('a.program_id','=',$program->id)
			// ->first();
			// Get Total Score for Calculation
			$course_finished = DB::table('dags_program_courses as a')
			->select(DB::RAW('SUM(a.score) as total_finished_score'))
			->where('a.program_id','=',$program->program_id)
			->where('a.is_finished','=',1)
			->first();

			// Update Summary Score 
			DB::statement('UPDATE dags_program_class_students as a 
				SET a.net_score = a.score / '.$course_finished->total_finished_score.' 
				WHERE a.program_class_id = '.$program_class_id.' 
	        ');
	        // DB::table('dags_program_class_students')
	        // ->update(['a.net_score'=>DB::RAW(' a.score / '.$program_finished->total_score.' ')])
	        // ->where('program_class_id','=',$program_class_id);


				return $res = [
					'success'=> 'success',
					'item'=> $course_finished,
					'msg'=> 'บันทึกเรียบร้อย',
					// 'chk'=> $chk,
				];			
		}catch(Exception $e){
            Log::warning(sprintf('Exception: %s', $e->getMessage()));

            return $res = [
                'success' => 'false',
                'msg' => $e->getMessage(),
            ];
        }         
		
	}
	
}

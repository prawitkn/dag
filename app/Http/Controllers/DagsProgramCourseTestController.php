<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\DagsProgramClass;
use App\DagsProgramCourseTest;

class DagsProgramCourseTestController extends Controller
{
    public function list_view()
    {	
        $programs = DB::table('dags_programs as a')
    	->where('a.status','=',1)
        ->get();

    	return view('dag_school.course_tests.index')->with(compact('programs'));
    }
    public function list(Request $req){
		$res = [];		
		$program_class_students = DB::table('dags_programs as x')
		->join('dags_program_courses as a', function( $join ) use ($req){
                $join->on('a.program_id','=','x.id');
                $join->where('a.is_calc','=',1);
            })
		->join('dags_program_course_tests as b','b.program_course_id','=','a.id')
		->select('b.id', 'a.course_hierarchy', 'a.course_no', 'a.course_name'
			, 'b.program_course_test_name', 'b.score', 'b.status')
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

	public function new_view()
    {	
    	$program_courses = DB::table('dags_program_courses as a')
    	->where('a.status','=',1)
    	->where('a.is_calc','=',1)
    	->select('a.id','a.course_no','a.course_name')
    	->get();

        return view('dag_school.course_tests.new')->with(compact('program_courses'));
    }

    public function create(Request $req){
		$res = [];		
		$user_id = Auth::user()->id;
        try{
            if($req->isMethod('post')){
				$program_course_test = $req->all();  

				// check duplicate  code
				$chk = DagsProgramCourseTest::where('program_course_id','=',$req['program_course_id'])
				->where('program_course_test_name','=',$req['program_course_test_name'])
                ->where('id','<>',$req['id'])->first();
                if($chk){
                	$res = [
		                'success' => 'false',
		                'msg' => 'Fail : Duplicate data : '
		                .'ref. id'.$req['program_course_id'].', '
		                .'test name '.$req['program_course_test_name'].'.',
		            ];
        			return $res;
                }

				$program_course_test['created_by'] = $user_id;
				$program_course_test = DagsProgramCourseTest::create($program_course_test);
				
				$res = [
					'success' => 'success',
					'row_count' => 1,
					'items' => $program_course_test,
					'msg' => 'Successfully.',
				];
            } // if post
        }catch(Exception $e){
            Log::warning(sprintf('Exception: %s', $e->getMessage()));

            $res = [
                'success' => 'false',
                'msg' => $e->getMessage(),
            ];
        }         
        return $res;
    }

	public function edit_view(Request $req, $id)
    {

        $program_course_test = DagsProgramCourseTest::where('id','=',$id)->first();

        $program_courses = DB::table('dags_program_courses as a')
    	->where('a.status','=',1)
    	->where('a.is_calc','=',1)
    	->select('a.id','a.course_no','a.course_name')
    	->get();


        return view('dag_school.course_tests.edit')->with(compact('program_course_test','program_courses'));
    }

    public function update(Request $req){
        $res = [];      
        try{
            if($req->isMethod('post')){                
                // check duplicate  code
				$chk = DagsProgramCourseTest::where('program_course_id','=',$req['program_course_id'])
				->where('program_course_test_name','=',$req['program_course_test_name'])
                ->where('id','<>',$req['id'])->first();
                if($chk){
                	$res = [
		                'success' => 'false',
		                'msg' => 'Fail : Duplicate data : '
		                .'ref. id'.$req['program_course_id'].', '
		                .'test name '.$req['program_course_test_name'].'.',
		            ];
        			return $res;
                }

				$chk = DagsProgramCourseTest::where('program_course_id','=',$req['program_course_id'])
				->where('program_course_test_name','=',$req['program_course_test_name'])
                ->where('id','<>',$req['id'])->first();
                if($chk){
                	$res = [
		                'success' => 'false',
		                'msg' => 'Fail : Duplicate data : '
		                .'ref. id'.$req['program_course_id'].', '
		                .'test name '.$req['program_course_test_name'].'.',
		            ];
        			return $res;
                }
                $program_course_test = DagsProgramCourseTest::find($req['id']);

                if(!$program_course_test){
                    // Error 
                    $res = [
		                'success' => 'false',
		                'msg' => 'Data Not Found.',
		            ];
        			return $res;
                }else{ 
                    // Update
                    $program_course_test['program_course_id'] = $req['program_course_id'];
                    $program_course_test['program_course_test_name'] = $req['program_course_test_name'];
                    $program_course_test['score'] = $req['score'];
                    $program_course_test['status'] = ($req['status']?1:0);
                    $program_course_test['updated_by'] = Auth::user()->id;
                    $program_course_test->save(); 
                }
                
                $res = [
                    'success' => 'success',
                    'row_count' => 1,
                    'items' => $program_course_test,
                    'msg' => 'Successfully.',
                ];
            } // if post
        }catch(Exception $e){
            Log::warning(sprintf('Exception: %s', $e->getMessage()));

            $res = [
                'success' => 'false',
                'msg' => $e->getMessage(),
            ];
        }         
        return $res;
    }
}

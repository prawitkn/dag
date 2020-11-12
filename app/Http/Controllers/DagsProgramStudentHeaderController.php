<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\DagsStudent;
use App\DagsProgramStudentHeader;

class DagsProgramStudentHeaderController extends Controller
{
	public function list_view()
    {	$program_student_headers = DagsProgramStudentHeader::where('status','=',1)->get();
    // dd($program_student_headers);
    	return view('dag_school.students.program_student')->with(compact('program_student_headers'));
    }
    public function list(Request $req){
		$res = [];		

        if($req->has('program_student_id')){
            $students = DB::table('dags_program_student_headers as b')
            ->join('dags_programs as a','b.program_id','=','a.id')
            ->leftjoin('dags_program_students as c','c.program_student_id','=','b.id')
            ->leftjoin('dags_students as d','d.id','=','c.student_id')
            ->select('a.id as program_id','a.program_name','a.status'
                , 'b.program_student_name'
                , 'd.student_name', 'd.org_name'
            )
            ->where('b.id','=',$req['program_student_id'])
            ->get();

            $res = [
                'success'=> 'success',
                'count'=> $students->count(),
                'items'=> $students,
                'msg'=> 'เรียบร้อย.',
            ];
            return $res; 
        }else{
            $res = [
                'success' => 'false',
                'row_count' => 0,
                'items' => [],
                'msg' => 'program student header id not found',
            ];
            return $res; 
        }
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\DagsProgram;
use App\DagsProgramClass;

class DagsProgramClassController extends Controller
{
    public function list_view()
    {	
        $programs = DagsProgram::where('status','=',1)->get();
    	return view('dag_school.classes.index')->with(compact('programs'));
    }
    public function list(Request $req){
		$res = [];		
		$classes = DB::table('dags_program_classes as a')->select('a.*'
			)
        ->where('a.program_id','=',$req['program_id'])
        ->orderBy('a.program_class_name','ASC')
			->get();

		$res = [
			'success'=> 'success',
			'count'=> $classes->count(),
			'items'=> $classes,
			'msg'=> 'เรียบร้อย.',
		];

		return $res;		
	}

	public function edit_view(Request $req, $item_id)
    {
    	$program_class = DB::table('dags_program_classes as a')
    	->leftjoin('dags_programs as b','b.id','=','a.program_id')
    	->where('a.id','=',$item_id)
    	->select('a.id','a.program_id','a.program_class_name','a.program_class_qty'
            ,'a.course_hours','a.credit','a.status','a.course_days'
            ,'a.confirm_title','a.confirm_full_name','a.confirm_position_abb'
            ,'a.approve_title','a.approve_full_name','a.approve_position_abb'
    	   ,'b.program_name')
    	->first();

        $programs = DB::table('dags_programs as a')
        ->where('a.status','=',1)
        ->select('a.id','a.program_name')
        ->get();

        return view('dag_school.classes.edit')->with(compact('program_class','programs'));
    }

    public function update(Request $req){
        $res = [];      
        try{
            if($req->isMethod('post')){             
                $program_class = DagsProgramClass::where('id','=',$req['id'])->first();

                if(!$program_class){
                    $res = [
		                'success' => 'false',
		                'msg' => 'ไม่พบข้อมูล',
		            ];
        			return $res;
                }else{ 
                    // Chk
                    $chk = DagsProgramClass::where('program_id','=',$req['program_id'])
                    ->where('program_class_name','=',$req['program_class_name'])
                    ->where('id','<>',$req['id'])->first();
                    if($chk){
                        return $res = [
                            'success' => 'false',
                            'msg' => 'Fail : Duplicate data : '
                            .'Program : '.$program->program_name.', '
                            .'Class : '.$req['program_class_name'].'.',
                        ];
                    }
                    // Update
                    $program_class['program_id'] = $req['program_id'];
                    $program_class['program_class_name'] = $req['program_class_name'];
                    $program_class['program_class_qty'] = $req['program_class_qty'];
                    $program_class['course_hours'] = $req['course_hours'];
                    $program_class['course_days'] = $req['course_days'];
                    $program_class['confirm_title'] = $req['confirm_title'];
                    $program_class['confirm_full_name'] = $req['confirm_full_name'];
                    $program_class['confirm_position_abb'] = $req['confirm_position_abb'];
                    $program_class['approve_title'] = $req['approve_title'];
                    $program_class['approve_full_name'] = $req['approve_full_name'];
                    $program_class['approve_position_abb'] = $req['approve_position_abb'];
                    $program_class['credit'] = $req['credit'];
                    $program_class['status'] = ($req['status']?1:0);
                    $program_class['updated_by'] = Auth::user()->id;
                    $program_class->save(); 
                }
                
                $res = [
                    'success' => 'success',
                    'row_count' => 1,
                    'items' => $program_class,
                    'msg' => 'บันทึกข้อมูลสำเร็จ.',
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

    public function new_view()
    {   
        $programs = DB::table('dags_programs as a')
        ->where('a.status','=',1)
        ->select('a.id','a.program_name')
        ->get();

        return view('dag_school.classes.new')->with(compact('programs'));
    }

    public function create(Request $req){
        $res = [];      
        $user_id = Auth::user()->id;
        try{
            if($req->isMethod('post')){
                $program_class = $req->all();  

                $program = DagsProgram::where('id','=',$req['program_id'])->first();
                if(!$program){
                    return $res = [
                        'success' => 'false',
                        'msg' => 'Program not found.',
                    ];
                }
                // check duplicate  code
                $chk = DagsProgramClass::where('program_id','=',$req['program_id'])
                ->where('program_class_name','=',$req['program_class_name'])
                ->where('id','<>',$req['id'])->first();
                if($chk){
                    return $res = [
                        'success' => 'false',
                        'msg' => 'Fail : Duplicate data : '
                        .'Program : '.$program->program_name.', '
                        .'Class : '.$req['program_class_name'].'.',
                    ];
                }

                $program_class['created_by'] = $user_id;
                $program_class = DagsProgramClass::create($program_class);
                
                $res = [
                    'success' => 'success',
                    'row_count' => 1,
                    'items' => $program_class,
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

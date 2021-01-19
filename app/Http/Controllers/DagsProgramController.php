<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\DagsProgram;

class DagsProgramController extends Controller
{
    public function list_view()
    {	
    	return view('dag_school.programs.index');
    }
    public function list(){
		$res = [];		
		$programs = DB::table('dags_programs as a')->select('a.*'
			)
			->get();

		$res = [
			'success'=> 'success',
			'count'=> $programs->count(),
			'items'=> $programs,
			'msg'=> 'เรียบร้อย.',
		];

		return $res;		
	}

	public function edit_view(Request $req, $id)
    {

        $program = DagsProgram::where('id','=',$id)->first();

        return view('dag_school.programs.edit')->with(compact('program'));
    }

    public function update(Request $req){
        $res = [];      
        try{
            if($req->isMethod('post')){                
                // check duplicate product_category code
               	$program = DagsProgram::where('program_name','=',$req['program_name'])
                	->where('id','<>',$req['id'])->first();
                if($program){
                	$res = [
		                'success' => 'false',
		                'msg' => 'ผิดพลาด : ข้อมูลซ้ำ รหัส '.$req['program_name'].' มีในฐานข้อมูลแล้ว',
		            ];
        			return $res;
                }

                $program = DagsProgram::find($req['id']);

                if(!$program){
                    // Error 
                    $res = [
		                'success' => 'false',
		                'msg' => 'ไม่พบข้อมูล',
		            ];
        			return $res;
                }else{ 
                    // Update
                    $program['program_name'] = $req['program_name'];
                    // $program['org_name'] = $req['org_name'];
                    $program['status'] = ($req['status']?1:0);
                    $program['updated_by'] = Auth::user()->id;
                    $program->save(); 
                }
                
                $res = [
                    'success' => 'success',
                    'row_count' => 1,
                    'items' => $program,
                    'msg' => 'บันทึกข้อมูลสำเร็จ.',
                ];
                // return back()->with('flash_message_error', 'บันทึกข้อมูลสำเร็จ.');
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

    public function new_view()
    {   
        return view('dag_school.programs.new');
    }

    public function create(Request $req){
        $res = [];      
        $user_id = Auth::user()->id;
        try{
            if($req->isMethod('post')){
                $program = $req->all();  

                // check duplicate  code
                $chk = DagsProgram::where('program_name','=',$req['program_name'])
                ->where('id','<>',$req['id'])->first();
                if($chk){
                    return $res = [
                        'success' => 'false',
                        'msg' => 'Fail : Duplicate data : '
                        .'Program : '.$program->program_name.', '
                    ];
                }

                $program['created_by'] = $user_id;
                $program = DagsProgram::create($program);
                
                $res = [
                    'success' => 'success',
                    'row_count' => 1,
                    'items' => $program,
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

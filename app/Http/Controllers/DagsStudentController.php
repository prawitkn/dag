<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\DagsStudent;

class DagsStudentController extends Controller
{
    public function list_view()
    {	$program_student_headers = DagsProgramStudentHeader::where('status','=',1)->get();

    	return view('dag_school.students.index')->with(compact('program_student_headers'));
    }
public function list(Request $req, $program_student_header_id){
		$res = [];		

        if($program_student_header_id){
            $students = DB::table('dags_program_student_header as b')
            ->join('dags_programs as a','b.program_id','=','a.id')
            ->leftjoin('dags_program_students as c','c.program_student_id','=','b.id')
            ->leftjoin('dags_students as d','d.id','=','c.student_id')
            ->select('a.id as program_id','a.program_name'
                , 'b.program_student_name'
                , 'c.student_name', 'c.org_name'
            )
            ->where('b.program_student_id','=',$program_student_header_id)
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
                'msg' => $e->getMessage(),
            ];
            return $res; 
        }
	}

	public function edit_view(Request $req, $id)
    {

        $customer = DagsStudent::where('id','=',$id)->first();

        return view('dag_school.students.edit')->with(compact('customer'));
    }

    public function update(Request $req){
        $res = [];      
        try{
            if($req->isMethod('post')){                
                // check duplicate product_category code
               	$customer = DagsStudent::where('name','=',$req['name'])
                	->where('id','<>',$req['id'])->first();
                if($customer){
                	$res = [
		                'success' => 'false',
		                'msg' => 'ผิดพลาด : ข้อมูลซ้ำ รหัส '.$req['customer_name'].' มีในฐานข้อมูลแล้ว',
		            ];
        			return $res;
                }

                $customer = DagsStudent::find($req['id']);

                if(!$customer){
                    // Error 
                    $res = [
		                'success' => 'false',
		                'msg' => 'ไม่พบข้อมูล',
		            ];
        			return $res;
                }else{ 
                    // Update
                    $customer['name'] = $req['name'];
                    $customer['org_name'] = $req['org_name'];
                    $customer['status'] = ($req['status']?1:0);
                    $customer['updated_by'] = Auth::user()->id;
                    $customer->save(); 
                }
                
                $res = [
                    'success' => 'success',
                    'row_count' => 1,
                    'items' => $customer,
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

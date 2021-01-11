<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\DagsStudent;

class DagsStudentController extends Controller
{
    public function list_view()
    {	$students = DagsStudent::where('status','=',1)->get();

    	return view('dag_school.students.index')->with(compact('students'));
    }
public function list(Request $req){
		$res = [];		
        
        try{
            $students = DB::table('dags_students as a')
            ->select('a.*'
            )
            ->get();

            $res = [
                'success'=> 'success',
                'count'=> $students->count(),
                'items'=> $students,
                'msg'=> 'เรียบร้อย.',
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

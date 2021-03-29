<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use Auth;
use App\User;
use App\UserOssGroup;
use App\UserOss;


use App\UserOnlineStoreGroup;
use App\OsCustomer;

use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function dashboard(Request $request){
      Auth::user()->latest_app_name = 'admin';

      	$users = User::get();
  		return view('admins.dashboard')->with(compact('users'));
  	}



    public function UserListView()
    {
        return view('admins.users.index');
    }

	public function UserList()
    {
		$res = [];		
		// $materials = DB::table('users as a')->select('a.*'
		// 	, 'pd.product_code', 'mc.machine_code'
		// 	)
		// 	->leftjoin('pd_machines as mc','mc.id','=','a.machine_id')
		// 	->leftjoin('prolib_products as pd','pd.id','=','a.product_id')
		// 	->get();
		$users = User::get();
		$res = [
			'success'=> 'success',
			'count'=> $users->count(),
			'items'=> $users,
			'msg'=> 'Successfully.',
		];

		return $res;	
	}
	
	public function UserNewView()
    {
		return view('admins.users.new');
    }

	public function UserCreate(Request $req){
		$res = [];		
		$user_id = Auth::user()->id;
        try{
            if($req->isMethod('post')){
				$user = $req->all();
                $user['type']=2;
				$user['password'] = bcrypt($user['password']);  
				$user['created_by'] = $user_id;
				$user = User::create($user);
				
				$res = [
					'success' => 'success',
					'row_count' => 1,
					'items' => $user,
					'msg' => 'Successfully.',
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

    public function UserEditView(Request $req, $id)
    {
        // $user = User::find($id);

        // $user_pos = UserPos::where('user_id','=',$id)->first();

        $user = DB::table('users')->select('users.id', 'users.name', 'users.first_name', 'users.last_name', 'users.email' ,'users.status'
            , 'user_osses.id as pos_user_id','user_osses.status as oss_status'
            , 'user_osses.group_id as oss_group_id', 'c.group_name as oss_group_name'
            , 'user_osses.branch_id as pos_branch_id'

            , 'user_dag_schools.status as dag_school_status'
            , 'user_dag_schools.group_id as dag_school_group_id'
        )
        ->leftjoin('user_osses', function($join)
             {
                 $join->on('user_osses.user_id','=','users.id');
             })
        ->leftjoin('user_oss_groups as c','c.id','=','user_osses.group_id')

        ->leftjoin('user_dag_schools', function($join)
             {
                 $join->on('user_dag_schools.user_id','=','users.id');
             })

        ->where('users.status','=',1)
        ->where('users.id','=', $id)->first(); 


        // if(!$user){
        //     $users = User::get();
        //     Session::flash('flash_message_error', 'Data not found.'); 
        //     return view('admins.users2.index')->with(compact('users'));
        // }

        $oss_groups = DB::table('user_oss_groups')->where('status','=',1)->get();
        $dag_school_groups = DB::table('user_dag_school_groups')->where('status','=',1)->get();

        return view('admins.users.edit')->with(compact('user','oss_groups','dag_school_groups'));
    }

    public function UserUpdate(Request $req){
        $res = [];      
        $user_id = Auth::user()->id;
        try{
            if($req->isMethod('post')){
                $dt = $req->all();
                $user = User::find($dt['id']);

                $dt['name'] = $dt['first_name'].'  '.$dt['last_name'];


                $user = User::where('id','=',$dt['id'])->first();
                if($user){
                    // Update
                    $user['name'] = $dt['name'];
                    $user['first_name'] = $dt['first_name'];
                    $user['last_name'] = $dt['last_name'];
                    $user['status'] = ($dt['status']?1:0);
                    $user['updated_by'] = $user_id;
                    $user->save(); 
                }else{
                    // Create 

                }

                // OSS
                $user_oss = UserOss::where('user_id','=',$dt['id'])->first();
                if($user_oss){
                    // Update
                    if($req->has('is_user_oss')) { $user_oss['status'] = 1;
                        $user_oss['group_id'] = $req['pos_group_name'];
                    }else{ $user_oss['status'] = 0; }
                    
                    $user_oss['updated_by'] = $user_id;
                    $user_oss->save(); 
                }else{
                    // Create 
                    $user_oss['user_id'] = $req['id'];
                    $user_oss['status'] = ($dt['is_user_oss']?1:0);
                    $user_oss['group_id'] = $req['pos_group_name'];
                    $user_oss['branch_id'] = $req['pos_branch_name'];
                    $user_oss = UserOss::create($user_oss);
                }

                // OSS
                $user_dag_school = UserDagSchool::where('user_id','=',$dt['id'])->first();
                if($user_dag_school){
                    // Update
                    if($req->has('is_user_dag_school')) { $user_dag_school['status'] = 1;
                        $user_dag_school['group_id'] = $req['pos_group_name'];
                    }else{ $user_dag_school['status'] = 0; }
                    
                    $user_dag_school['updated_by'] = $user_id;
                    $user_dag_school->save(); 
                }else{
                    // Create 
                    $user_dag_school['user_id'] = $req['id'];
                    $user_dag_school['status'] = ($dt['is_user_dag_school']?1:0);
                    $user_dag_school['group_id'] = $req['pos_group_name'];
                    $user_dag_school['branch_id'] = $req['pos_branch_name'];
                    $user_dag_school = UserOss::create($user_dag_school);
                }
                
                $res = [
                    'success' => 'success',
                    'row_count' => 1,
                    'items' => $dt,
                    'msg' => 'Successfully.',
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

    public function resetPasswordAjax(Request $request){
        $user_id = Auth::user()->id;
        $data = [];
        try{
            $user = new User;
            if($request->isMethod('post')){
                $data = $request->all();
                //update fields.

                $user = User::find($data['id']);
                $user->password = bcrypt($data['password']);  
               
                $user->save(); 
                
            } // if post

            $data = [
                'success' => 'success',
                'row_count' => 1,
                'items' => $user,
                'msg' => 'Reset Password Successfully.',
            ];
            
        }catch(Exception $e){
            Log::warning(sprintf('Exception: %s', $e->getMessage()));

            $data = [
                'success' => 'false',
                'row_count' => 0,
                'items' => [],
                'msg' => $e->getMessage(),
            ];
        }         
        return $data;
    }
}

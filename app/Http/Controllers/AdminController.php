<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use Auth;
use App\User;
use App\UserPosGroup;
use App\UserPos;
use App\PosBranch;


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



    public function User2ListView()
    {
        return view('admins.users2.index');
    }

	public function User2List()
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
	
	public function User2NewView()
    {
		return view('admins.users2.new');
    }

	public function User2Create(Request $req){
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

    public function User2EditView(Request $req, $id)
    {
        // $user = User::find($id);

        // $user_pos = UserPos::where('user_id','=',$id)->first();

        $user = DB::table('users')->select('users.id', 'users.name', 'users.first_name', 'users.last_name', 'users.email' ,'users.status'
            , 'user_pos.id as pos_user_id','user_pos.status as pos_status'
            , 'user_pos.group_id as pos_group_id', 'c.group_name as pos_group_name'
            , 'user_pos.branch_id as pos_branch_id', 'd.branch_code as pos_branch_code'

            , 'user_online_stores.status as online_store_status'
            , 'user_online_stores.group_id as online_store_group_id'
            , 'user_online_stores.customer_id as online_store_customer_id'
        )
        ->leftjoin('user_pos', function($join)
             {
                 $join->on('user_pos.user_id','=','users.id');
             })
        ->leftjoin('user_pos_groups as c','c.id','=','user_pos.group_id')
        ->leftjoin('pos_branches as d','d.id','=','user_pos.branch_id')

        ->leftjoin('user_online_stores', function($join)
             {
                 $join->on('user_online_stores.user_id','=','users.id');
             })

        ->where('users.status','=',1)
        ->where('users.id','=', $id)->first(); 


        // if(!$user){
        //     $users = User::get();
        //     Session::flash('flash_message_error', 'Data not found.'); 
        //     return view('admins.users2.index')->with(compact('users'));
        // }

        $pos_groups = UserPosGroup::where('status','=',1)->get();
        $pos_branches = PosBranch::where('status','=',1)->get();

        $os_groups = UserOnlineStoreGroup::where('status','=',1)->get();
        $os_customers = OsCustomer::where('status','=',1)->get();

        return view('admins.users2.edit')->with(compact('user','pos_groups','pos_branches','os_groups','os_customers'));
    }

    public function User2Update(Request $req){
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
                    // $user = UserPos::create($user);
                }

                // POS
                $user_pos = UserPos::where('user_id','=',$dt['id'])->first();
                if($user_pos){
                    // Update
                    if($req->has('is_user_pos')) { $user_pos['status'] = 1;
                        $user_pos['group_id'] = $req['pos_group_name'];
                        $user_pos['branch_id'] = $req['pos_branch_name'];
                    }else{ $user_pos['status'] = 0; }
                    
                    $user_pos['updated_by'] = $user_id;
                    $user_pos->save(); 
                }else{
                    // Create 
                    $user_pos['user_id'] = $req['id'];
                    $user_pos['status'] = ($dt['is_user_pos']?1:0);
                    $user_pos['group_id'] = $req['pos_group_name'];
                    $user_pos['branch_id'] = $req['pos_branch_name'];
                    $user_pos = UserPos::create($user_pos);
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

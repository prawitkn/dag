<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;

class Response{
	public $success;
	public $message;

	public $users;
}
class UserController extends Controller
{
	public function __construct()
    {
		$this->middleware('auth');
		date_default_timezone_set("Asia/Bangkok");
    }

    public function changePassword(Request $request)
    {   
        if($request->isMethod('post')){
            $data = $request->all();

            $password = bcrypt($data['new_pwd']);

            //User::where('id',Auth::user()->id)->update(['password'=>$password, 'is_default_password'=>0]);
			User::where('id',Auth::user()->id)->update(['password'=>$password]);
			//route('logout');
            // $user = Auth::user;
            // Auth::login($user);
            Auth::logout();

            $flash_status='success';
            $flash_message='Change password successfuly.';
            return redirect('/')->with(compact('flash_status', 'flash_message'));
        }//endif post

        $action_name = 'Change Password';
        return view('/change_pw')->with(compact('action_name'));
    }

    public function getUser(Request $request, $user_id){
        $user = User::getUser($user_id);
        
        $data = [];
        $data = [
            'success' => 'success',
            'row_count' => 1,
            'items' => $user,
        ];
        return $data;

    }





    public function addUserAjax(Request $request){
        $user_id = Auth::user()->id;
        $data = [];
        try{
            $user = new User;
            if($request->isMethod('post')){
                $data = $request->all();
                //update fields.
                $user->first_name = trim($data['first_name']);
                $user->last_name = trim($data['last_name']);
                $user->name = trim(trim($data['first_name']).'  '.trim($data['last_name']));
                $user->email = trim($data['email']);
                $user->password = bcrypt($data['password']);
                if(isset($data['is_admin'])){
                	$user->type = 'admin';                	
                }else{
                	$user->type = 'user';     
                }
                if(isset($data['is_sales_dashboard'])){
                	$user->is_sales_dashboard = 1; 
                	$user->sales_dashboard_roll_name = $data['sales_dashboard_roll_name'];
                		$user->salesman_id = $data['salesman_id'];
                }
                if(isset($data['is_product_library'])){                	
                	$user->is_product_library = 1;
                	$user->product_library_roll_name = $data['product_library_roll_name'];
                }

                $user->created_by = $user_id;
                $user->status = 1;   
      
                //Check duplicate product code.
                $checkDuplicate = User::where(['email' => $user->email])->get()->count();
                if ( $checkDuplicate > 0 ){
                    $data = [
                        'success' => 'false',
                        'row_count' => 0,
                        'items' => [],
                        'msg' => 'Duplicate Email => '.$user->email,
                    ];
                    return $data;
                }

                $user->save(); 
                
            } // if post

            $data = [
                'success' => 'success',
                'row_count' => 1,
                'items' => $user,
                'msg' => 'Add User Successfully.',
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





    public function editUserAjax(Request $request){
        $user_id = Auth::user()->id;
        $data = [];
        try{
            $user = new User;
            if($request->isMethod('post')){
                $data = $request->all();
                //update fields.
                $user = User::find($data['id']);
                $user->first_name = trim($data['first_name']);
                $user->last_name = trim($data['last_name']);
                $user->name = trim(trim($data['first_name']).'  '.trim($data['last_name']));
                $user->email = trim($data['email']);
                // $user->password = bcrypt($data['password']);
                if(isset($data['is_admin'])){
                    $user->type = 'admin';                  
                }else{
                    $user->type = 'user';     
                }
                if(isset($data['is_sales_dashboard'])){
                    $user->is_sales_dashboard = 1; 
                    $user->sales_dashboard_roll_name = $data['sales_dashboard_roll_name'];
                    $user->salesman_id = $data['salesman_id'];
                }
                if(isset($data['is_product_library'])){                 
                    $user->is_product_library = 1;
                    $user->product_library_roll_name = $data['product_library_roll_name'];
                }

                $user->status = $data['status'];   
                $user->updated_by = $user_id;
      
                //Check duplicate product code.
                $checkDuplicate = User::where(['email' => $user->email])->where('id','!=',$user->id)->get()->count();
                if ( $checkDuplicate > 0 ){
                    $data = [
                        'success' => 'false',
                        'row_count' => 0,
                        'items' => [],
                        'msg' => 'Duplicate Email => '.$user->email,
                    ];
                    return $data;
                }

                $user->save(); 
                
            } // if post

            $data = [
                'success' => 'success',
                'row_count' => 1,
                'items' => $user,
                'msg' => 'Update User Successfully.',
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

    public function JSONUser(Request $request)
    {      
      // $query_string = "Select AkLibrary.Customers.customer_id, AkLibrary.Customers.`group`, AkLibrary.Customers.note, first_name, id, AkLibrary.Customers.customer_name, market_name, AkLibrary.Customers.last_visited, AkLibrary.Customers.`status`, total, jan_total, feb_total, march_total, april_total, may_total, june_total, july_total, aug_total, sept_total, oct_total, nov_total, dec_total from AkLibrary.Customers left join AkLibrary.users on Customers.sales = users.id,AkLibrary.Customers as meow left join (select customer_id, sum(profit) as total from  AkLibrary.Transactions where `month` =" . $now->month . " and `year` =" . $now->year . " group by customer_id)temp on temp.customer_id = meow.customer_id,AkLibrary.Customers as meow2 left join Quotas on Quotas.customer_id = meow2.customer_id, AkLibrary.Customers as temp3 left join Market on `group` = market_id  where meow.customer_id = AkLibrary.Customers.customer_id and meow2.customer_id = AkLibrary.Customers.customer_id and AkLibrary.Customers.customer_id = temp3.customer_id and AkLibrary.Customers.is_active = 1 order by " . $order . ' desc';
      // $customers = DB::select($query_string);
      $users = User::get();
      $data = new Response;
       $data->users = $users;
      // $data = $users;
      return response()->json($data);
    }
	



    // API Methods //
	public function index(){
		return User::all();
	}

	public function show($id){
		// return User::where('id' => $id);
        $data = User::find($id);
        return $data;
	}

	// public function store(Request $req){
	// 	return User::create($req->all());
	// }

	public function update(Request $req, $id){
        $tmp = $req;
        $tmp['name'] = trim($tmp['first_name'].' '.$tmp['last_name']);
        $req = $tmp;
		$user = User::findOrFail($id);
		$user->update($req->all());

		return $user;
	}

	public function delete(Request $req, $id){
		$user = User::findOrFail($id);
		$user->delete();

		return 204;
	}
}

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use DB;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'created_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
	];
	
    public function isAdmin(){
        $roles = DB::table('users as a')->select('a.*'
        )
        ->where('a.status','=',1)
        ->where('a.type','=','admin')
        ->where('a.id','=', Auth::user()->id)->get();

        foreach ($roles as $role)
        {
            if ($role->type == 'admin')
            {
                return true;
            }
        }
        // return false;
    }

    public function isOnlineStoreSalesAdmin(){
        $roles = DB::table('user_online_stores as a')->select('a.*'
        )
        ->where('a.status','=',1)
        ->where('a.user_id','=', Auth::user()->id)
        ->where('a.group_id','=',3)->get();

        foreach ($roles as $role)
        {
            if ($role->group_id == 3)   // Sales Admin
            {
                return true;
            }
        }
    }

    public function isOnlineStoreCustomer(){
        $roles = DB::table('user_online_stores as a')->select('a.*'
        )
        ->where('a.status','=',1)
        ->where('a.user_id','=', Auth::user()->id)
        ->where('a.group_id','=',4)->get();

        foreach ($roles as $role)
        {
            if ($role->group_id == 4)   // Sales Admin
            {
                return true;
            }
        }
    }




	public function isSalesDashboard(){
        return $this->is_sales_dashboard == 1;
    }

    public function isPos(){
        $roll = DB::table('user_pos as a')->select('a.*'
        )
        ->where('a.status','=',1)
        ->where('a.user_id','=', Auth::user()->id)->first();

        if($roll){
            return true;
        }else{
            return false;
        }
    }

    public function isOnlineStore(){
        $roll = DB::table('user_online_stores as a')->select('a.*'
        )
        ->where('a.status','=',1)
        ->where('a.user_id','=', Auth::user()->id)->first();

        if($roll){
            return true;
        }else{
            return false;
        }
    }

    public function isOnlineStoreAdmin(){
        $roll = DB::table('user_online_stores as a')->select('a.*'
        )
        ->where('a.status','=',1)
        ->where('a.user_id','=', Auth::user()->id)
        ->where('a.group_id','=',1)->first();

        if($roll){
            return true;
        }else{
            return false;
        }
    }

    public function getPosRoll(){
        $rolls = DB::table('user_pos_groups as a')->select('a.*'
        ,'b.id as pos_user_id'
        )
        ->leftjoin('user_pos as b','b.group_id','=','a.id')
        ->where('a.status','=',1)
        ->where('b.user_id','=', Auth::user()->id)->get();

        return $rolls;
    }
}

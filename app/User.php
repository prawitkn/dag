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






    public function isOneStopService(){
        $role = DB::table('user_osses as a')->select('a.*'
        )
        ->where('a.status','=',1)
        ->where('a.user_id','=', Auth::user()->id)
        ->first();

        if($role){ return true; }else{ return false; }
    }










    public function isDagSchool(){
        $role = DB::table('user_dag_schools as a')->select('a.*'
        )
        ->where('a.status','=',1)
        ->where('a.user_id','=', Auth::user()->id)
        ->first();

        if($role){ return true; }else{ return false; }
    }


































}

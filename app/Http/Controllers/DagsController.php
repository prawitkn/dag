<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;

class DagsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Session::put('app_name','dag_school');
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   

        $program_classes = DB::table('dags_program_classes as a')->select('a.*'
            )
            ->get();

        return view('dag_school.home')->with(compact('program_classes'));
    }

    public function program_class(Request $req, $id)
    {   
        date_default_timezone_set('Asia/Bangkok');
        $mytime = date('Y-m-d H:i:s');
        // return view('online_store.index')->with(compact('mytime'));

        $program_class = DB::table('dags_program_classes as a')->select('a.*'
            )->where('id','=',$id)
            ->first();

        return view('dag_school.program_class')->with(compact('program_class'));
    }
}

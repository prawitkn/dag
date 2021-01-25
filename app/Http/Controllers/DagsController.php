<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class DagsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
}

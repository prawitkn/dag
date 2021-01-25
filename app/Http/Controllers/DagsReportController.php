<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Auth;

use DB;
use Session;
use PDF;

class DagsReportController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function class_view()
    {	
    	date_default_timezone_set('Asia/Bangkok');
    	$mytime = date('Y-m-d H:i:s');
        // return view('online_store.index')->with(compact('mytime'));

        $program_classes = DB::table('dags_program_classes as a')->select('a.*'
            )
            ->get();


        return view('dag_school.reports.class-summary')->with(compact('program_classes'));
    }
    
    public function getStudentSummaryList(Request $req){
        $res = [];     

        // if($req->has('program_class_id')){
        //     Session::put('program_class_id', $req['program_class_id']);
        // }
        $header = DB::table('dags_program_classes as a')
        ->where('a.id','=',$req['program_class_id'])->first();

        $result = DB::table('dags_program_classes as a')
        ->join('dags_program_class_students as b','b.program_class_id','=','a.id')
        ->join('dags_students as c','c.id','=','b.student_id')
        ->select('a.id','a.program_id','a.program_class_name','a.program_class_qty'
            ,'a.course_hours','a.course_days' 
            ,'b.id as class_student_id'
            ,'b.sick_leave','b.personal_leave','b.hourly_leave' 
            ,'b.score', 'b.net_score'
            ,'c.id as student_id', 'c.student_name','c.org_name','c.photo'
        )
        ->where('a.id','=', $req['program_class_id'])
        ->orderBy('b.score','DESC')
        ->orderBy('b.net_score','DESC')
        ->get();
        $res = [
            'success'=> 'success',
            'count'=> $result->count(),
            'header'=> $header,
            'items'=> $result,
            'msg'=> 'Successfully.',
        ];

        return $res;        
    }

    public function getStudentDetailList(Request $req){
        $res = [];     

        if($req->has('program_class_id')){
            Session::put('program_class_id', $req['program_class_id']);
        }
        $header = DB::table('dags_program_classes as a')
        ->where('a.id','=',Session::get('program_class_id'))->first();

        $result = DB::table('dags_program_classes as a')
        ->join('dags_program_class_students as b','b.program_class_id','=','a.id')
        ->join('dags_students as c','c.id','=','b.student_id')
        ->join('dags_students as c','c.id','=','b.student_id')
        ->select('a.id','a.program_id','a.program_class_name','a.program_class_qty' 
            ,'b.student_id'
            ,'c.student_name','c.org_name','c.photo'
        )
        ->where('a.id','=',Session::get('program_class_id'))
        ->orderBy('b.net_score','DESC')
        ->get();

        $res = [
            'success'=> 'success',
            'count'=> $result->count(),
            'header'=> $header,
            'items'=> $result,
            'msg'=> 'Successfully.',
        ];

        return $res;        
    }

    public function getCourseList(Request $req){
        $res = [];     

        // DB::beginTransaction();
        try{
            $result = DB::table('dags_program_classes as a')
            ->join('dags_program_courses as b', function( $join ) use ($req){
                $join->on('b.program_id','=','a.program_id');
                $join->where('b.is_calc','=',1);
            })
            ->where('a.id','=',$req['program_class_id'])
            ->select('a.id','a.program_class_name'
                ,'b.id as program_course_id', 'b.course_name as program_course_name', 'b.score as course_scoure' )->get();

            // DB::commit();

            $res = [
                'success'=> 'success',
                'count'=> $result->count(),
                'items'=> $result,
                'msg'=> 'Success',
            ];
            return $res;
        }catch(Exception $e){
            Log::warning(sprintf('Exception: %s', $e->getMessage()));
            // DB::rollback();

            $data = [
                'success' => 'false',
                'msg' => $e->getMessage(),
                'row_count' => 0,
                'items' => [],
            ];
        } // try...catch
    }


    public function getCalculateCourseWithClassStudentList(Request $req){
        $res = [];     

        DB::beginTransaction();
        try{
            DB::statement(DB::raw( "CREATE TEMPORARY TABLE temp_couse_test_student(
                course_id int,
                class_student_id int,
                sum_score decimal(7,2),
                count_test decimal(7,2),
                avg_score decimal(7,2)
             )"));

            $select = DB::table('dags_program_classes as a')
            ->join('dags_program_courses as b', function( $join ) use ($req){
                $join->on('b.program_id','=','a.program_id');
                $join->where('b.is_calc','=',1);
            })
            ->crossjoin('dags_program_class_students as pcs','pcs.program_class_id','=','a.id')
            ->where('a.id','=',$req['program_class_id'])
            ->select('b.id as course_id', 'pcs.id as class_student_id');

            $bindings = $select->getBindings();
                
            $insertQuery = 'INSERT into temp_couse_test_student (course_id, class_student_id) '.$select->toSql();

            DB::insert($insertQuery, $bindings);

            DB::statement(DB::raw( "UPDATE temp_couse_test_student as a 
            set a.sum_score = ( SELECT SUM(y.score) FROM dags_program_course_tests as x 
                            INNER JOIN dags_program_class_test_students as y ON y.program_course_test_id = x.id  
                            WHERE x.program_course_id = a.course_id 
                            AND y.class_student_id = a.class_student_id 
                            ) 
            , a.count_test = ( SELECT SUM(x.id) FROM dags_program_course_tests as x 
                            INNER JOIN dags_program_class_test_students as y ON y.program_course_test_id = x.id  
                            WHERE x.program_course_id = a.course_id 
                            AND y.class_student_id = a.class_student_id 
                            ) 
             "));

            DB::statement(DB::raw( "UPDATE temp_couse_test_student as a 
            set a.avg_score = a.sum_score / a.count_test 
             "));

            $result = DB::table('temp_couse_test_student')->select()->get();

            DB::commit();

            $res = [
                'success'=> 'success',
                'count'=> $result->count(),
                'items'=> $result,
                'msg'=> 'Success',
            ];
            return $res;
        }catch(Exception $e){
            Log::warning(sprintf('Exception: %s', $e->getMessage()));
            DB::rollback();

            $data = [
                'success' => 'false',
                'msg' => $e->getMessage(),
                'row_count' => 0,
                'items' => [],
            ];
        } // try...catch
    }

    public function studentSummaryPdf(Request $req){
        $res = $this->getStudentSummaryList($req);
        $header = $res['header'];

        PDF::SetMargins(20, 20, 10);
        PDF::SetHeaderMargin(PDF_MARGIN_HEADER);
        PDF::SetFooterMargin(PDF_MARGIN_FOOTER);        
        // set auto page breaks
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set default font subsetting mode
        PDF::setFontSubsetting(true);

        PDF::SetTitle($header->program_class_name);
        // EAN 13
        $html = '';
                
        // PDF::SetFont('THSarabun', '', 12, '', true);

        
        $row_no = 1; $rowPerPage=0; 
        foreach($res['items'] as $key => $item){
            if($rowPerPage==0){
                PDF::AddPage('P', 'A4');
                PDF::SetFont('THSarabun', '', 14, '', true);
                PDF::Cell(0, 5, PDF::getAliasNumPage().'/'.PDF::getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');                
                PDF::Ln(7);

                $html ='
                <table class="table table-striped no-margin" > 
                     <thead>                           
                    <tr>
                        <th colspan="4">
                            '.$header->program_class_name.' 
                        </th>
                    </tr>
                      <tr>
                            <th style="font-weight: bold; text-align: center; width: 30px;" border="1">ลำดับ</th><th style="font-weight: bold; text-align: center; width: 50px;" border="1">ภาพ</th>
                            <th style="font-weight: bold; text-align: center; width: 340px;" border="1">ยศ ชื่อ นามสกุล</th>
                            <th style="font-weight: bold; text-align: center; width: 100px;" border="1">หน่วย</th>
                            <th style="font-weight: bold; text-align: center; width: 50px;" border="1">ร้อยละ</th>
                        </tr>
                      </thead>
                      <tbody>
                '; 
            } // end $rowPerPage

            $file = url('storage/app/dag_school/photos/students').'/'.$item->student_id.'.jpg';
            $tmp = '<div style="background-image: url('.$file.')" class="media-object avatar avatar-md mr-3"></div>';

            $html .='<tr>
                <td style="border: 0.1em solid black; text-align: center; width: 30px;">'.$row_no.'</td>
                <td style="border: 0.1em solid black; text-align: center; width: 50px; padding-top:10px;">
                    <img src="'.$file.'" style="width: 30px; " />
                </td>
                <td style="border: 0.1em solid black; padding: 10px; width: 340px;"> '.$item->student_name.'</td>
                <td style="border: 0.1em solid black; text-align: center; width: 100px;">'.$item->org_name.'</td>
                <td style="border: 0.1em solid black; text-align: right; width: 50px;">'.number_format($item->net_score*100,2,'.',',').'&nbsp;&nbsp;</td>
            </tr>';     
                         
            $row_no +=1; $rowPerPage+=1;    
            if($rowPerPage==15){
                $html .='</tbody></table>'; 
                PDF::writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
                $html =''; $rowPerPage=0;
            }
        }   // end foreach

        if($html!=""){
            $html .='</tbody></table>'; 
            PDF::writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }        

        // Footer
        // PDF::SetFont('THSarabun', '', 14, '', true);
        // Page number
        $tmp = date('Y-m-d H:i:s');
        //$tmp = to_thai_short_date_fdt($tmp);
        PDF::Cell(0, 10,'Print : '. $tmp, 0, false, 'R', 0, '', 0, false, 'T', 'M');
        //  Footer

        PDF::Output('PDF-Report.pdf','I');

    }

    public function getStudentCourseScoreList(Request $req){
        $res = [];     

        if($req->has('program_class_id')){
            Session::put('program_class_id', $req['program_class_id']);
        }

        $result = DB::table('dags_program_classes as a')
        ->join('dags_program_class_students as b','b.program_class_id','=','a.id')
        ->join('dags_program_courses as c', function( $join ) use ($req){
                $join->on('c.program_id','=','a.program_id');
                $join->where('c.is_calc','=',1);
            })
        ->select('a.id','a.program_id','a.program_class_name','a.program_class_qty' 
            , 'b.student_id' 
            ,'c.id as course_id', 'c.course_no','c.course_name','c.score as course_scoure'
        )
        ->where('a.id','=',Session::get('program_class_id'))
        // ->where(DB::RAW("c.course_hierarchy <> '000000'"))
        // ->orderByRaw('b.student_id ASC, c.course_hierarchy ASC')
        ->get();

        $res = [
            'success'=> 'success',
            'count'=> $result->count(),
            'items'=> $result,
            'msg'=> 'Successfully.',
        ];

        return $res;        
    }

    public function studentCertificatePdf(Request $req){
        if( !$req->has('program_class_id') || $req['program_class_id'] == "" ){

        }else{
            $res = $this->getStudentSummaryList($req);
            $header = $res['header'];
            $class_students = $res['items'];
            $courses = $this->getCourseList($req);
            $course_test_students = $this->getCalculateCourseWithClassStudentList($req);
      
            PDF::SetMargins(20, 20, 10);
            PDF::SetHeaderMargin(PDF_MARGIN_HEADER);
            PDF::SetFooterMargin(PDF_MARGIN_FOOTER);        
            // set auto page breaks
            PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            // set image scale factor
            PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
            // set default font subsetting mode
            PDF::setFontSubsetting(true);

            PDF::SetFont('THSarabun', '', 14, '', true);
            //
            PDF::Cell(0, 5, PDF::getAliasNumPage().'/'.PDF::getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');

            PDF::Ln();

            PDF::SetTitle($header->program_class_name);
            $html='';
            $row_no = 1; $rowPerPage=0; 
                // dd($students); exit();
            foreach($class_students as $key => $class_student){
                $file = url('storage/app/dag_school/photos/students').'/'.$class_student->id.'.jpg';
                $tmp = '<div style="background-image: url('.$file.')" class="media-object avatar avatar-md mr-3"></div>';
                if($rowPerPage==0){
                    PDF::AddPage('P', 'A4');
                    PDF::SetFont('THSarabun', '', 14, '', true);
                    // PDF::Cell(0, 5, PDF::getAliasNumPage().'/'.PDF::getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');                
                    PDF::Ln();
                    $x=$y=0;

                //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
                #writeHTMLCell(w, h, x, y, html = '', border = 0, ln = 0, fill = 0, reseth = true, align = '', autopadding = true)

                //Cell( $w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' )

                $isBorder = 0; // 1 for coding alingment, 0 for Production
                
                $x=10;
                $yHeight=8;
                $y+=10;
                PDF::writeHTMLCell(190, $yHeight, $x, $y, '<h3 style="text-align: center;">'.'แบบรายงานผลการฝึกอบรมเฉพาะบุคคล'.'</h3>', $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' );
                $y+=$yHeight;   // new line

                $x=20;              
                PDF::writeHTMLCell(200, $yHeight, $x, $y, '<b style="text-align: left;">การฝึกอบรม </b>'.$header->program_class_name, $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' ); 
                $y+=$yHeight;   // new line

                $x=20;              
                PDF::writeHTMLCell(120, $yHeight, $x, $y, '<b style="text-align: left;">ยศ-ชื่อ-สกุล </b>'.$class_student->student_name, $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' ); 
                $x+=120; 

                PDF::writeHTMLCell(60, $yHeight, $x, $y, '<b style="text-align: left;">สังกัด </b>'.$class_student->org_name, $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' ); 
                } // rowPerPage
                $y+=$yHeight;   // new line


                
                $x=20;              
                PDF::writeHTMLCell(200, $yHeight, $x, $y, '<b style="text-align: left;"><span style="text-decoration-line: underline;">ตอนที่ 1</span> : เวลาเข้ารับการอบรม คิดเป็นร้อยละ 100</b>', $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' ); 
                PDF::Ln();
                if($rowPerPage==0){
                     $html ='
                    <table class="table table-striped no-margin" border="1" style="padding: 1px;" >
                         <thead>   
                            <tr>
                            <th style="font-weight: bold; text-align: center; width: 180px;" >เวลาการอบรมรวม</th>
                            <th style="font-weight: bold; text-align: center; width: 140px;" >ลาป่วย</th>
                            <th style="font-weight: bold; text-align: center; width: 140px;" >ลากิจ</th>
                            <th style="font-weight: bold; text-align: center; width: 140px;" >ลาประจำชั่วโมง</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th style="text-align: center; width: 180px;" >จำนวน&nbsp;&nbsp;'.$header->course_days.'&nbsp;วัน('.$header->course_hours.'&nbsp;ชั่วโมง)</th>
                            <th style="text-align: center; width: 140px;" >จำนวน&nbsp;&nbsp;'.$class_student->sick_leave.'&nbsp;วัน</th>
                            <th style="text-align: center; width: 140px;" >จำนวน&nbsp;&nbsp;'.$class_student->personal_leave.'&nbsp;วัน</th>
                            <th style="text-align: center; width: 140px;" >จำนวน&nbsp;&nbsp;'.$class_student->hourly_leave.'&nbsp;ชั่วโมง</th>
                            </tr>
                        </tbody>
                    </table>
                    '; 
            //           ,'a.course_hours','a.course_days' 
            // ,'b.id as class_student_id'
            // ,'b.sick_leave','b.personal_leave','b.hourly_leave' 

                    PDF::writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
                } // rowPerPage
                // dd($courses['items']); exit();
                $y+=$yHeight;   // new line
                $y+=$yHeight;   // new line
                $y+=$yHeight;   // new line
                PDF::Ln();

                $x=20;              
                PDF::writeHTMLCell(200, $yHeight, $x, $y, '<b style="text-align: left;"><span style="text-decoration-line: underline;">ตอนที่ 2</span> : การปะรเมินความรู้รายวิชา</b>', $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' );                 
                $y+=$yHeight;   // new line
                PDF::Ln();
                if($rowPerPage==0){
                     $html ='
                    <table class="table table-striped no-margin" border="1" style="padding: 1px;" >
                         <thead>   
                          <tr>
                            <th style="font-weight: bold; text-align: center; width: 400px;" >วิชา/กิจกรรม</th>
                            <th style="font-weight: bold; text-align: center; width: 100px;" >ลำดับ</th>
                            <th style="font-weight: bold; text-align: center; width: 100px;" >คะแนน</th>
                            </tr>
                        </thead>
                        <tbody>
                    '; 
                } // rowPerPage

                foreach($courses['items'] as $key => $course){
                    $html .= '<tr>
                        <td style="text-align: left; width: 400px;" >&nbsp;'.$course->program_course_name.'</td>
                        <td style="text-align: right; width: 100px;" >'.$course->course_scoure.'</td>';
                        $tmpScore = '0';
                        foreach($course_test_students['items'] as $k => $v){
                            if( $v->class_student_id == $class_student->class_student_id && $v->course_id == $course->program_course_id ){
                                $tmpScore = $v->sum_score;        
                                 break;
                            }
                        }
                        $html .= '<td style="text-align: right; width: 100px;" >'.$tmpScore.'</td>
                    </tr>';
                    $y+=$yHeight;
                } // end foreach courses

                $rowPerPage+=1;    
                if($rowPerPage==1){
                    $html .='</tbody></table>'; 
                    PDF::writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
                    $html =''; $rowPerPage=0;
                }

                $y-=$yHeight;
                $x=20;              
                PDF::writeHTMLCell(200, $yHeight, $x, $y, '<b style="text-align: left;">คะแนนเฉลี่ยสะสม  </b>', $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' ); 
                $y+=$yHeight;

                $x=20;              
                PDF::writeHTMLCell(200, $yHeight, $x, $y, '<b style="text-align: left;"><span style="text-decoration-line: underline;">ตอนที่ 3</span> : ความเห็นผู้บังคับบัญชา  </b>', $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' );
                $y+=$yHeight;

                $x=20;              // 230
                // PDF::writeHTMLCell(180, $yHeight, $x, $y, '........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................', $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' ); 
                PDF::writeHTMLCell(180, $yHeight, $x, $y, '............................................................................................................................................................................................................................................................................................................................................................................................................................................................', $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' ); 
                $y+=$yHeight;
                $y+=$yHeight;

        

                PDF::writeHTMLCell(180, $yHeight, $x, $y, 'dafdafd สุรวัฒน์', $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' ); 
                $style = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 1, 'color' => array(0, 0, 0));
                PDF::Line($x, ($y+$yHeight+1), 200, ($y+$yHeight+1), $style);

                $x=20;              
                PDF::writeHTMLCell(200, $yHeight, $x, $y, '<b style="text-align: left;"><span style="text-decoration-line: underline;">ตอนที่ 4</span> : ผลการฝึกอบรม</b>', $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' );






                $isBorder=0;
                // Sign $x = 180
                $x=20; 
                $y+=$yHeight;
                PDF::writeHTMLCell(30, $yHeight, $x, $y, $header->confirm_title, $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'C', $valign = 'M' );          
                $x+=30;$x+=60;
                PDF::writeHTMLCell(30, $yHeight, $x, $y,  $header->approve_title, $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' );

                $x=20; 
                $y+=$yHeight;$y+=($yHeight/2);
                PDF::writeHTMLCell(90, $yHeight, $x, $y, '('.$header->confirm_full_name.')', $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' );
                $x+=90;
                PDF::writeHTMLCell(90, $yHeight, $x, $y, '('.$header->approve_full_name.')', $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' );

                $x=20; 
                $y+=$yHeight;
                PDF::writeHTMLCell(90, $yHeight, $x, $y,  $header->confirm_position_abb, $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' );
                $x+=90;
                PDF::writeHTMLCell(90, $yHeight, $x, $y,  $header->approve_position_abb, $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' );

            }   // end foreach 
            

            // if($html!=""){
            //     $html .='</tbody></table>'; 
            //     PDF::writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            // }        

            // Footer
            // PDF::SetFont('THSarabun', '', 14, '', true);
            // Page number
            $tmp = date('Y-m-d H:i:s');
            //$tmp = to_thai_short_date_fdt($tmp);
            // PDF::Cell(0, 10,'Print : '. $tmp, 0, false, 'R', 0, '', 0, false, 'T', 'M');
            //  Footer

            PDF::Output('PDF-Report.pdf','I');

        }
        
    }
}

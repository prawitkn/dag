<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

use Auth;
use DB;
use App\OssServiceData;
use App\OssServiceTopic;
use App\OssServiceType;
use App\OssCustomerType;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PDF;

class OssServiceDataController extends Controller
{
    public function index()
    {	
    	$service_types = OssServiceType::where('status','=',1)->get();
    	$service_topics = OssServiceTopic::where('status','=',1)->get();
    	$customer_types = OssCustomerType::where('status','=',1)->get();

    	return view('oss.service-data.new')->with(compact('service_types','service_topics','customer_types'));
    }    
    public function list_view()
    {	
    	return view('oss.service-data.index');
    }
    public function list(){
		// $res = [];		
		// $programs = DB::table('dags_programs as a')->select('a.*'
		// 	)
		// 	->get();

		// $res = [
		// 	'success'=> 'success',
		// 	'count'=> $programs->count(),
		// 	'items'=> $programs,
		// 	'msg'=> 'เรียบร้อย.',
		// ];

		// return $res;		
	}
    public function new()
    {	
    	$service_types = OssServiceType::where('status','=',1)->get();
    	$service_topics = OssServiceTopic::where('status','=',1)->get();
    	$customer_types = OssCustomerType::where('status','=',1)->get();

    	return view('oss.service-data.new')->with(compact('service_types','service_topics','customer_types'));
    }

    public function create(Request $req){
		$res = [];
		
		$tmp = $req->all();
		try{
			$issue_date = str_replace('/', '-', $req['issue_date']);
			$issue_date = date('Y-m-d', strtotime($issue_date));
			
			$service_data = new OssServiceData;
			$service_data->issue_date = $issue_date;
			$service_data->customer_type_id = $req['customer_type_id'];
			$service_data->service_type_id = $req['service_type_id'];
			$service_data->service_topic_id =  $req['service_topic_id'];
			$service_data->remark =  $req['remark'];
			$service_data->created_by = Auth::user()->id;

			$service_data->save();		

			$res = [
				'success'=> 'success',
				'msg'=> 'สำเร็จ',
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
			return $res;
        }         
		
	}


    public function list_by_service_type(Request $req){
    	$res = [];     
    	if($req->has('service_type_id')){
    		$service_topics = OssServiceTopic::where('service_type_id','=',$req['service_type_id'])->where('status','=',1)->get();

	    	return $res = [
	            'success' => 'success',
	            'row_count' => $service_topics->count(),
	            'items' => $service_topics,
	            'msg' => '',
	        ];
    	}else{
    		return $res = [
			            'success' => 'success',
			            'row_count' => 0,
			            'items' => [],
			            'msg' => 'Not found.',
			        ];
    	}
    }


    public function view_report()
    {	
    	// $service_types = OssServiceType::where('status','=',1)->get();
    	// $service_topics = OssServiceTopic::where('status','=',1)->get();

    	return view('oss.service-data.report'); //->with(compact('service_types','service_topics'));
    }

    public function report_summary(Request $req){
		$res = [];
		
		$tmp = $req->all();
		try{
			$issue_date_from = str_replace('/', '-', $req['issue_date_from']);
			$issue_date_from = date('Y-m-d', strtotime($issue_date_from));
			$issue_date_to = str_replace('/', '-', $req['issue_date_to']);
			$issue_date_to = date('Y-m-d', strtotime($issue_date_to));
			
			// $service_data->save();		
			$result = DB::table('oss_service_data as a')
			->leftjoin('oss_service_types as b','b.id','=','a.service_type_id')
			->leftjoin('oss_service_topics as c','c.id','=','a.service_topic_id')
			->select('a.service_type_id','a.service_topic_id','a.remark'
				,'b.service_type_name','c.service_topic_name'
				,DB::raw('count(a.id) as service_count'))
			->where('a.status','=',1)
			->whereBetween('a.issue_date', [$issue_date_from, $issue_date_to])
			->groupBy('a.service_type_id','a.service_topic_id','a.remark'
				,'b.service_type_name','c.service_topic_name')
			->get();	

			$res = [
				'success'=> 'success',
                'row_count' => $result->count(),
                'items' => $result,
				'msg'=> 'สำเร็จ',
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
			return $res;
        }         
		
	}

	public function toThaiNumber($number){
		if($number==0){
			return "-";
		}else{
			$numthai = array("๑","๒","๓","๔","๕","๖","๗","๘","๙","๐");
			 $numarabic = array("1","2","3","4","5","6","7","8","9","0");
			 $str = str_replace($numarabic, $numthai, $number);
			 return $str;
		}	 
	}
	public function report_summary_pdf(Request $req){
		// $from_location = PdLocation::find($hdr->from_location_id)->first();
		// $to_location = PdLocation::find($hdr->to_location_id)->first();
		$issue_date_from = str_replace('/', '-', $req['issue_date_from']);
		$issue_date_from = date('Y-m-d', strtotime($issue_date_from));
		$issue_date_to = str_replace('/', '-', $req['issue_date_to']);
		$issue_date_to = date('Y-m-d', strtotime($issue_date_to));
		
		$date_str="";
		if( $issue_date_from != $issue_date_to ){
			$date_str = $issue_date_from." ถึง ".$issue_date_to;
		}else{
			$date_str = $issue_date_from;
		}
		// $service_data->save();		

		$service_types = OssServiceType::where('status','=',1)->get();

		$service_data = DB::table('oss_service_types as a')
		->join('oss_service_topics as b', function($join)
             {
                 $join->on('b.service_type_id','=','a.id');
             })
		->select('a.id', 'b.service_topic_name'
			, DB::RAW("(SELECT COUNT(x.id) FROM oss_service_data as x 
				WHERE x.status=1 
				AND x.issue_date BETWEEN '".$issue_date_from."' AND '".$issue_date_to."'
				AND x.service_topic_id=b.id
				AND x.customer_type_id=1
				) as count_1")
			, DB::RAW("(SELECT COUNT(x.id) FROM oss_service_data as x 
				WHERE x.status=1 
				AND x.issue_date BETWEEN '".$issue_date_from."' AND '".$issue_date_to."'
				AND x.service_topic_id=b.id
				AND x.customer_type_id=2) as count_2")
			, DB::RAW("(SELECT COUNT(x.id) FROM oss_service_data as x 
				WHERE x.status=1 
				AND x.issue_date BETWEEN '".$issue_date_from."' AND '".$issue_date_to."'
				AND x.service_topic_id=b.id
				AND x.customer_type_id=3) as count_3")
		)
		->where('a.status','=',1)
		->where('a.id','<>',3)
		// ->groupBy('a.service_type_id','a.service_topic_id','a.remark'
		// 	,'b.service_type_name','c.service_topic_name')
		->get();	

		$complains = DB::table('oss_service_types as a')
		->join('oss_service_data as b', function($join) use ($issue_date_from, $issue_date_to)
             {
                 $join->on('b.service_type_id','=','a.id');
                 $join->whereBetween('b.issue_date', [$issue_date_from, $issue_date_to]);
             })
		->select('a.id'
			,'b.service_type_id','b.customer_type_id', 'b.remark'
		)
		->where('a.status','=',1)
		->where('a.id','=',3)
		// ->groupBy('a.service_type_id','a.service_topic_id','a.remark'
		// 	,'b.service_type_name','c.service_topic_name')
		->get();	
			
		$size = 'A4'; // array(200,  100);
		$pdf = new PDF('P', 'mm', $size, true, 'UTF-8', false);
   		// $pdf->addTTFfont('/public/fonts/thsarabunnew/thsarabunnew-webfont.ttf', 'TrueTypeUnicode', '', 96);
		// add font
		// $pdf->addFont('');
		// set default font subsetting mode
		$pdf::setFontSubsetting(true);


		// PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		$pdf::setMargins(15, 10, 10);	
		$pdf::SetPrintHeader(false);
		$pdf::SetPrintFooter(false);

		// set auto page breaks
		//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf::SetAutoPageBreak(TRUE, 0);

		// set image scale factor
		$pdf::setImageScale(PDF_IMAGE_SCALE_RATIO);

		// $pdf::SetFont('THSarabun', '', 12, '', true);
		$pdf::SetFont('THSarabun', '', 14, '', true);
		// $pdf::SetFont('dejavusans', '', 12, '', true);
		$pdf::AddPage('P');
		
		$html = '';
		$row_no = 1; $rowPerPage=0;

		$x=$y=0;
		$isBorder = 0; // 1 for coding alingment, 0 for Production
		$yHeight=6;
		$yRowHeight=6;
		$yRowHeight2=12;

		$x=0;		
		$y=10;
			
		$isBorder = 1;
		$pdf::writeHTMLCell(210, $yHeight, $x, $y, '<b>รายงานผลการดำเนินงานศูนย์บริการแบบเบ็ดเสร็จของ บก.ทท. ประจำวันที่ </b>'.$date_str, $border = 0, $ln = 0, $fill = 0, $reseth = true, $align = 'C', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' );
		$y+=$yHeight;

		PDF::Ln();
		$rowPerPage=0;
		$row_topic=1;
		$prev_name="";
		$count_1=$count_2=$count_3=0;
		$total_count_1=$total_count_2=$total_count_3=0;
		$net_count=0;
        if($rowPerPage==0){
             $html ='
            <table class="table table-striped no-margin" border="1" style="padding: 1px;" >
                 <thead>   
                	<tr>
	                    <th style="font-weight: bold; text-align: center; width: 30px; vertical-align: middle;" rowspan="2" >ลำดับ</th>
	                    <th style="font-weight: bold; text-align: center; width: 400px;" rowspan="2" >เรื่อง</th>
	                    <th style="font-weight: bold; text-align: center; width: 210px;" colspan="3" >จำนวนผู้ขอรับบริการ (ราย)</th>
                	</tr>
                	<tr>
	                    <th style="font-weight: bold; text-align: center; width: 70px;" >ข้าราชการ ประจำการ</th>
	                    <th style="font-weight: bold; text-align: center; width: 70px;" >ข้าราชการ บำนาญ</th>
	                    <th style="font-weight: bold; text-align: center; width: 70px;" >ประชาชน ทั่วไป</th>
                	</tr>
                </thead>
                <tbody>
            '; 
        } // rowPerPage

        foreach($service_types as $key => $service_type){
         		//switch         	
	         	switch($service_type->id){
	         		case 1 : case 2 :
	         		if($prev_name != "" && $prev_name != $service_type->service_type_name){
		         		// print footer
		         		$html .= '<tr>
			         		<td colspan="2" style="text-align: center; font-weight: bold;">รวม</td>
				     		<td style="text-align: center; font-weight: bold;">'.$this->toThaiNumber($total_count_1).'</td>
				     		<td style="text-align: center; font-weight: bold;">'.$this->toThaiNumber($total_count_2).'</td>
				     		<td style="text-align: center; font-weight: bold;">'.$this->toThaiNumber($total_count_3).'</td>
			         	</tr>';
			         	$html .= '<tr>
			         		<td colspan="2" style="text-align: center; font-weight: bold;">รวม '.$prev_name.'</td>
			         		<td colspan="3" style="text-align: center; font-weight: bold;">รวม '.$this->toThaiNumber($total_count_1+$total_count_2+$total_count_3).'</td>
			         	</tr>';
			         	$net_count+=($total_count_1+$total_count_2+$total_count_3);

		         		$row_topic=1;
		         		$count_1=$count_2=$count_3=0;
						$total_count_1=$total_count_2=$total_count_3=0;
		         	}

		        	if($row_topic=1){
		             $html .='<tr>
		             	<td colspan="5" style="width: 640px; font-weight: bold;">&nbsp;ผลการดำเนินงาน'.$service_type->service_type_name.'
		             	</td>
		             </tr>';
		         	}
	         		foreach ($service_data as $key => $item) {
	         			$count_1=$item->count_1;
	         			$count_2=$item->count_2;
	         			$count_3=$item->count_3;

			         	$html .= '<tr>
			         		<td style=" width: 30px; text-align: center;">'.$this->toThaiNumber($row_topic).'</td>
			         		<td style=" width: 400px;">'.$item->service_topic_name.'</td>
			         		<td style=" width: 70px; text-align: center;">'.$this->toThaiNumber($count_1).'</td>
			         		<td style=" width: 70px; text-align: center;">'.$this->toThaiNumber($count_2).'</td>
			         		<td style=" width: 70px; text-align: center;">'.$this->toThaiNumber($count_3).'</td>
			         	</tr>';

			         	$row_topic+=1;
			         	$prev_name=$service_type->service_type_name;
						$total_count_1+=$count_1;
						$total_count_2+=$count_2;
						$total_count_3+=$count_3;
		         	}
		         	break;

	         		case 3 : 
	         		foreach ($complains as $key => $item) {
	         			if($prev_name != "" && $prev_name != $service_type->service_type_name){
			         		// print footer
			         		$html .= '<tr>
				         		<td colspan="2" style="text-align: center; font-weight: bold;">รวม</td>
					     		<td style="text-align: center; font-weight: bold;">'.$this->toThaiNumber($total_count_1).'</td>
					     		<td style="text-align: center; font-weight: bold;">'.$this->toThaiNumber($total_count_2).'</td>
					     		<td style="text-align: center; font-weight: bold;">'.$this->toThaiNumber($total_count_3).'</td>
				         	</tr>';
				         	$html .= '<tr>
				         		<td colspan="2" style="text-align: center; font-weight: bold;">รวม '.$prev_name.'</td>
				         		<td colspan="3" style="text-align: center; font-weight: bold;">รวม '.$this->toThaiNumber($total_count_1+$total_count_2+$total_count_3).'</td>
				         	</tr>';
				         	$net_count+=($total_count_1+$total_count_2+$total_count_3);

			         		$row_topic=1;
			         		$count_1=$count_2=$count_3=0;
							$total_count_1=$total_count_2=$total_count_3=0;
			         	}

			        	if($row_topic=1){
			             $html .='<tr>
			             	<td colspan="5" style="width: 640px; font-weight: bold;">&nbsp;ผลการดำเนินงาน'.$service_type->service_type_name.'
			             	</td>
			             </tr>';
			         	}

	         			$count_1=($item->customer_type_id==1?1:0);
						$count_2=($item->customer_type_id==2?1:0);
						$count_3=($item->customer_type_id==3?1:0);

			         	$html .= '<tr>
			         		<td style=" width: 30px; text-align: center;">'.$this->toThaiNumber($row_topic).'</td>
			         		<td style=" width: 400px;">'.$item->remark.'</td>
			         		<td style=" width: 70px; text-align: center;">'.$this->toThaiNumber($count_1).'</td>
			         		<td style=" width: 70px; text-align: center;">'.$this->toThaiNumber($count_2).'</td>
			         		<td style=" width: 70px; text-align: center;">'.$this->toThaiNumber($count_3).'</td>
			         	</tr>';

			         	$row_topic+=1;
			         	$prev_name=$service_type->service_type_name;
						$total_count_1+=$count_1;
						$total_count_2+=$count_2;
						$total_count_3+=$count_3;
		         	}
         			break;         			
	         	}
         	
        } // service_types

        $html .= '<tr>
     		<td colspan="2" style="text-align: center; font-weight: bold;">รวม</td>
     		<td style="text-align: center; font-weight: bold;">'.$this->toThaiNumber($total_count_1).'</td>
     		<td style="text-align: center; font-weight: bold;">'.$this->toThaiNumber($total_count_2).'</td>
     		<td style="text-align: center; font-weight: bold;">'.$this->toThaiNumber($total_count_3).'</td>
     	</tr>';
     	$html .= '<tr>
     		<td colspan="2" style="text-align: center; font-weight: bold;">รวม '.$prev_name.'</td>
     		<td colspan="3" style="text-align: center; font-weight: bold;">รวม '.$this->toThaiNumber($total_count_1+$total_count_2+$total_count_3).'</td>
     	</tr>';
	    $net_count+=($total_count_1+$total_count_2+$total_count_3);

     	$html .= '<tr>
     		<td colspan="2" style="text-align: center; font-weight: bold;">รวม ให้บริการของศูนย์เบ็ดเสร็จทั้งสิ้น</td>
     		<td colspan="3" style="text-align: center; font-weight: bold;">รวม '.$this->toThaiNumber($net_count).'</td>
     	</tr>';

     	$html .= '</tbody>
            </table>';
		PDF::writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
		// End Total Row
		// // Footer
		// PDF::SetFont('THSarabun', '', 14, '', true);
        // // Page number
		// $tmp = date('Y-m-d H:i:s');
		// //$tmp = to_thai_short_date_fdt($tmp);
		// PDF::Cell(0, 10,'Print : '. $tmp, 0, false, 'R', 0, '', 0, false, 'T', 'M');
		// //  Footer

		$pdf::SetTitle('รายงานผลการดำเนินงานศูนย์บริการแบบเบ็ดเสร็จของ บก.ทท.');
		$pdf::Output('รายงานผลการดำเนินงานศูนย์บริการแบบเบ็ดเสร็จของ บก.ทท..pdf','I');
	}
}

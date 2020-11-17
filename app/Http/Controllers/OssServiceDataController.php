<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\OssServiceData;
use App\OssServiceTopic;
use App\OssServiceType;
use App\OssCustomerType;
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
			$issue_date = str_replace('/', '-', $req['issue_date']);
			$issue_date = date('Y-m-d', strtotime($issue_date));
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
			->whereBetween('a.issue_date', [$issue_date, $issue_date_to])
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

	public function report_summary_pdf(Request $req){
		// $from_location = PdLocation::find($hdr->from_location_id)->first();
		// $to_location = PdLocation::find($hdr->to_location_id)->first();
		$issue_date = str_replace('/', '-', $req['issue_date']);
		$issue_date = date('Y-m-d', strtotime($issue_date));
		$issue_date_to = str_replace('/', '-', $req['issue_date_to']);
		$issue_date_to = date('Y-m-d', strtotime($issue_date_to));
		
		// $service_data->save();		

		$service_types = OssServiceType::where('status','=',1)->get();

		$service_data = DB::table('oss_service_types as a')
		->join('oss_service_topics as b','b.service_type_id','=','a.id')
		->select('a.id', 'b.service_topic_name'
			, DB::RAW('(SELECT COUNT(x.id) FROM oss_service_data as x 
				WHERE x.status=1 
				AND x.service_topic_id=b.id
				AND x.customer_type_id=1) as count_1')
			, DB::RAW('(SELECT COUNT(x.id) FROM oss_service_data as x 
				WHERE x.status=1 
				AND x.service_topic_id=b.id
				AND x.customer_type_id=2) as count_2')
			, DB::RAW('(SELECT COUNT(x.id) FROM oss_service_data as x 
				WHERE x.status=1 
				AND x.service_topic_id=b.id
				AND x.customer_type_id=3) as count_3')
		)
		->where('a.status','=',1)
		// ->whereBetween('a.issue_date', [$issue_date, $issue_date_to])
		// ->groupBy('a.service_type_id','a.service_topic_id','a.remark'
		// 	,'b.service_type_name','c.service_topic_name')
		->get();	
			
		$size = 'A4'; // array(200,  100);
		$pdf = new PDF('P', 'mm', $size, true, 'UTF-8', false);
		// add font
		// $pdf->addFont('');
		// set default font subsetting mode
		$pdf::setFontSubsetting(true);


		// PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		$pdf::setMargins(0, 0, 0);	
		$pdf::SetPrintHeader(false);
		$pdf::SetPrintFooter(false);

		// set auto page breaks
		//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf::SetAutoPageBreak(TRUE, 0);

		// set image scale factor
		$pdf::setImageScale(PDF_IMAGE_SCALE_RATIO);


		// $pdf::SetFont('tahoma', '', 12, '', true);
		// $pdf::SetFont('dejavusans', '', 12, '', true);
		$pdf::AddPage('P');

		// PDF::SetMargins(20, 20, 10);
		// PDF::SetHeaderMargin(PDF_MARGIN_HEADER);
		// PDF::SetFooterMargin(PDF_MARGIN_FOOTER);		
		// // set auto page breaks
		// PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// // set image scale factor
		// PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);

		// PDF::AddPage('L', 'A4');

		// //
		// PDF::SetFont('Times', '', 10, '', true);
		// PDF::Cell(0, 5, PDF::getAliasNumPage().'/'.PDF::getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
		
		// PDF::SetFont('Times', 'B', 16, '', true);		
		// PDF::SetY(11);	
		// PDF::Cell(0, 5, 'Asia Kangnam Co.,Ltd.', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		// PDF::Ln(7);
		// PDF::SetFont('Times', 'B', 14, '', true);	
		// PDF::Cell(0, 5, 'Sending', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		//

		//style texst
		$styleText = array(
			'position' => '',
			'align' => 'C',
			'stretch' => false,
			'fitwidth' => true,
			'cellfitalign' => '',
			'border' => false,
			'hpadding' => 'auto',
			'vpadding' => 'auto',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255),
			'text' => false,
			'font' => 'helvetica',
			'fontsize' => 8,
			'stretchtext' => 3
		);

		$html = '';
		$row_no = 1; $rowPerPage=0;

		$x=$y=0;
		$isBorder = 0; // 1 for coding alingment, 0 for Production
		$x=2;
		$yHeight=17;
		foreach ($service_types as $service_type){
			$y+=25;
			$isBorder = 1;
			$pdf::writeHTMLCell(195, $yHeight, $x, $y, $service_type->service_type_name, $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' );
			$y+=$yHeight;	// new line
			foreach ($service_data as $item) {

				//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
				#writeHTMLCell(w, h, x, y, html = '', border = 0, ln = 0, fill = 0, reseth = true, align = '', autopadding = true)

				//Cell( $w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' )

				if($service_type->id==$item->id){
					$yHeight=15;		
					$x=2;			
					$pdf::writeHTMLCell(60, $yHeight, $x, $y, $item->service_topic_name, $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' ); 
					$x+=60;		


					$pdf::writeHTMLCell(100, $yHeight, $x, $y, $item->count_1, $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' ); 
					$x+=60;	


					$pdf::writeHTMLCell(150, $yHeight, $x, $y, $item->count_2, $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' ); 
					$x+=60;	

					$pdf::writeHTMLCell(200, $yHeight, $x, $y, $item->count_3, $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' ); 
				}
				// $y+=25;
				// $isBorder = 0;
				// $pdf::writeHTMLCell(195, $yHeight, $x, $y, $item->service_topic_name, $border = $isBorder, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' );


				$y+=$yHeight;	// new line

				

				$html='';
				$rowPerPage=0;
								

				$row_no +=1; $rowPerPage+=1; 

			} // foreach
		}
		

		// // Footer
		// PDF::SetFont('THSarabun', '', 14, '', true);
        // // Page number
		// $tmp = date('Y-m-d H:i:s');
		// //$tmp = to_thai_short_date_fdt($tmp);
		// PDF::Cell(0, 10,'Print : '. $tmp, 0, false, 'R', 0, '', 0, false, 'T', 'M');
		// //  Footer

		$pdf::SetTitle('Service Report');
		$pdf::Output('Service Report.pdf','I');
	}
}

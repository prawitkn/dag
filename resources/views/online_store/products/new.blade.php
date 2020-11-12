@extends('layouts.onlineStoreLayout.design')

@section('head')
@endsection

@section('content')

<!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/online_store') }}">หน้าแรก</a></li>
      <li class="breadcrumb-item active"> สินค้า</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="display">เพิ่มสินค้า
      </h1>

    </header>
    <!-- Page Header-->
    <div class="row">
      <div class="col-md-12">

    <div class="card">
      <form id="frm1" href="#">
        <div class="card-body">

          <input type="hidden" id="id" value="" />
        
            <div class="row">
              <div class="form-group col-md-2">
                <label for="product_code">ประเภท</label>
                <input type="hidden" name="product_category_id" value="" />
                <select name="product_category_name" class="form-control" required="required" >
                  <option value=""></option>
                  @foreach($product_categories as $item)
                  <option value="{{ $item->id }}" 
                    >
                    {{ $item->id }} : {{ $item->product_category_name }}                
                  </option>
                  @endforeach 
                </select>
              </div><!--/.col-6-->

              <div class="form-group col-md-3">
                <label for="product_code">รหัสสินค้า</label>
                <input type="text" class="form-control" name="product_code" value="" required  autofocus>
              </div><!--/.col-6-->

              <div class="form-group col-md-6">
                <label for="product_name">ชื่อสินค้า</label>
                <input type="text" class="form-control" name="product_name" value="" required >
              </div><!--/.col-6-->


              <div class="form-group col-md-1">
                <label for="product_uom">หน่วย</label>
                <input type="text" class="form-control" name="product_uom" value="" required >
              </div><!--/.col-6-->

            </div><!--/row-->
      
        </div>
        <!--/.card-body-->

        <div class="card-footer">
          <div class="col-12 d-flex no-block align-items-center">

              <div class="ml-auto text-right">
          
          <button type="submit" name="btn_create" class="btn btn-primary shadow rounded" > บันทึก</button>
          <!-- <a href="#" name="btn_save_n_confirm" class="btn btn-primary rounded shadow" />Save & Confirm</a> -->
                  
              </div>
          </div>
        </div>
        <!--/.card-footer-->
    </form>
  </div>
  <!--/.card-->

    

      </div>
      <!--/.col-md-12-->
    </div>
    <!--/.row-->
  </div>
  <!--/.container-fluid-->
</section>










@endsection   

@section('footer')
<style>  
    @media (min-width: 768px) {
      .modal-xl {
        width: 90%;
       max-width:1200px;
      }
    }

    table.dataTable.compact tbody td {
        padding: 0px !important; 
        line-height: 1 !important;
    }
</style>



<link href="{{ asset('public/assets/libs/bootstrap-datepicker-custom-thai/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<script src="{{ asset('public/assets/libs/bootstrap-datepicker-custom-thai/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('public/assets/libs/bootstrap-datepicker-custom-thai/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



<!-- Add fancybox JS 
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/libs/fancybox-master/dist/jquery.fancybox.min.css') }}">
<script src="{{ asset('public/assets/libs/fancybox-master/dist/jquery.fancybox.min.js') }}"></script>


<!-- Set default evaluator -->
<script type="text/javascript">

$(document).ready(function(){	
	var ref_items = new Array();	
	var item = {id:'', barcode:'', remain:'' };

    $('.datepicker').datepicker({
        daysOfWeekHighlighted: "0,6",
        autoclose: true,
        format: 'dd/mm/yyyy',
        todayBtn: true,
        minDate: '01/01/2020',
        language: 'en',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: false              //Set เป็นปี พ.ศ.
    });  
        //กำหนดเป็นวันปัจุบัน
    $('.datepicker').datepicker('setDate', '0');

	function datepickerToSqlDate(dateString){	// dateString = dd/mm/yyyy		
		var dateParts = dateString.split("/");
		// month is 0-based, that's why we need dataParts[1] - 1
		var d = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]); 

		// var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

	    if (month.length < 2) 
	        month = '0' + month;
	    if (day.length < 2) 
	        day = '0' + day;

	    return [year, month, day].join('-');
	}

	function formClear(){
		$('input[name="product_uom"]').val('');
    $('input[name="product_name"]').val('');
    $('input[name="product_code"]').val('');
    $('select[name="product_category_name"]').prop("selectedIndex", 0);

    $('input[name="product_code"]').select();
	}
	
	formClear();

  $('select[name="product_category_name"]').change(function(e){ 
    $('input[name="product_category_id"]').val($('select[name="product_category_name"] option').filter(":selected").val());  
  }); // change

    $('a[name="btn_create"]').click(function(e){  
    
    }); // click


	$('select[name="machine_code"]').change(function(e){ 
      $('input[name="machine_id"]').val($('select[name="machine_code"] option').filter(":selected").val());  
    }); // change

  $('#frm1').submit(function(e){ 
    e.preventDefault(); // For Form Valid and not use default href link

    var params = {};
    var tmp = $('#frm1').serialize();
    params = tmp;
    console.log(params);
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    }); 
    $.ajax({
      url: "{{ url('/online_store/products/create') }}",
      type: 'post', dataType:"json", data: params,
      success: function (res) { console.log(res);
        if(res.success=="success"){
          alert(res.msg);
          formClear();
        }else{
          alert(res.msg);
        } 
      },
      error: function(xhr, status, error) {
        console.log(xhr);
        var err = eval("(" + xhr.responseText + ")");
        alert(JSON.parse(xhr.responseText).message);
      }
    }); // /.ajax   
  }); // click

});

</script>



@endsection





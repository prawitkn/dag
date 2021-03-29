@extends('layouts.adminLayout.design')

@section('head')
@endsection

@section('content')

<!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">User</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="display">New User
      </h1>
      

    </header>
    <!-- Page Header-->
    <div class="row">
      <div class="col-md-12">

    <div class="card">
      <div class="card-body">
	  <form method="POST" action="{{ route('user2Create') }}">
                        @csrf
	      <div class="form-group">
	        <label for="register-username">Name                </label>
	        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

	                @error('name')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
	                @enderror
	      </div>
	      <div class="form-group">
	        <label>Email Address</label>
	        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

	                @error('email')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
	                @enderror
	      </div>
	      <div class="form-group mb-4">
	        <label>Password</label>
	        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

	                @error('password')
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $message }}</strong>
	                    </span>
	                @enderror
	      </div>

	      <!-- Submit-->
	      <button type="submit" class="btn btn-primary">
	                {{ __('Save') }}
	            </button>
	    </form>
      </div>
      <!--/.card-body-->

      <div class="card-footer">
        <div class="col-12 d-flex no-block align-items-center">

            <div class="ml-auto text-right">
				
            </div>
        </div>
      </div>
      <!--/.card-footer-->
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
		$('input[name="product_id"]').val('');
		$('input[name="produce_code"]').val('');
		$('.datepicker').datepicker('setDate', '0');
		$('select[name="machine_code"]').prop("selectedIndex", 0);
		$('input[name="machine_id"]').val('');
		$('input[name="meter"]').val(0);
		$('input[name="net_weight"]').val(0);
		$('input[name="gross_weight"]').val(0);
		$('input[name="seq_no"]').val(0);
	}
	
	formClear();


	// Modal Product Begin
  function getProduct(id){
    var params = {};
      params.id = id;
      // console.table(params); return;
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      });  
      url = '{{ url("/akweb/products/") }}'+'/'+params.id;
      $.ajax({
        url: url,
        type: 'get', dataType:"json", data: {},
        success: function (res) { console.log(res);
          if(res.success=="success"){
               // alert('success');
              // tmpTd.find('label').text(res.current_progress_level);
              $('input[name="product_id"]').val(res.item.id);
              $('input[name="product_code"]').val(res.item.product_code);
          }else{
              alert('msg');
          }     
        },
        error: function(xhr, status, error) {
          console.log(xhr);
          var err = eval("(" + xhr.responseText + ")");
          alert(JSON.parse(xhr.responseText).message);
        }
      }); // /.ajax   
  } // getProduct



  //Modal Product
    $('input[name="product_code"]').keyup(function(e){ 
      var code = e.which; // recommended to use e.which, it's normalized across browsers
      if(code==13) {        
        $('input[name="query_product_code"]').val($(this).val());
        $('#modalProduct').modal('show');   
        getProductList(); 
      }
    }); //. $('a[name=btnSearchEvaluator]').click(function(){

  var tbl_product_list; // = $('#table').DataTable();
  function getProductList(){  // alert($submit_flag);
      if ($.fn.DataTable.isDataTable('#tbl_product_list')) {        
          tbl_product_list.ajax.reload( null, false );
      }else{
          tbl_product_list = $('#tbl_product_list').DataTable( {
              searching: false,
              paging: false,
              info: false,
              fixedHeader: true,
              ajax: {
                  type: 'GET',
                  url: "{{ url('/akweb/products/search') }}",
                  data: {
                      query_product_code: function() { return $('input[name="query_product_code"]').val(); }
                  },
                  dataSrc: 'items',
              },
              autoWidth: false,
              columns: [               
                  { data: 'id' },        
                  { data: 'product_code' },    
              ],
              order: [[ 0, 'desc' ], [ 1, 'asc' ]],
              columnDefs: [
                  {   targets: 'col_select',
                      className: 'dt-center',
                       render: function (data, type, row, meta) {
                        // var tmp = '<label style="display:none; ">'+row.id+'</label>'+
                        // '<i class="fas fa-check" name="query_product_code_checked" data-ref_id="'+row.id+'" >check</i>';
                        var tmp = '<a href="#" name="query_product_code_checked" class="btn btn-primary shadow rounded btn-sm" data-ref_id="'+row.id+'">select</a>';
                        return tmp;
                     }
                   },
                   {   targets: 'col_product_code',
                       render: function (data, type, row, meta) {
                          // var tmp = row.product_code.replace(new RegExp(data.query_product_code, 'g'), '<span style="color: red;">'+data.query_product_code+'</span>');
                          var tmp = row.product_code;
                          return tmp;
                       }
                   }, 
              ]
          } );
      }    
  } //.getProductList()

  $(document).on('click', 'a[name="query_product_code_checked"]', function(){  //alert('click');
        getProduct($(this).attr('data-ref_id'));
        $('#modalProduct').modal('hide');   
    }); //. $('#grading_group_id').change(function(){ 
	// Modal Product End










	// Modal Machine Begin
	function getMachine(id){
		    var params = {};
	      params.id = id;
	      // console.table(params); return;
	      $.ajaxSetup({
	          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
	      });  
	      tmpUrl = '{{ url("/production/machines/") }}'+'/'+params.id;
	      $.ajax({
	        url: tmpUrl,
	        type: 'get', dataType:"json", data: {},
	        success: function (res) { console.log(res);
	          if(res.success=="success"){
				  setMachine(res.item);
	          }else{
	              alert('msg');
	          }     
	        },
	        error: function(xhr, status, error) {
	          console.log(xhr);
	          var err = eval("(" + xhr.responseText + ")");
	          alert(JSON.parse(xhr.responseText).message);
	        }
	      }); // /.ajax   
	  } // getProduct

	  function setMachine(item){
		$('input[name="machine_id"]').val(item.id);
		$('input[name="machine_code"]').val(item.machine_code);
	  } // getProduct
  
    $('input[name="machine_code"]').keyup(function(e){ 
      var code = e.which; // recommended to use e.which, it's normalized across browsers
      if(code==13) {        
        $('input[name="query_machine_code"]').val($(this).val());
        $('#modalMachine').modal('show');   
        getMachineList(); 
      }
    }); //. $('a[name=btnSearchEvaluator]').click(function(){

  var tbl_machine_list; // = $('#table').DataTable();
  function getMachineList(){  // alert($submit_flag);
      if ($.fn.DataTable.isDataTable('#tbl_machine_list')) {      
			tbl_machine_list.ajax.reload( null, false );
      }else{
		tbl_machine_list = $('#tbl_machine_list').DataTable( {
              searching: false,
              paging: false,
              info: false,
              fixedHeader: true,
              ajax: {
                  type: 'GET', 
                  url: "{{ url('/production/machines/search') }}",
                  data: {
					query_machine_code: function() { return $('input[name="query_machine_code"]').val(); }
                  },
                  dataSrc: 'items',
              },
              autoWidth: false,
              columns: [               
                  { data: 'id' },        
                  { data: 'machine_code' },    
                  { data: 'machine_description' },    
              ],
              order: [[ 0, 'desc' ], [ 1, 'asc' ]],
              columnDefs: [
                  {   targets: 'col_select',
                      className: 'dt-center',
                       render: function (data, type, row, meta) {
                        // var tmp = '<label style="display:none; ">'+row.id+'</label>'+
                        // '<i class="fas fa-check" name="query_product_code_checked" data-ref_id="'+row.id+'" >check</i>';
                        var tmp = '<a href="#" name="query_machine_code_checked" class="btn btn-primary shadow rounded btn-sm" data-ref_id="'+row.id+'">select</a>';
                        return tmp;
                     }
                   },
                   {   targets: 'col_machine_code',
                      className: 'dt-center',
                       render: function (data, type, row, meta) {
                          var tmp = row.machine_code;
                          return tmp;
                       }
                   },     
                   {   targets: 'col_machine_desc',
                      className: 'dt-center',
                       render: function (data, type, row, meta) {
                          var tmp = row.machine_description;
                          return tmp;
                       }
                   },          
              ]
          } );
      }    
  } //.getList()

  $(document).on('click', 'a[name="query_machine_code_checked"]', function(){  //alert('click');
        getMachine($(this).attr('data-ref_id'));
        $('#modalMachine').modal('hide');   
    }); //. $('#query_machine_code_checked
	// Modal Machine End





		//Modal Material 
		$('a[name="btn_material_code"]').click(function(e){ 
	        $('#modalMaterial').modal('show');  
	        getMaterialList(); 
			$('input[name="query_material_code').focus(); 
	    }); //. $('a[name=btn_material_search]').click(function(){
		$('input[name="query_material_code"]').keyup(function(e){ 
	      var code = e.which; // recommended to use e.which, it's normalized across browsers
	      if(code==13) {        
	        getMaterialList(); 
	      }
	    }); //. $('a[name=btnSearchEvaluator]').click(function(){

	  var tbl_material_list; // = $('#table').DataTable();
	  function getMaterialList(){  // alert($submit_flag);
	      if ($.fn.DataTable.isDataTable('#tbl_material_list')) {        
			tbl_material_list.ajax.reload( null, false );
	      }else{
			tbl_material_list = $('#tbl_material_list').DataTable( {
	              searching: false,
	              paging: false,
	              info: false,
	              fixedHeader: true,
	              ajax: {
	                  type: 'GET',
	                  url: "{{ url('/production/produces/material-list') }}",
	                  data: {
	                      query_material_code: function() { return $('input[name="query_material_code"]').val(); }
	                  },
	                  dataSrc: 'items',
	              },
	              autoWidth: false,
	              columns: [                  
	                  { data: null },        
	                  { data: 'barcode' },    
	                  { data: 'issue_date' },    
	                  { data: 'meter' },    
	                  { data: 'used_qty' },    
	                  { data: null },    
	              ],
	              order: [[ 0, 'desc' ], [ 1, 'asc' ]],
	              columnDefs: [
	                  {   targets: 'col_select',
	                      className: 'dt-center',
	                       render: function (data, type, row, meta) {
							var tmp;
							// $.each(ref_items, function( index, value ) {
							// 	if ( value.id == row.id ){
							// 		tmp = '<input type="checkbox" value="'+row.id+'" data-ref_barcode="'+row.barcode+'" '+
							// 		'style="-ms-transform: scale(1.5); '+
							// 	       ' -webkit-transform: scale(1.5); '+ 
							// 	       ' transform: scale(1.5);" '+
							// 		' disabled/> '; break;
							// 	}
							// });
							if ( !tmp ){
								tmp = '<input type="checkbox" value="'+row.id+'" data-ref_barcode="'+row.barcode+'" '+
									'style="-ms-transform: scale(1.5); '+
								       ' -webkit-transform: scale(1.5); '+ 
								       ' transform: scale(1.5);" '+
									'/> ';
							}
	                        return tmp;
	                     }
	                   },  
	                   {   targets: 'col_remain',
	                       render: function (data, type, row, meta) {
	                          // var tmp = row.product_code.replace(new RegExp(data.query_product_code, 'g'), '<span style="color: red;">'+data.query_product_code+'</span>');
	                          var tmp = row.meter-row.used_qty;
	                          return tmp;
	                       }
	                   },         
	              ]
	          } );
	      }    
	  } //.getProductList()

		$('a[name="btn_material_save"]').click(function(e){ 
			// loop over each table row (tr)
			$("#tbl_material_list tr").each(function(){
				var currentRow=$(this);
				
				if( $(this).children('td:eq(0)').find('input[type="checkbox"]').prop("checked") ){ 
					var itm = [];
					itm.id = $(this).children('td:eq(0)').find('input[type="checkbox"]').val();
					itm.barcode = $(this).children('td:eq(1)').text();
					itm.remain = $(this).children('td:eq(5)').text();
					ref_items.push(itm);
				}
			});
		
			console.log(ref_items);
	        $('#modalMaterial').modal('hide');
			renderRefItems();
	    }); //. $('a[name=btn_material_save]').click(function(){

		function renderRefItems(){
			$('#div_ref_items').empty();
			$.each(ref_items, function( index, value ) {
				// console.log('index:'+index+', '+value.id);
				$('#div_ref_items').append('<p class="btn btn-info shadow rounded" data-ref_id="'+value.id+'" style="color: white;" '+
				'>'+value.barcode+' / '+value.remain+'&nbsp;'+
				'<a name="btn_ref_item_delete" class="btn btn-danger btn-sm rounded" data-ref_id="'+value.id+'"  style="color: white;" '+
				'>x</a></p>&nbsp;'+
				'<input type="hidden" name="reference_item_ids[]" value="'+value.id+'" />');
			});
		}
		$(document).on('click','a[name="btn_ref_item_delete"]',function(){
			var remove_id = $(this).attr('data-ref_id');
			console.log(remove_id);
			$.each(ref_items, function( index, value ) {
				if( value.id == remove_id ){
					ref_items.splice(index, 1);
				}
			});
			renderRefItems();
		});
		// Modal Material End


    


    $('a[name="btn_create"]').click(function(e){  
      var params = {};
    //   params.product_id = $('input[name="product_id"]').val();
    //   params.product_code = $('input[name="product_code"]').val();
    //   params.issue_date = datepickerToSqlDate($('input[name="issue_date"]').val());
    //   params.machine_code = $('select[name="machine_code"] option').filter(":selected").val();
    //   params.machine_id = $('input[name="machine_id"]').val();
    //   params.meter = $('input[name="meter"]').val();
    //   params.net_weight = $('input[name="net_weight"]').val();
    //   params.gross_weight = $('input[name="gross_weight"]').val();
    //   params.seq_no = $('input[name="seq_no"]').val();
    //   params.reference_item_ids = $('input[name="reference_item_ids[]"]').val();
	//   params = $('#frm1').serialize()  + '&reference_item_ids=' + JSON.stringify(ref_items);
	var tmp = $('#frm1').serialize();
	$.each($('input[name="reference_item_ids[]"]'), function(){
		tmp=tmp+'&'+$(this).serialize();
	});
	params = tmp;
	//   console.log(params);
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      }); 
      $.ajax({
        url: "{{ url('/production/produces/create') }}",
        type: 'post', dataType:"json", data: params,
        success: function (res) { //console.log(res);
            if(res.success=="success"){
	      		tmpUrl = '{{ url("/production/produces/view-edit") }}'+'/'+res.items.id;
                location = tmpUrl;
            }else{
                alert('msg');
            } 
        },
        error: function(xhr, status, error) {
          console.log(xhr);
          var err = eval("(" + xhr.responseText + ")");
          alert(JSON.parse(xhr.responseText).message);
        }
      }); // /.ajax   
    }); // click


	$('select[name="machine_code"]').change(function(e){ 
      $('input[name="machine_id"]').val($('select[name="machine_code"] option').filter(":selected").val());  
    }); // change
});

</script>



@endsection





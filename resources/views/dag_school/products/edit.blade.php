@extends('layouts.onlineStoreLayout.design')

@section('head')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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
      <h1 class="display">สินค้า : <b>{{ $product->product_name }}</b>
      </h1>
      

    </header>
    <!-- Page Header-->
    <div class="row">
      <div class="col-md-12">

    <div class="card">
      <div class="card-body">
	  <form id="frm1" method="POST" action="">
                        @csrf
        <input type="hidden" name="id" value="{{ $product->id }}" />
                              
        <div class="row">
          <div class="form-group col-md-3">
            <input type="checkbox" name="status" id="status" data-toggle="toggle" data-size="mini" 
            @if( $product->status ) checked @endif
            >
            ใช้งาน 
            
          </div><!--/.col-->
        </div>

        <div class="row">
          <div class="form-group col-md-2">
            <label for="product_code">ประเภท</label>
            <input type="hidden" name="product_category_id" value="{{ $product->product_category_id }}" />
            <select name="product_category_name" class="form-control" required="required" >
              @foreach($product_categories as $item)
              <option value="{{ $item->id }}" 
                @if( $item->id==$product->product_category_id ) selected @endif
                >
                {{ $item->id }} : {{ $item->product_category_name }}                
              </option>
              @endforeach 
            </select>
          </div><!--/.col-6-->

          <div class="form-group col-md-3">
            <label for="product_code">รหัสสินค้า</label>
            <input type="text" class="form-control" name="product_code" value="{{ $product->product_code }}" required  autofocus>
          </div><!--/.col-6-->

          <div class="form-group col-md-6">
            <label for="product_name">ชื่อสินค้า</label>
            <input type="text" class="form-control" name="product_name" value="{{ $product->product_name }}" required >
          </div><!--/.col-6-->


          <div class="form-group col-md-1">
            <label for="product_uom">หน่วย</label>
            <input type="text" class="form-control" name="product_uom" value="{{ $product->product_uom }}" required  autofocus>
          </div><!--/.col-6-->

        </div><!--/row-->

	      <!-- Submit-->
	      
	    </form>
      </div>
      <!--/.card-body-->

      <div class="card-footer">
        <div class="col-12 d-flex no-block align-items-center">

            <div class="ml-auto text-right">				      
                  <a href="#" name="btn_save" class="btn btn-primary"> บันทึก</a> 
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

<!-- Add fancybox JS 
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/libs/fancybox-master/dist/jquery.fancybox.min.css') }}">
<script src="{{ asset('public/assets/libs/fancybox-master/dist/jquery.fancybox.min.js') }}"></script>


<!-- Set default evaluator -->
<script type="text/javascript">

$(document).ready(function(){	
  // $('#is_user_pos').bootstrapToggle();
  $('#is_user_pos').change(function() {
    // if($(this).is(':checked')){
    //   $('select[name="pos_group_name"]').prop('disabled','');
    //   $('select[name="pos_branch_name"]').prop('disabled','');
    // }else{
    //   $('select[name="pos_group_name"]').prop('disabled',true);
    //   $('select[name="pos_branch_name"]').prop('disabled',true);
    // }
  })

  function formClear(){
    $('input[name="product_uom"]').val('');
    $('input[name="product_name"]').val('');
    $('input[name="product_code"]').val('');
    $('select[name="product_category_name"]').prop("selectedIndex", 0);

    $('input[name="product_code"]').select();
  }

	// formClear();
  $('input[name="product_code"]').select();

    $('select[name="product_category_name"]').change(function(e){ 
      $('input[name="product_category_id"]').val($('select[name="product_category_name"] option').filter(":selected").val());  
    }); // change


    $('a[name="btn_save"]').click(function(e){  
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
	// $.each($('input[name="reference_item_ids[]"]'), function(){
	// 	tmp=tmp+'&'+$(this).serialize();
	// });
	params = tmp;
	  // console.log(tmp);
    // return;
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      }); 
      $.ajax({
        url: "{{ url('/online_store/products/update') }}",
        type: 'post', dataType:"json", data: params,
        success: function (res) { 
            console.log(res);
            if(res.success=="success"){
	      		 alert(res.msg);
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





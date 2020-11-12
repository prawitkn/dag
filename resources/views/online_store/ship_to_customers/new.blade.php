@extends('layouts.onlineStoreLayout.design')

@section('head')
@endsection

@section('content')

<!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/online_store') }}">หน้าแรก</a></li>
      <li class="breadcrumb-item active"> ลูกค้า</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="display">เพิ่มลูกค้า
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

              <div class="form-group col-md-6">
                <label for="customer_name">ชื่อลูกค้า</label>
                <input type="text" class="form-control" name="customer_name" value="" required >
              </div><!--/.col-6-->

            </div><!--/row-->
      
        </div>
        <!--/.card-body-->

        <div class="card-footer">
          <div class="col-12 d-flex no-block align-items-center">

              <div class="ml-auto text-right">
          <a href="#" name="btn_clear" class="btn btn-secondary rounded shadow" /> ล้างข้อมุล</a>
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

<!-- Set default evaluator -->
<script type="text/javascript">

$(document).ready(function(){	

	function formClear(){
		$('input[name="customer_name"]').val('');

    $('input[name="customer_name"]').select();
	}
	
	formClear();

    $('a[name="btn_clear"]').click(function(e){  
      formClear();
    }); // click

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
      url: "{{ url('/online_store/customers/create') }}",
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





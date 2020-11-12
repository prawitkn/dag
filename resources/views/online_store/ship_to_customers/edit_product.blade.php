@extends('layouts.onlineStoreLayout.design')

@section('head')
<!-- datatable js -->
<!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
<script src="{{ asset('public/assets/extra-libs/DataTables/1.10.16/js/jquery.dataTables.min.js') }}"></script>
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" > -->
<link rel="stylesheet" charset="utf8" href="{{ asset('public/assets/extra-libs/DataTables/1.10.16/css/jquery.dataTables.min.css') }}" > 

<!-- fixedHeader.dataTables -->
<!-- <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script> -->
<script src="{{ asset('public/assets/extra-libs/DataTables/fixedHeader/3.1.5/js/dataTables.fixedHeader.min.js') }}"></script>
<!--  <link rel="stylesheet" charset="utf8" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.dataTables.min.css" >  -->
<link rel="stylesheet" charset="utf8" href="{{ asset('public/assets/extra-libs/DataTables/fixedHeader/3.1.5/css/fixedHeader.dataTables.min.css') }}" > 

<!-- fixedColumns.dataTables -->
<!-- <script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script> -->
<script src="{{ asset('public/assets/extra-libs/DataTables/fixedColumns/3.2.6/js/dataTables.fixedColumns.min.js') }}"></script>
@endsection

@section('content')

<!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/online_store') }}">หน้าแรก</a></li>
      <li class="breadcrumb-item active">ลูกค้า</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="display">ลูกค้า : <b>{{ $customer->customer_name }}</b>
      </h1>
      

    </header>
    <!-- Page Header-->
    <div class="row">
      <div class="col-md-12">

    <div class="card">
    <form id="frm1" method="POST" action="">
      <div class="card-body">
                        @csrf
        <input type="hidden" name="id" value="{{ $customer->id }}" />
                              
        <div class="row">
          <div class="table-responsive col-md-6">
            <table id="tbl_default" class="hover compact" style="width: 100%;"   >
                <thead>
                    <tr>
                        <th class="col_product_name" style="text-align: center;" >รายการสินค้า</th>
                        <th class="col_action" style="text-align: center;" >Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($default_products as $key => $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td style="text-align: center">
                          <a name="btn_remove_item" data-product_id="{{$item->product_id}}" class="btn btn-danger btn-mini rounded text-white"><i class="fa fa-trash"> นำออก</i></a>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
            </div>

            <div class="table-responsive col-md-6">
            <table id="tbl_more" class="hover compact" style="width: 100%;"   >
                <thead>
                    <tr>
                        <th class="col_product_name" style="text-align: center;" >รายการสินค้า</th>
                        <th class="col_action" style="text-align: center;" >Action</th>
                    </tr>
                </thead>
                <tbody>                  
                  @foreach($more_products as $key => $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td style="text-align: center">
                          <a name="btn_add_item" data-product_id="{{$item->id}}" class="btn btn-primary btn-mini rounded text-white"><i class="fa fa-plus"> นำเข้า</i></a>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
            </div>
        </div>

	      <!-- Submit-->
      </div>
      <!--/.card-body-->

     <!--  <div class="card-footer">
        <div class="col-12 d-flex no-block align-items-center">

            <div class="ml-auto text-right">				      
          <a href="#" name="btn_clear" class="btn btn-secondary rounded shadow" /> ล้างข้อมุล</a>
          <button type="submit" name="btn_create" class="btn btn-primary shadow rounded" > บันทึก</button>
            </div>
        </div>
      </div> -->
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

<!-- Add fancybox JS 
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/libs/fancybox-master/dist/jquery.fancybox.min.css') }}">
<script src="{{ asset('public/assets/libs/fancybox-master/dist/jquery.fancybox.min.js') }}"></script>


<!-- Set default evaluator -->
<script type="text/javascript">

$(document).ready(function(){	
  $('#tbl_default').dataTable({
    paging: false,
    info: false,
    fixedHeader: true,
    autoWidth: true,
    order: [[ 0, 'asc' ], [ 1, 'asc' ]],
  });
  $('#tbl_more').dataTable({
    paging: false,
    info: false,
    fixedHeader: true,
    autoWidth: true,
    order: [[ 0, 'asc' ], [ 1, 'asc' ]],
  });

  function formClear(){
    $('input[name="customer_name"]').val('');

    $('input[name="customer_name"]').select();
  }

	// formClear();
  $('input[name="customer_name"]').select();

  $(document).on('click','a[name="btn_remove_item"]', function(){
    var $tmp = $(this);
    var params = {};
    // var tmp = $('#frm1').serialize();
    params.customer_id = $('input[name="id"]').val();
    params.product_id = $tmp.attr('data-product_id');
    // console.log(params);
    // return;
   $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    }); 
    $.ajax({
      url: "{{ url('/online_store/customers/remove-product') }}",
      type: 'post', dataType:"json", data: params,
      success: function (res) { 
          console.log(res);
          if(res.success=="success"){
            var $tr = $tmp.closest('tr');
            $clone = $tr.clone();
            $clone.find('a').removeClass('btn-danger').addClass('btn-primary');
            $clone.find('a').attr('name','btn_add_item');
            $clone.find('i').removeClass('fa-trash').addClass('fa-plus');
            $clone.find('i').text('นำเข้า');
            $('#tbl_more tbody').fadeIn('slow').append($clone);
            $tr.fadeOut('slow');
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

  $(document).on('click','a[name="btn_add_item"]', function(){
    var $tmp = $(this);
    var params = {};
    // var tmp = $('#frm1').serialize();
    params.customer_id = $('input[name="id"]').val();
    params.product_id = $tmp.attr('data-product_id');
    // console.log(params);
    // return;
   $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    }); 
    $.ajax({
      url: "{{ url('/online_store/customers/add-product') }}",
      type: 'post', dataType:"json", data: params,
      success: function (res) { 
          console.log(res);
          if(res.success=="success"){
            var $tr = $tmp.closest('tr');
            $clone = $tr.clone();
            $clone.find('a').removeClass('btn-primary').addClass('btn-danger');
            $clone.find('a').attr('name','btn_remove_item');
            $clone.find('i').removeClass('fa-trash').addClass('fa-trash');
            $clone.find('i').text('นำออก');
            $('#tbl_default tbody').fadeIn('slow').before($clone);
            $tr.fadeOut('slow');
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





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
      <li class="breadcrumb-item"><a href="{{ url('online_store') }}">หน้าแรก</a></li>
      <li class="breadcrumb-item active"><a href="#">สั่งสินค้า</a></li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
      <form id="frm1" method="POST" action="" >

    <!-- Page Header-->
      <header class="d-flex flex-column flex-sm-row justify-content-between align-items-center"> 
        <h1 class="display">สั่งสินค้า 
        <a href="#" class="btn btn-secondary rounded shadow" onclick="window.close();" > ปิด</a>
      </h1>

        <p id="time-counter" class="btn btn-outline-danger">00:00</p>
      
        @switch($order->status)
          @case(1) <p name="status" class="badge badge-warning" role="alert">ยังไม่เคยบันทึกการสั่งสินค้า</p> @break
          @case(2) <p name="status" class="badge badge-success"  role="alert">บันทึกการสั่งสินค้าแล้ว</p> @break
          @case(3) <p name="status" class="badge badge-info"  role="alert">เปิดให้แก้ไขรายการสั่งสินค้า</p> @break
          @default <p name="status" class="badge badge-dark" role="alert"> - </p> @break
        @endswitch

      
      </header>

        <input type="hidden" name="order_id" value="" />
        <input type="hidden" name="cust_id" value="" />
        <input type="hidden" name="ship_to_id" value="" />



        <div class="row">
          <div class="form-group col-md-3">
            <div class="form-group-material">
              <input  type="text" name="issue_date" class="input-material datepicker" data-format="yyyy-mm-dd" disabled="disabled">
              <label for="issue_date" class="label-material active">วันที่</label>
            </div>
            <!--/.form-group-material-->
          </div>
          <!--/.col-->

          <div class="form-group col-md-5">
            <div class="form-group-material">
              <input  type="text" name="cust_name" class="input-material" disabled="disabled">
              <label for="cust_name" class="label-material active">ลูกค้า</label>
            </div>
            <!--/.form-group-material-->
          </div>
          <!--/.col-->

          <div class="form-group col-md-4">
            <div class="form-group-material">
              <input  type="text" name="ship_to_name" class="input-material" disabled="disabled">
              <label for="ship_to_name" class="label-material active">สาขา</label>
            </div>
            <!--/.form-group-material-->
          </div>
          <!--/.col-->


      </div>
      <!--/.row-->

    </header>
    <!-- Page Header-->
    <div class="row">
      <div class="col-md-2">          
        @foreach($ship_tos as $key2 => $itm)
          @if($itm->last_updated_at)
            @if($itm->id == $order->ship_to_id)
                 <a class="btn btn-primary" href="#" >{{ $itm->ship_to_code }}</a>&nbsp;
            @else
               <a name="btn_branch_paging" data-ship_to_id="{{ $itm->id }}" class="btn btn-outline-primary" href="#" >{{ $itm->ship_to_code }}</a>&nbsp;
            @endif
          @else
            @if($itm->id == $order->ship_to_id)
                 <a class="btn btn-warning" href="#" >{{ $itm->ship_to_code }}</a>&nbsp;
            @else
               <a name="btn_branch_paging" data-ship_to_id="{{ $itm->id }}" class="btn btn-outline-warning" href="#" >{{ $itm->ship_to_code }}</a>&nbsp;
            @endif
          @endif
        @endforeach
      </div>

      <div class="col-md-10">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">สินค้าสั่งประจำ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-more-tab" data-toggle="pill" href="#pills-more" role="tab" aria-controls="pills-more" aria-selected="false">สินค้าเพิ่มเติมจาก A-Best</a>
          </li>
        </ul >

        <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <!-- Table -->
          <div class="table-responsive">
            <table id="tbl_main" class="dataTable compact row-border hover" style="width: 100%" > 
                <thead>
                    <tr>
                        <th class="col_no" style="text-align: center;">ลำดับ</th>
                        <th class="col_name" style="width: 150px; text-align: center;">รายการ สินค้าสั่งประจำ</th>
                        <th class="col_uom" style="text-align: center;">หน่วย</th>
                        <th class="col_qty" style="text-align: center;">จำนวนสั่ง</th>
                        @if(Auth::user()->isOnlineStoreCustomer() && $order->status!= 5)
                        <th class="col_action" style="width: 1px; text-align: center;">#</th>
                        @endif
                    </tr>
                </thead>
                <tbody>  
                      @foreach($products as $key => $item)
                      <tr @if($item->product_category_id==1) class="table-success" @else class="table-warning" @endif /> 
                        <td style="color:{{(($key%2==1)?' green ':  ' blue ')}}">{{ ($key+1) }}</td>
                        <td style="color:{{(($key%2==1)?' green ':  ' blue ')}}">{{$item->product_name}}</td>
                        <td style="color:{{(($key%2==1)?' green ':  ' blue ')}}">{{$item->product_uom}}</td>
                        <td style="color:{{(($key%2==1)?' green ':  ' blue ')}}">
                          <input type="hidden" name="prds[]"  class="form-control" style="text-align: right;" value="{{ $item->product_id }}" />

                          @if($order->status<5)
                            @if($item->order_qty != 0)
                              <input type="number" min="0" step="0.1" name="qtys[]"  class="form-control" style="text-align: right;" value="{{ $item->order_qty }}" />
                            @else
                              <input type="number" min="0" step="0.1" name="qtys[]"  class="form-control" style="text-align: right;" value="0" />
                            @endif 
                          @else
                            <span>{{ $item->order_qty }}</span>
                          @endif
                        </td>
                        @if(Auth::user()->isOnlineStoreCustomer() && $order->status!= 5)
                        <td>
                          <a name="btn_item_del" class="btn btn-danger" data-product_name="{{$item->product_name}}" data-product_id="{{$item->product_id}}" /><i class="fa fa-trash"></i> ลบ</a>
                        </td>
                        @endif
                      </tr>
                      @endforeach

                </tbody>
            </table>
          </div>
          <!--/.table-responsive-->
        </div>
        <!--/.home-->

        <div class="tab-pane fade" id="pills-more" role="tabpanel" aria-labelledby="pills-more-tab">
          <!-- Table -->
          <div class="table-responsive">
            <table id="tbl_more" class="dataTable compact row-border" style="width: 100%" > 
                <thead>
                    <tr>
                        <th class="col_no" style="text-align: center;">ลำดับ</th>
                        <th class="col_name" style="width: 150px; text-align: center;">รายการ สินค้าเพิ่มเติมจาก A-Best</th>
                        <th class="col_uom" style="text-align: center;">หน่วย</th>
                        <th class="col_qty" style="text-align: center;">จำนวนสั่ง</th>
                    </tr>
                </thead>
                <tbody> 
                      @foreach($product_mores as $key => $item)
                      <tr @if($item->product_category_id==1) class="table-success" @else class="table-warning" @endif /> 
                        <td style="color:{{(($key%2==1)?' green ':  ' blue ')}}">{{ ($key+1) }}</td>
                        <td style="color:{{(($key%2==1)?' green ':  ' blue ')}}">{{$item->product_name}}</td>
                        <td style="color:{{(($key%2==1)?' green ':  ' blue ')}}">{{$item->product_uom}}</td>
                        <td style="color:{{(($key%2==1)?' green ':  ' blue ')}}">
                          <input type="hidden" name="more_prds[]"  class="form-control" style="text-align: right;" value="{{ $item->id }}" />

                          @if($order->status<5)
                            @if($item->order_qty != 0)
                              <input type="number" min="0" step="0.1" name="more_qtys[]"  class="form-control" style="text-align: right;" value="{{ $item->order_qty }}" />
                            @else
                              <input type="number" min="0" step="0.1" name="more_qtys[]"  class="form-control" style="text-align: right;" value="0" />
                            @endif 
                          @else
                            <span>{{ $item->order_qty }}</span>
                          @endif
                        </td>
                      </tr>
                      @endforeach
                      

                </tbody>
            </table>
          </div>
          <!--/.table-responsive-->
        </div>
        <!--/.menu1-->
        </div>
        <!--/.tab-content-->

      </div>
      <!--/.col-md-9-->
    </div>
    <!--/.row-->

      <div class="row">
        <div class="col-12 d-flex no-block align-items-center">

          <div class="ml-auto text-right">

        @if(Auth::user()->isOnlineStoreCustomer())
            @switch($order->status)
              @case(1) @case(2) @case(3)
           <!--    <a name="btn_save" id="btn_save" class="btn btn-primary rounded shadow text-white" > บันทึก</a> -->
              <button type="submit" name="btn_save" class="btn btn-primary rounded shadow" > บันทึก</button>
              @break
            @endswitch
        @endif
        <!-- <a href="#" name="btn_save_n_confirm" class="btn btn-primary rounded shadow" />Save & Confirm</a> -->
                
            </div>
        </div>
      </div>
      <!--/.row-->

    </form>
    <!--/frm1-->

  </div>
  <!--/.container-fluid-->
</section>





<!-- The Modal -->
<div class="modal" id="modal1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">...</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
		
		
      </div>
      <!--/.modal body -->

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
    <!--/. modal-content -->
  </div>
  <!--/. modal-dialog -->
</div>     
<!--/. The Modal -->    

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
    }
</style>




<link href="{{ asset('public/assets/libs/bootstrap-datepicker-custom-thai/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<script src="{{ asset('public/assets/libs/bootstrap-datepicker-custom-thai/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('public/assets/libs/bootstrap-datepicker-custom-thai/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>





<!-- Set default evaluator -->
<script type="text/javascript">

$(document).ready(function(){
    var isChanged = false;

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
    $('#issue_date').datepicker('setDate', '0');

  function datepickerToSqlDate(dateString){ // dateString = dd/mm/yyyy    
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

   $('#tbl_main').DataTable({
      searching: false,
      paging: false,
      info: false,
      fixedHeader: true,
      autoWidth: false,
        order: [[ 0, 'asc' ], [ 1, 'asc' ]],
        columnDefs: [
            {   targets: 'col_no',
                width: '50',
                className: 'dt-center',
                 render: function (data, type, row, meta) {
                var tmpHtml = meta.row+1;
                    return tmpHtml;
                 }
             },      
            {   targets: 'col_uom',
                width: '100',
                className: 'dt-center',
             },     
            {   targets: 'col_qty',
                width: '100',
                className: 'dt-center',
             },     
        ]
    });

   $('#tbl_more').DataTable({
      searching: false,
      paging: false,
      info: false,
      fixedHeader: true,
      autoWidth: false,
        order: [[ 0, 'asc' ], [ 1, 'asc' ]],
        columnDefs: [
            {   targets: 'col_no',
                width: '50',
                className: 'dt-center',
                 render: function (data, type, row, meta) {
                var tmpHtml = meta.row+1;
                    return tmpHtml;
                 }
             },      
            {   targets: 'col_uom',
                width: '100',
                className: 'dt-center',
             },     
            {   targets: 'col_qty',
                width: '100',
                className: 'dt-center',
             },     
        ]
    });

  function getOrder($shipto_id){
        var params = {};
        // console.table(params); return;
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });  
        tmpUrl = '{{ url("/online_store/orders/get") }}/{{ $order->id }}';
        $.ajax({
          url: tmpUrl,
          type: 'post', dataType:"json", data: {},
          success: function (res) { 
            if(res.success=="success"){
              setOrder(res.order);
              // getMainList();
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

    function setOrder(order){ 
      // console.log(order);
      $('input[name="order_id"]').val(order.id);
       var d = new Date(order.issue_date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

      if (month.length < 2) 
          month = '0' + month;
      if (day.length < 2) 
          day = '0' + day;
      $('input[name="issue_date"]').val([day, month, year].join('/'));
      $('input[name="cust_id"]').val(order.customer_id);
      $('input[name="cust_name"]').val(order.customer_name);
      $('input[name="ship_to_id"]').val(order.ship_to_id);
      $('input[name="ship_to_name"]').val(order.ship_to_name);



      // switch(res.header.status){
      //   case 0 : 
      //     $('p[name="status"]').text('Removed').removeClass('alert-*').addClass('alert-secondary');
      //     break;
      //   case 1 : 
      //     $('p[name="status"]').text('Begin').removeClass('alert-warning').removeClass('alert-success').addClass('alert-primary');
      //     break;
      //   case 2 : 
      //     $('p[name="status"]').text('Grading').removeClass('alert-primary').removeClass('alert-success').addClass('alert-warning');
      //     break;
      //   case 3 : 
      //     $('p[name="status"]').text('Graded').removeClass('alert-primary').removeClass('alert-warning').addClass('alert-success');
      //     break;
      //   default :
      // }
    } // getProduct

    $('#frm1').hide();
    getOrder();
    $('#frm1').fadeIn('slow');


   

    // var tbl_main; 
    // function getMainList(){  
    //     if ($.fn.DataTable.isDataTable('#tbl_main')) {    
    //   tbl_main.ajax.reload( null, false );
    //     }else{
    //     tmpUrl = "{{ url('/production/produces/get-item-list') }}"+"/"+{{ $order->id }};
    //     tbl_main = $('#tbl_main').DataTable( {
    //             searching: false,
    //             paging: false,
    //             info: false,
    //             fixedHeader: true,
    //             ajax: {
    //                 type: 'GET',
    //                 url: tmpUrl,
    //                 data: {},
    //                 dataSrc: 'items',
    //             },
    //             autoWidth: false,
    //             order: [[ 0, 'asc' ], [ 1, 'asc' ]],
    //             columnDefs: [
    //                 {   targets: 'col_no',
    //                     width: '50',
    //                     className: 'dt-center',
    //                      render: function (data, type, row, meta) {
    //              var tmpHtml = meta.row+1;
    //                         return tmpHtml;
    //                      }
    //                  },
    //                 {   targets: 'col_name',
    //                     width: '300',
    //                     className: 'dt-center',
    //                  },
    //                 {   targets: 'col_uom',
    //                     width: '100',
    //                     className: 'dt-center',
    //                  },
    //                 {   targets: 'col_qty',
    //                     className: 'dt-center',
    //                  },        
    //             ]
    //         } );
    //     }    
    // } //.getMainList()



  // $('a[name="btn_create"]').click(function(e){  
  //     var params = {};
  // var tmp = $('#frm1').serialize();
  // params = tmp;
  //   console.log(params);
  //     $.ajaxSetup({
  //         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  //     }); 
  //     $.ajax({
  //       url: "{{ url('/production/sends/create') }}",
  //       type: 'post', dataType:"json", data: params,
  //       success: function (res) { console.log(res);
  //           if(res.success=="success"){
  //       alert(res.msg);
  //           tmpUrl = '{{ url("/production/sends/view-edit") }}'+'/'+res.header.id;
  //               location = tmpUrl;
  //           }else{
  //       console.log(res.items);
  //               alert(res.msg);
  //           } 
  //       },
  //       error: function(xhr, status, error) {
  //         console.log(xhr);
  //         var err = eval("(" + xhr.responseText + ")");
  //         alert(JSON.parse(xhr.responseText).message);
  //       }
  //     }); // /.ajax   
  //   }); // click
  $('#frm1').submit(function(e){ 
    e.preventDefault(); // For Form Valid and not use default href link

    var params = {};
      var tmp = $('#frm1').serialize();
      // $.each($('input[name="ref_ids[]"]'), function(){
      //   tmp=tmp+'&'+$(this).serialize();
      // });
      params = tmp; 
      console.log(params); 
      // return;
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      }); 
      $.ajax({
        url: "{{ url('/online_store/orders/edit-items') }}",
        type: 'post', dataType:"json", data: params,
        success: function (res) { console.log(res);
          alert(res.msg);
            if(res.success=="success"){
              tmpUrl = '{{ url("/online_store/orders/view-edit") }}/'+res.id;
                location = tmpUrl;
            }else{
            console.log(res.items);
                //alert(res.msg);
            } 
        },
        error: function(xhr, status, error) {
          console.log(xhr);
          var err = eval("(" + xhr.responseText + ")");
          alert(JSON.parse(xhr.responseText).message);
        }
      }); // /.ajax   
  }); // click

    $('a[name="btn_branch_paging"]').click(function(e){        
      var date = $('input[name="issue_date"]').val();    
      date = datepickerToSqlDate(date);
      var cust_id = $('input[name="cust_id"]').val();
      var ship_to_id = $(this).attr('data-ship_to_id');
      tmpUrl = '{{ url("/online_store/orders/view-date_cust_ship_edit") }}/'+date+'/'+cust_id+'/'+ship_to_id;
      if(isChanged){
        // alert('confirm');
        if(confirm("คุณต้องการเปลี่ยนหน้าโดยไม่บันทึกรายการที่แก้ไข ใช่หรือไม่")){
                location = tmpUrl;
        } // Confirm
      }else{
        location = tmpUrl;
      } // ifChanged      
    }); // click

    $('input[name="qtys[]"]').click(function(e){ 
      $(this).select();
    }); //. $('a[name=btnSearchEvaluator]').click(function(){

    $('input[name="qtys[]"]').keyup(function(e){ 
      // alert('qtys[]');
      var code = e.which; // recommended to use e.which, it's normalized across browsers
      isChanged = true;
      // var code = e.which; // recommended to use e.which, it's normalized across browsers
      // if(code==13) {        
      //   $('input[name="query_product_code"]').val($(this).val());
      //   $('#modalProduct').modal('show');   
      //   getProductList(); 
      // }
    }); //. $('a[name=btnSearchEvaluator]').click(function(){

    $('input[name="more_qtys[]"]').click(function(e){ 
      $(this).select();
    }); //. $('a[name=btnSearchEvaluator]').click(function(){

      // 
    $('a[name="btn_item_del"]').click(function(e){       
      var ele_temp = $(this); 
      if(confirm("คุณต้องการที่จะลบรายการ\n\n"+ele_temp.attr('data-product_name')+"\n\nและนำออกจากรายการสั่งสินค้าตั้งต้น ใช่หรือไม่ ? ")){

        var params = {};
        var tmp = $('#frm1').serialize();
        params = tmp; 
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }); 
        var tmpUrl = "{{ url('/online_store/orders/remove-item') }}/"+{{$order->id}}+"/"+ele_temp.attr('data-product_id');
        alert(tmpUrl);
        $.ajax({
          url: tmpUrl,
          type: 'post', dataType:"json", data: params,
          success: function (res) { 
            // console.log(res);
            if(res.success=="success"){
              $('#divFlashAlert').append('<div class="alert alert-success alert-block col-md-12">'+
                  '<button type="button" class="close" data-dismiss="alert">×</button>'+ 
                      '<strong>'+'test'+'</strong>'+
              '</div>'); 
              $('#divFlashAlert').children('div:last').delay(1000).fadeOut('slow');  
              ele_temp.closest('tr').fadeOut('slow').remove(); 
            }else{
              $('#divFlashAlert').append('<div class="alert alert-danger alert-block col-md-12">'+
                  '<button type="button" class="close" data-dismiss="alert">×</button>'+ 
                      '<strong>'+res.msg+'</strong>'+
              '</div>'); 
              // $('#divFlashAlert').children('div:last').delay(5000).fadeOut('slow'); 
            } 
          },
          error: function(xhr, status, error) {
            console.log(xhr);
            var err = eval("(" + xhr.responseText + ")");
            alert(JSON.parse(xhr.responseText).message);
            }
          }); // /.ajax  
        } // if
      }); // click
});



  // Set the date we're counting down to
  // var countDownDate = new Date("August 2, 2020 08:29:00");
  var countDownDate = new Date();
  countDownDate.setHours(16);
  countDownDate.setMinutes(30);

  // countDownDate.setDate(countDownDate.getDate() + 30);

  // Update the count down every 1 second
  var x = setInterval(function () {

    // Get todays date and time
    var now = new Date().getTime();

    // Find the distance between now an the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById("time-counter").innerHTML = hours + " ช.ม. " + minutes + " น. " + seconds + " ";

    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("time-counter").innerHTML = "เกินเวลาที่สามารถปรับปรุงรายการสั่งสินค้าได้";      
      document.getElementById("btn_save").remove();
    }
  }, 1000);

</script>



@endsection





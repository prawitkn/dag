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
      <li class="breadcrumb-item active"> สั่งสินค้า</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->
<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="display">สั่งสินค้า 
      </h1>

      <form id="frm1" >

        <div class="row">
        <div class="form-group col-md-3">
          <div class="form-group-material">
            <input  type="text" name="issue_date" required class="input-material datepicker" data-format="yyyy-mm-dd" placeholder="">
            <label for="issue_date" class="label-material active">วันที่</label>
          </div>
          <!--/.form-group-material-->
        </div>
        <!--/.col-->

        <div class="form-group col-md-3" style="display: none;">
          <div class="form-group-material">
            <input  type="text" name="due_date" required class="input-material datepicker" data-format="yyyy-mm-dd" placeholder="">
            <label for="due_date" class="label-material active">ส่งวันที่</label>
          </div>
          <!--/.form-group-material-->
        </div>
        <!--/.col-->
      </div>
      <!--/.row-->

    </header>
    <!-- Page Header-->

    <!-- Table -->
<!--       <div class="table-responsive">
        <table id="tbl_main" class="dataTable compact row-border hover" style="width: 100%" > 
            <thead>
                <tr>
                    <th class="col_barcode" style="width: 150px; text-align: center;">รายการ</th>
                    <th class="col_net_weight" style="text-align: center;">หน่วย</th>
                    @foreach($ship_tos as $key => $itm)
                      <th class="col_ship_to_{{$key}}" style="text-align: center;">{{$itm->ship_to_code}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody> 
                  @foreach($products as $key => $item)
                  <tr>
                    <td style="width: 150px; color:{{(($key%2)?' green ':  ' blue ')}}">{{$item->product_name}}</td>
                    <td style="color:{{(($key%2)?' green ':  ' blue ')}}">{{$item->product_uom}}</td>
                    @foreach($ship_tos as $key2 => $itm)
                      <td class="col_ship_to_{{$key2}}" style="text-align: center;">
                        <input type="text" class="form-control" name="qtys[]" style="text-align: right; color:{{(($key%2)?' green ':  ' blue ')}}" 
                        ref-pid="{{$item->id}}" ref-stid="{{$itm->ship_to_id}}" 
                        value="0" />
                      </td>
                    @endforeach
                  </tr>
                  @endforeach
            </tbody>
        </table>
      </div> -->
      <!--/.table-responsive-->

      <div class="row">
        <div class="col-12 d-flex no-block align-items-center">

          <div class="ml-auto text-right">
        
        <a name="btn_save" class="btn btn-primary shadow rounded" > Save</a>
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
        line-height: 1 !important;
    }
  table.dataTable.compact tbody tr { height: 20px; }
</style>




<link href="{{ asset('public/assets/libs/bootstrap-datepicker-custom-thai/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<script src="{{ asset('public/assets/libs/bootstrap-datepicker-custom-thai/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('public/assets/libs/bootstrap-datepicker-custom-thai/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>





<!-- Set default evaluator -->
<script type="text/javascript">

$(document).ready(function(){
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
    $('#due_date').datepicker('setDate', '1');

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

  $('input.datepicker').keypress(function(e){ 
    e.preventDefault(); 
  }); //. $('a[name=btnSearchEvaluator]').click(function(){ 

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

    $('a[name="btn_save"]').click(function(e){  
      var params = {};
      var tmp = $('#frm1').serialize();
      // $.each($('input[name="ref_ids[]"]'), function(){
      //   tmp=tmp+'&'+$(this).serialize();
      // });
      // $.each($('input[name="qtys[]"]'), function(){
      //   tmp=tmp+'&'+$(this).serialize();
      // });
      params = tmp; 
      console.log(params); 
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      }); 
      $.ajax({
        url: "{{ url('/online_store/orders/create') }}",
        type: 'post', dataType:"json", data: params,
        success: function (res) { console.log(res);
          alert(res.msg);
            if(res.success=="success"){
            tmpUrl = '{{ url("/online_store/orders/view-list") }}';
                location = tmpUrl;
            }else{
          console.log(res.items);
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





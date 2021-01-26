@extends('layouts.ossLayout.design')

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
      <li class="breadcrumb-item active"> บริการศูนย์บริการแบบเบ็ดเสร็จของ บก.ทท.</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="display">รายงาน
      </h1>

    </header>
    <!-- Page Header-->
    <div class="row">
      <div class="col-md-12">

    <div class="card">
        <form id="frm1" method="GET">
        <div class="card-body">

          <input type="hidden" id="id" value="" />
        
            <div class="row">
              <div class="form-group col-md-2">
                <div class="form-group-material">
                  <input  type="text" name="issue_date_from" required class="input-material datepicker" data-format="yyyy-mm-dd" placeholder="">
                  <label for="issue_date_from" class="label-material active">จากวันที่</label>
                </div>
                <!--/.form-group-material-->
              </div>
              <!--/.col-->

              <div class="form-group col-md-2">
                <div class="form-group-material">
                  <input  type="text" name="issue_date_to" required class="input-material datepicker" data-format="yyyy-mm-dd" placeholder="">
                  <label for="issue_date_to" class="label-material active">ถึงวันที่</label>
                </div>
                <!--/.form-group-material-->
              </div>
              <!--/.col-->

              <div class="col-md-2">
                <a name="btn_submit" class="btn btn-primary rounded shadow" > เรียกดูข้อมูล</a>
              </div>
            </div><!--/row-->


        <div class="row">
            <!-- <button type="submit" class="btn btn-primary rounded shadow" > เรียกดูข้อมูล</button> -->
            
        </div>
        <!--/.row-->

          <div class="row">
            <div class="col-md-12">

            <div class="table-responsive">
            <table id="tbl_main" class="hover compact" style="width: 100%;"   >
                <thead>
                    <tr>
                        <th class="col_no" style="text-align: center;" >ลำดับ</th>
                        <th class="col_name" style="text-align: center;" >ประเภทการให้บริการ</th>
                        <th class="col_org" style="text-align: center;" >เรื่องที่บริการ</th>
                        <th class="col_action" style="text-align: center;" >จำนวน</th>
                    </tr>
                </thead>
            </table>
            </div>    
          <!--/.table-responsive-->
          </div>
          <!--/.col-->
        </div>
        <!--/.row-->

          <div class="card-footer">
            <div class="col-12 d-flex no-block align-items-center">
             <!--  <a href="#" name="btn_excel" class="btn btn-primary rounded shadow" /> นำออกข้อมูล (.xlsx)</a> -->
              <a href="#" name="btn_pdf" class="btn btn-primary rounded shadow" /> นำออกข้อมูล (.pdf)</a>
                <div class="ml-auto text-right">
        <!--     <a href="#" name="btn_clear" class="btn btn-secondary rounded shadow" /> ล้างข้อมุล</a>
            <button type="submit" name="btn_create" class="btn btn-primary shadow rounded" > บันทึก</button> -->
            <!-- <a href="#" name="btn_save_n_confirm" class="btn btn-primary rounded shadow" />Save & Confirm</a> -->
                    
                </div>
            </div>
          </div>
          <!--/.card-footer-->
        </div>
        <!--/.card-body-->

       
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

  function formClear(){
    $('input[name="customer_name"]').val('');

    $('input[name="customer_name"]').select();
  }
  
  formClear();

    $('a[name="btn_clear"]').click(function(e){  
      formClear();
    }); // click

  var tbl_main; // = $('#table').DataTable();
  function getList(){
      if ($.fn.DataTable.isDataTable('#tbl_main')) {
          tbl_main.ajax.reload( null, false );
      }else{
          tbl_main = $('#tbl_main').DataTable( {
              searching: false,
              paging: false,
              info: false,
              fixedHeader: true,
              ajax: {
                  type: 'GET',
                  url: "{{ url('oss/service-data/get-report_summary') }}",
                  data: {
                    issue_date_from: function() { return $('input[name="issue_date_from"]').val() },
                    issue_date_to: function() { return $('input[name="issue_date_to"]').val() },
                  },
                  dataSrc: 'items',
              },
              autoWidth: false,
              columns: [
                  { data: null },
                  { data: 'service_type_name' },
                  { data: 'service_topic_name' },
                  { data: 'service_count' },
              ], 
              columnDefs: [
                  {   targets: 'col_no',
                      width: 20,
                      className: 'dt-center',
                       render: function (data, type, row, meta) {
                          var tmp = meta.row+1;
                          return tmp;
                       }
                   }, 
                  {   targets: 'col_name',
                      width: 500,
                      className: 'dt-center',
                   }, 
                  {   targets: 'col_name',
                      width: 500,
                      className: 'dt-center',
                   }, 
              ]
          } );
      }    
      // $('#tbl_main').fadeIn('slow');
  } //.getList()

  $('a[name="btn_submit"').on('click', function() { 
    getList();
    });

  // $('#frm1').submit(function(e){ 
  //   e.preventDefault(); // For Form Valid and not use default href link

  //   var params = {};
  //   var tmp = $('#frm1').serialize();
  //   params = tmp;
  //   console.log(params);
  //   $.ajaxSetup({
  //     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  //   }); 
  //   $.ajax({
  //     url: "{{ url('/oss/service-data/') }}",
  //     type: 'post', dataType:"json", data: params,
  //     success: function (res) { console.log(res);
  //       if(res.success=="success"){
  //         alert(res.msg);
  //         formClear();
  //       }else{
  //         alert(res.msg);
  //       } 
  //     },
  //     error: function(xhr, status, error) {
  //       console.log(xhr);
  //       var err = eval("(" + xhr.responseText + ")");
  //       alert(JSON.parse(xhr.responseText).message);
  //     }
  //   }); // /.ajax   
  // }); // click

  $('select[name="service_type_name"]').on('change', function() { 
      // alert($(this).val());
      $('input[name="service_type_id"]').val($(this).val());
      var params = {};
    // var tmp = $('#frm1').serialize();
    // // $.each($('input[name="reference_item_ids[]"]'), function(){
    // //  tmp=tmp+'&'+$(this).serialize();
    // // });    
    // params = tmp;
    params = {
      service_type_id: $('input[name="service_type_id"]').val(),
    };

      console.log(params);
      // return;
        $('select[name="service_topic_name"]').empty().append('<option value=""> - หัวข้อการให้บริการ - </option>');
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }); 
        $.ajax({
          url: "{{ url('/oss/service_topics/list-by-service_type') }}",
          type: 'get', dataType:"json", data: params,
          success: function (res) { 
              console.log(res);
              if(res.success=="success"){
                $.each(res.items, function( index, value ) {
                  // alert( index + ": " + value );
                  $('select[name="service_topic_name"]').append('<option value="'+value['id']+'">'+value['service_topic_name']+'</option>');
                });
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

      if($(this).val()!=""){
        // getList();
      }
    });

     $('select[name="service_topic_name"]').on('change', function() { 
      // alert($(this).val());
      $('input[name="service_topic_id"]').val($(this).val());
    });

    $('a[name="btn_pdf"]').click(function(e){
      window.open( "{{ url('oss/service-data/get-report_summary_pdf') }}" + '?' + $('#frm1').serialize(), 'Blank' );
    });
});

</script>



@endsection





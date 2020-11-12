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
      <li class="breadcrumb-item active"><a href="index.html">Home</a></li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="display">รายการสั่งสินค้า   
      </h1>

      <form id="frm1" >

    </header>
    <!-- Page Header-->
      <h3>ลูกค้า : {{$customer->customer_name}}xxx</h3>
    <!-- Table -->
      <div class="table-responsive">
        <table id="tbl_main" class="dataTable compact row-border hover" style="width: 100%" > 
            <thead>
                <tr>
                    <th class="col_no" style="width: 150px; text-align: center;">ลำดับ</th>
                    <th class="col_issue_date" style="text-align: center;">วันที่สั่ง</th>
                    <th class="col_created_by_name" style="text-align: center;">ผู้สั่ง</th>
                    <th class="col_status" style="text-align: center;">สถานะ</th>
                    <th class="col_action" style="text-align: center;">การปฏิบัติ</th>
                </tr>
            </thead>
            <tbody> 

            </tbody>
        </table>
      </div>
      <!--/.table-responsive-->

      <div class="row">
        <div class="col-12 d-flex no-block align-items-center">

          <div class="ml-auto text-right">
        
        <!-- <a name="btn_save" class="btn btn-primary shadow rounded" > Save</a> -->
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
    $('#issue_date').datepicker('setDate', '0');
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


  var tbl_main; 
    function getMainList(){  
        if ($.fn.DataTable.isDataTable('#tbl_main')) {    
      tbl_main.ajax.reload( null, false );
        }else{
        tmpId = $('#id').val(); 
        tmpUrl = "{{ url('/online_store/orders/view-list') }}";
        tbl_main = $('#tbl_main').DataTable( {
        searching: false,
        paging: false,
        info: false,
        fixedHeader: true,
        ajax: {
            url: tmpUrl,
            type: 'GET',
            dataType:"json",
            data: {},
            dataSrc: 'items',
        },
        autoWidth: false,
        columns: [               
            { data: null },        
            { data: 'issue_date' },       
            { data: 'created_by_name' },    
            { data: null },  
            { data: null },      
        ],
        order: [[ 2, 'desc' ], [ 1, 'asc' ]],
        columnDefs: [
        {   targets: 'col_no',
            width: '50',
            className: 'dt-center',
             render: function (data, type, row, meta) {
              var tmpHtml = meta.row;
                return tmpHtml;
             }
         },          
         {   targets: 'col_status',
              width: '50',
              className: 'dt-center',
               render: function (data, type, row, meta) {
              var tmpHtml = '';
              switch(row.status){
                case 1 : tmpHtml='เริ่มต้น'; break;
                case 2 : tmpHtml='ยืนยัน'; break;
                default : tmpHtml='N/A'; 
              }
              return tmpHtml;
             }
           },      
           {   targets: 'col_action',
                className: 'dt-center',
               render: function (data, type, row, meta) {
              var tmp = '';
              tmp = '<a name="btn_item_remove" class="btn btn-primary rounded shadow btn-sm" ref-id="'+row.id+'" /> view</a>';
                          return tmp;
                   }
           },                    
        ]
      });
      }    
  } //.getMainList()

  getMainList();

});



</script>



@endsection





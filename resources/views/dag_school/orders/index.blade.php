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
      <h1 class="display">รายการสั่งสินค้า 
        @if(Auth::user()->isOnlineStoreCustomer())
      &nbsp;<a href="{{ url('online_store/orders/view-new') }}" class="btn btn-secondary shadow rounded" name="" onclick="window.close();"  /> สั่งสินค้าใหม่</a>  
      @endif   
      </h1>

      <form id="frm1" >

    </header>
    <!-- Page Header-->
     <div class="row">

        <div class="form-group col-md-2">
          <div class="form-group-material">
            <input  type="text" name="issue_date" id="issue_date" required class="input-material datepicker" data-format="yyyy-mm-dd" placeholder="">
            <label for="issue_date" class="label-material active">วันที่</label>
          </div>
          <!--/.form-group-material-->
        </div>
        <!--/.col-->

<!--         <div class="form-group col-md-3">          
          <button type="submit" class="btn btn-primary shadow rounded" > ค้นหา</button>
        </div> -->
        <!--/.col-->

      </div>
      <!--/.row-->
      
    <!-- Table -->
      <div class="table-responsive">
        <table id="tbl_main" class="dataTable compact row-border hover" style="width: 100%" > 
            <thead>
                <tr>
                    <th class="col_no" style="width: 150px; text-align: center;">ลำดับ</th>
                    <th class="col_issue_date" style="text-align: center;">วันที่สั่ง</th>
                    <th class="col_ship_to" style="text-align: center;">ร้าน / สาขา</th>
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
    @if(request()->issue_date)
      var queryDate = '{{ request()->issue_date }}',
      dateParts = queryDate.match(/(\d+)/g)
      realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]); 
      $('.datepicker').datepicker('setDate', queryDate);
    @else
      $('.datepicker').datepicker('setDate', '0'); 
    @endif

    $('input.datepicker').keypress(function(e){ 
      e.preventDefault(); 
    }); //. $('a[name=btnSearchEvaluator]').click(function(){ 

     $('#issue_date').change(function(e){ 
        getMainList();
    }); //. $('a[name=btnSearchEvaluator]').click(function(){  
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

  function setData(){
    alert('abc');

  }



  var tbl_main; 
    function getMainList(){  
        if ($.fn.DataTable.isDataTable('#tbl_main')) {    
      tbl_main.ajax.reload( null, false );
        }else{
        tmpId = $('#id').val(); 
        tmpUrl = "{{ url('/online_store/orders/list') }}";
        tbl_main = $('#tbl_main').DataTable( {
        searching: false,
        paging: false,
        info: false,
        fixedHeader: true,
        ajax: {
            url: tmpUrl,
            type: 'GET',
            dataType:"json",
            data: {
              issue_date: function() { return $('#issue_date').val() },
            },
            dataSrc: 'items',
        },
        autoWidth: false,
        columns: [               
            { data: null },        
            { data: 'issue_date' },       
            { data: 'ship_to_name' },     
            { data: 'created_by_name' },    
            { data: null },  
            { data: null },      
        ],
        order: [[ 1, 'desc' ], [ 2, 'asc' ]],
        columnDefs: [
        {   targets: 'col_no',
            width: '50',
            className: 'dt-center',
             render: function (data, type, row, meta) {
              var tmpHtml = meta.row+1;
                return tmpHtml;
             }
         },          
        {   targets: 'col_issue_date',
            width: '100',
            className: 'dt-center',
             render: function (data, type, row, meta) {
              var tmpHtml = '';
              if((row.issue_date !== null)){

                  const d = new Date(row.issue_date);
                  const year = d.getFullYear(); // 2019
                  const date = d.getDate(); // 23
                  const months = [
                    'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'
                  ];
                  const monthName = months[d.getMonth()]; // Jan
                  const days = [
                    'Sun','Mon','Tue','Wed','Thu','Fri','Sat'
                  ];
                  const dayName = days[d.getDay()] // Thu
                  const formatted = `${date} ${monthName} ${year}` // M d Y;

                  
                  tmpHtml = '<label style="display:none; ">'+row.issue_date+'</label>'+
                  formatted;
              }
              return tmpHtml;
             }
         },       
        {   targets: 'col_ship_to',
            className: 'dt-center',
         },          
         {   targets: 'col_status',
              width: '100',
              className: 'dt-center',
               render: function (data, type, row, meta) {
              var tmpHtml = '';

              switch(row.status){
                case 1 : 
                    tmpHtml='<p class="badge badge-pill badge-warning">ยังไม่บันทึกการสั่ง</p>';
                    break;
                case 2 : 
                  var d = new Date(row.updated_at),
                  hour = '' + d.getHours(),
                  min = '' + d.getMinutes();

                  if (hour.length < 2) 
                      hour = '0' + hour;
                  if (min.length < 2) 
                      min = '0' + min;
                    //
                    tmpHtml='<p class="badge badge-pill badge-success">บันทึกการสั่ง ('+[hour, min].join(':')+')</p>';
                    break;
                case 1 : 
                    tmpHtml='<p class="badge badge-pill badge-info">เปิดให้แก้ไขรายการสั่งสินค้า</p>';
                    break;
                case 5 : 
                    tmpHtml='<p class="badge badge-pill badge-secondary">เรียบร้อย</p>';
                    break;
                default : tmpHtml='N/A'; 
              }
              return tmpHtml;
             }
           },      
           {   targets: 'col_action',
                className: 'dt-center',
               render: function (data, type, row, meta) {
              var tmp = '';
              switch(row.status){
                  case 5 : tmp = '<a name="btn_item_remove" target="_blank" href="{{ url("online_store/order/") }}/'+row.id+'" class="btn btn-primary rounded shadow btn-sm" ref-id="'+row.id+'" /> แสดง</a>';
                      break;
                  default :  
                  tmp = '<a name="btn_item_remove" target="_blank" href="{{ url("online_store/orders/view-edit") }}/'+row.id+'" class="btn btn-primary rounded shadow btn-sm" ref-id="'+row.id+'" /> แสดง</a>';
                }
             
                          return tmp;
                   }
           },                    
        ]
      });
      }    
  } //.getMainList()

  getMainList();

  $(window).on('focus', function() { 
      getMainList(); 
  });
  
});



</script>



@endsection





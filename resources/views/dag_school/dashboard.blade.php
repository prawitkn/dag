@extends('layouts.dagSchoolLayout.design')
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
      <li class="breadcrumb-item active"><a href="{{ url('online_store') }}">หน้าแรก</a></li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">

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

    $('#issue_date').keypress(function(e){ 
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


  var tbl_main; 
    function getMainList(){  
        if ($.fn.DataTable.isDataTable('#tbl_main')) {    
      tbl_main.ajax.reload( null, false );
        }else{
        tmpId = $('#id').val(); 
        tmpUrl = "{{ url('/online_store/orders/list-total-by-customer') }}";
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
            { data: 'customer_name' },     
            { data: 'updated_ship_to' },     
            { data: 'total_ship_to' },     
            { data: null },      
        ],
        order: [[ 1, 'asc' ], [ 3, 'asc' ]],
        columnDefs: [
        {   targets: 'col_no',
            width: '50',
            className: 'dt-center',
             render: function (data, type, row, meta) {
              var tmpHtml = meta.row+1;
                return tmpHtml;
             }
         },      
        {   targets: 'col_updated',
            width: '100',
            className: 'dt-center',
         },    
        {   targets: 'col_total',
            width: '100',
            className: 'dt-center',
         },    
           {   targets: 'col_action',
                className: 'dt-center',
               render: function (data, type, row, meta) {
              var tmp = '';
              var tmpDate = $('#issue_date').val();
               tmp = '<a name="btn_item_remove" target="_blank" href="{{ url("online_store/orders/view-list") }}?issue_date='+tmpDate+'&user_id='+row.id+'" class="btn btn-primary rounded shadow btn-sm"  /> แสดง</a>';
                    return tmp;
             }
           },                    
        ]
      });
      }    
  } //.getMainList()

  getMainList();

  function listByCustomer($issue_date, $user_id){
     tmpUrl = '{{ url("/production/online_store/orders/view-list") }}'+'?user_idl='+$user_id;
     location = tmpUrl;
  } 

  $('a[name="btn_export"]').click(function(e){        
      var date = $('input[name="issue_date"]').val();    
      // date = datepickerToSqlDate(date);

      tmpUrl = '{{ url('online_store/orders/export-excel') }}?'+date;
      location = tmpUrl; 
    }); // click

  $('a[name="btn_end"]').click(function(e){        
    if(confirm("คุณต้องการที่จะปิดเวลาสามารถการสั่งสินค้าใช่หรือไม่ ? ")){
      var params = {};
      var tmp = $('#frm1').serialize();
      params = tmp; 
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      }); 
      $.ajax({
        url: "{{ url('/online_store/orders/end') }}",
        type: 'post', dataType:"json", data: params,
        success: function (res) { 
          // console.log(res);
          if(res.success=="success"){
            $('#divFlashAlert').append('<div class="alert alert-success alert-block col-md-12">'+
                '<button type="button" class="close" data-dismiss="alert">×</button>'+ 
                    '<strong>'+res.msg+'</strong>'+
            '</div>'); 
            $('#divFlashAlert').children('div:last').delay(1000).fadeOut('slow');   
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



</script>



@endsection





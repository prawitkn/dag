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
      <li class="breadcrumb-item active"><a href="index.html">หน้าแรก</a></li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
     @if(Session::has('flash_message_error'))
          <div class="alert alert-danger alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{!! session('flash_message_error') !!}</strong>
          </div>
      @endif
      
      @if(Session::has('flash_message_success'))
          <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{!! session('flash_message_success') !!}</strong>
          </div>
      @endif


    <!-- Page Header-->
    <header> 
      <h3 class="display">รายงาน
      </h3>
      

    </header>
    <!-- Page Header-->

      <form id="frm1">
    <div class="row">
      <div class="col-md-12">
        <select name="program_class_name" class="form-control">
          <option value=""> - Select - </option>
          @foreach($program_classes as $val)
            <option value="{{$val->id}}">{{$val->program_class_name}}</option>
          @endforeach
        </select>
        <input type="hidden" name="program_class_id" value="" />
      </div>
    </div>
    </form>

     <!-- Table -->
      <div class="table-responsive">
        <table id="table_main" class="compact row-border hover" style="width: 100%" > 
            <thead>
                <tr>
                    <th class="col_no" style="text-align: center;">เลขที่</th>
                    <th class="col_img" style="text-align: center;">รูปภาพ</th>
                    <th class="col_name" style="text-align: center;">ยศ ชื่อ นามสกุล</th>
                    <th class="col_org" style="text-align: center;">หน่วย</th>
                    <th class="col_score" style="text-align: center;">คะแนน</th>
                </tr>
            </thead>
            <tbody> 
          
            </tbody>
        </table>
      </div>
      <!--/.table-responsive-->
      <footer>
          &nbsp;<a target="_blank" name="btn_pdf" class="btn btn-sm btn-primary shadow rounded text-white" > นำออก PDF</a>
          &nbsp;<a target="_blank" name="btn_certificate" class="btn btn-sm btn-primary shadow rounded text-white" > ใบประกาศ</a>
          &nbsp;<a target="_blank" name="btn_view" class="btn btn-sm btn-primary shadow rounded text-white" > View Public</a>
      </footer>
  </div>
  <!--/.container-fluid-->
</section>





<!-- The Modal -->
<div class="modal" id="modal1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Welcome</h4>
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
</style>

<!-- Set default evaluator -->
<script type="text/javascript">

$(document).ready(function(){
  function number_format (number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

    var table_main; // = $('#table').DataTable();
    function getList(){ //alert('big');
        if ($.fn.DataTable.isDataTable('#table_main')) {
            table_main.ajax.reload( null, false );
        }else{
            table_main = $('#table_main').DataTable( {
                searching: false,
                paging: false,
                info: false,
                autoWidth: false,
                fixedHeader: true,
                ajax: {
                    type: 'GET',
                  url: "{{ url('/dag_school/reports/get-student_summary_list_by_class_id') }}",
                    data: {
                        program_class_id: function() { return $('input[name="program_class_id"]').val() },
                    },
                    dataSrc: 'items',
                },
                autoWidth: false,
                columns: [       
                    { data: null },
                    { data: null },
                    { data: 'student_name' },
                    { data: 'org_name' },
                    { data: null },
                ],                
        columnDefs: [                     
                     {   targets: 'col_no',
                      width: 20,
                        className: 'dt-center',
                         render: function (data, type, row, meta) {
                            return meta.row+1;
                         }
                     },    
                     {   targets: 'col_img',
                        width: 50,
                        className: 'dt-center',
                         render: function (data, type, row, meta) {
                          var file = "{{ url('storage/app/dag_school/photos/students') }}"+'/'+row.student_id+'.jpg';
                          var tmp = '<div style="background-image: url('+file+')" class="media-object avatar avatar-md mr-3"></div>';
                            return tmp;
                         }
                     },     
                     {   targets: 'col_score',
                        width: 100,
                        className: 'dt-center',
                         render: function (data, type, row, meta) {
                            return number_format(row.net_score*100,2,'.',',');
                         }
                     },    
                ]
            } );
        }    
    } //.getList()

    getList();

  $('select[name="program_class_name"]').change(function(e){ 
      $('input[name="program_class_id"]').val($('select[name="program_class_name"] option').filter(":selected").val());  
    getList();
  }); // change

  $('a[name="btn_pdf"]').click(function(){
      window.open( "{{ url('dag_school/reports/student-summary-pdf') }}" + '?type=date&' + $('#frm1').serialize(), 'Blank' );
  });

  $('a[name="btn_certificate"]').click(function(){
      window.open( "{{ url('dag_school/reports/student-certificate-pdf') }}" + '?type=date&' + $('#frm1').serialize(), 'Blank' );
  });
  
  $('a[name="btn_view"]').click(function(){
      window.open( "{{ url('dag_school/program_class') }}" + '/'+$('input[name="program_class_id"]').val(), 'Blank' );
  });
});
</script>



@endsection





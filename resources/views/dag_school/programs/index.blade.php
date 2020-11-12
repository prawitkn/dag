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
      <li class="breadcrumb-item"><a href="{{ url('/online_store') }}">หน้าแรก</a></li>
      <li class="breadcrumb-item active">หลักสูตรการศึกษา</li>
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
      <h1 class="display">รายการหลักสูตรการศึกษา
	 <!--  &nbsp;<a href="{{ url('online_store/customers/new') }}" class="btn btn-primary shadow rounded" name="btn_add" /> เพิ่ม</a> -->
      </h1>
      

    </header>
    <!-- Page Header-->
    <div class="row">
      <div class="col-md-12">

	    <div class="table-responsive">
	    <table id="tbl_main" class="hover compact" style="width: 100%;"   >
	        <thead>
	            <tr>
	                <th class="col_no" style="text-align: center;" >ลำดับ</th>
                  <th class="col_name" style="text-align: center;" >ชื่อหลักสูตรการศึกษา</th>
	                <th class="col_status" style="text-align: center;" >สถานะ</th>
	                <th class="col_action" style="text-align: center;" >การปฏิบัติ</th>
	            </tr>
	        </thead>
	    </table>
	    </div>    
		<!--/.table-responsive-->
	  </div>
	</div>
@endsection   





@section('footer')
<style type="text/css">
    pre { font-size: 18px; }

    @media (min-width: 768px) {
      .modal-xl {
        width: 90%;
       max-width:1200px;
      }
    }
    table tbody td { padding: 0px !important; }
</style>

<script type="text/javascript">
$(document).ready(function(){
      

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
                    url: "{{ url('dag_school/programs/list') }}",
                    dataSrc: 'items',
                },
                autoWidth: false,
                columns: [
                    { data: null },
                    { data: 'program_name' },
                    { data: null },
                    { data: null }
                ],
                columnDefs: [
                    {   targets: 'col_no',
                        width: 20,
                        className: 'dt-center',
                         render: function (data, type, row, meta) {
                            return meta.row+1;
                         }
                     }, 
                     {   targets: 'col_status',
                        width: 10,
                        className: 'dt-center',
                         render: function (data, type, row, meta) {
                            return row.status==1 ? '<span class="badge badge-success">ใช้งาน</span>' : '<span class="badge badge-danger">ไม่ใช้งาน</span>';
                         }
                     },
                    {   targets: 'col_action',
                        className: 'dt-center',
                         render: function (data, type, row, meta) {
                          var tmp = '<a name="" href="{{ url('dag_school/programs/edit/') }}/'+row.id+'" class="btn btn-primary btn-mini rounded" data-ref_id="'+row.id+'" href="#" ><i class="fa fa-edit"></i> แก้ไข</a>';
                            return tmp;
                         }
                     }
                ]
            } );
        }    
    } //.getList()

    getList();

}); //.$(document).ready(function(){


</script>


@endsection

@extends('layouts.masterDataLayout.md_design')
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
<!-- <div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
      <li class="breadcrumb-item active">Machines</li>
    </ul>
  </div>
</div> -->

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">
				Shifts
				&nbsp;<a href="{{ url('master/shifts/new') }}" class="btn btn-primary shadow rounded" name="btn_add" /> New</a>
			</h4>

            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('master') }}">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Shifts</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
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



    <div class="row">
      <div class="col-md-12">

	    <div class="table-responsive">
	    <table id="tbl_main" class="hover compact" style="width: 100%;"   >
	        <thead>
	            <tr>
	                <th class="col_no" style="text-align: center;" >No.</th>
	                <th class="col_code" style="text-align: center;" >Shift Code</th>
	                <th class="col_name" style="text-align: center;" >Shift Description</th>
	                <th class="col_status" style="text-align: center;" >Status</th>
	                <th class="col_action" style="text-align: center;" >#</th>
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
                    url: "{{ url('master/shifts/get-list') }}",
                    dataSrc: 'items',
                },
                autoWidth: false,
                columns: [             
	                { data: null }, 
	                { data: 'shift_code' },    
	                { data: 'shift_desc' },    
	                { data: null },    
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
					 {   targets: 'col_code',
                        className: 'dt-center',
                     }, 
					 {   targets: 'col_name',
                        className: 'dt-center',
                     }, 
                     {   targets: 'col_status',
                        width: 10,
                        className: 'dt-center',
                         render: function (data, type, row, meta) {
                            return row.status==1 ? '<span class="badge badge-pill badge-success">Active</span>' : '<span class="badge badge-pill badge-danger ">Inactive</span>';
                         }
                     },
                    {   targets: 'col_action',
                        className: 'dt-center',
                         render: function (data, type, row, meta) {
                          var tmp = '<a name="" title="'+row.shift_code+' : '+row.shift_name+'" href="{{ url('master/shifts/edit/') }}/'+row.id+'" class="" data-ref_id="'+row.id+'" href="#" ><i class="fa fa-edit"></i> Edit</a> ';
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

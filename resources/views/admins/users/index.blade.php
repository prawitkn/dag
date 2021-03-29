@extends('layouts.adminLayout.design')
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
      <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
      <li class="breadcrumb-item active">User</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
    <div class="row col-md-12" id="divFlashAlert">

    </div>
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
      <h1 class="display">User List
	  &nbsp;<a href="{{ url('admin/users/new') }}" class="btn btn-primary shadow rounded" name="btn_add_product" /> New</a>
      </h1>
      

    </header>
    <!-- Page Header-->
    <div class="row">
      <div class="col-md-12">

	    <div class="table-responsive">
	    <table id="tbl_main" class="hover compact" style="width: 100%;"   >
	        <thead>
	            <tr>
	                <th class="col_no" style="text-align: center;" >No.</th>
	                <th class="col_email" style="text-align: center;" >Username</th>
	                <th class="col_name" style="text-align: center;" >Name</th>
	                <th class="col_status" style="text-align: center;" >Status</th>
	                <th class="col_action" style="text-align: center;" >Action</th>
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
                    url: "{{ url('admin/users/list') }}",
                    dataSrc: 'items',
                },
                autoWidth: false,
                columns: [
                    { data: null },
                    { data: null },
                    { data: 'name' },
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
                     {   targets: 'col_email',
                        className: 'dt-center',
                         render: function (data, type, row, meta) {
                            return row.email+' '+'<a href="#" name="btn_reset_pw" data-ref_id="'+row.id+'" >re-pass</a>';
                         }
                     },
                     {   targets: 'col_status',
                        width: 10,
                        className: 'dt-center',
                         render: function (data, type, row, meta) {
                            return row.status==1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                         }
                     },
                    {   targets: 'col_action',
                         render: function (data, type, row, meta) {
                            return '<a name="" href="{{ url('admin/users/edit/') }}/'+row.id+'" class="btn btn-primary btn-mini" data-ref_id="'+row.id+'" href="#" ><i class="fa fa-edit"></i> Edit</a>';
                         }
                     }
                ]
            } );
        }    
    } //.getList()

    getList();

}); //.$(document).ready(function(){

$(document).on('click', 'a[name="btn_reset_pw"]', function(){ 
    var pw = prompt("Reset Password", "");
        if (pw === "") {
    // user pressed OK, but the input field was empty
        } else if (pw) {
            // user typed something and hit OK
            if(confirm("Are you sure to reset password to "+pw+" ?")){
                var params = {
                    id: $(this).attr('data-ref_id'),
                    password: pw
                };     
                $.ajaxSetup({
                      headers: { 
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  }); 
                 $.ajax({
                    url: "{{ url('/admin/edit-reset_pw_ajax') }}",
                    type: 'post',
                    dataType:"json",
                    data: params,
                    error: function(xhr, status, error) {
                        console.log(xhr);
                      var err = eval("(" + xhr.responseText + ")");
                      alert(JSON.parse(xhr.responseText).message);
                    },
                    success: function (res) {        
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
                    }
                }); // /.ajax 
            } //.if confirm
        } else {
            // user hit cancel
        }
        
});

$(document).on('click', 'a[name="btn_edit_user"]', function(){ 
    function getUser(search_keyword){ 
        var params = {
                id: search_keyword
            };       //alert(params.id);
        $.ajaxSetup({
              headers: { 
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          }); 
            var tmpUrl = '';
         $.ajax({
            url: tmpUrl,
            type: 'get',
            dataType:"json",
            error: function(xhr, status, error) {
                console.log(xhr);
              // var err = eval("(" + xhr.responseText + ")");
               alert(JSON.parse(xhr.responseText).message);
            },
            success: function (data) { //alert(data.row_count);
                //console.log(data);
                $('#formEditUser input[name="id"]').val('');
                $('#formEditUser input[name="first_name"]').val('');
                $('#formEditUser input[name="last_name"]').val('');
                $('#formEditUser input[name="email"]').val('');
                $('#formEditUser input[name="is_admin"]').prop('checked',false);
                $('#formEditUser input[name="is_sales_dashboard"]').prop('checked',false);
                $('#formEditUser select[name="sales_dashboard_roll_name"]').prop('disabled',true).val(''); 
                $('#formEditUser select[name="salesman_id"]').prop('disabled',true).val('');
                $('#formEditUser input[name="is_product_library"]').prop('checked',false);     
                $('#formEditUser select[name="product_library_roll_name"]').prop('disabled',true).val('');      

                if(data.row_count==0){
                    //
                }else{ //alert(JSON.parse(data.items));
                    var val = data.items;
                    $('#modalEditUser h4[name="modal_title"]').text(val.name);
                    $('#formEditUser input[name="id"]').val(val.id);
                    $('#formEditUser input[name="first_name"]').val(val.first_name);
                    $('#formEditUser input[name="last_name"]').val(val.last_name);
                    $('#formEditUser input[name="email"]').val(val.email);
                    if(val.type=="admin"){
                        $('#formEditUser input[name="is_admin"]').prop('checked',true);
                    }
                    if(val.is_sales_dashboard==1){
                        $('#formEditUser input[name="is_sales_dashboard"]').prop('checked',true);
                        $('#formEditUser select[name="sales_dashboard_roll_name"]').prop('disabled',false).val(val.sales_dashboard_roll_name);
                        $('#formEditUser select[name="salesman_id"]').prop('disabled',false).val(val.salesman_id);                       
                        
                    }
                    if(val.is_product_library==1){
                        $('#formEditUser input[name="is_product_library"]').prop('checked',true);
                        $('#formEditUser select[name="product_library_roll_name"]').prop('disabled',false).val(val.product_library_roll_name);  
                    } 
                    if(val.status=="1"){
                        $('#formEditUser #status_1').prop('checked',true);
                    }else{
                        $('#formEditUser #status_2').prop('checked',true);
                    }
                }    
            }
        }); // /.ajax        
    }
        getUser($(this).attr('data-ref_id'));
        $('#modalEditUser').modal('show');    
});
</script>


@endsection

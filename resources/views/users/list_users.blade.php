@extends('layouts.adminLayout.admin_design')
@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Users</h4>
            &nbsp;<a href="#" name="btn_new_user" class="btn btn-outline-primary" /><i class="fas fa-plus"></i> New User</a>

            <!-- <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="#">User</a></li>
                    </ol>
                </nav>
            </div> -->
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->   

    <div id="divFlashAlert" class="col-md-12">
         
    </div>
    <!--/.col-12-->

    SD = Sales Dashboard, PL = Product Library  
    <div class="table-responsive">
    <table id="table" class="hover compact" style="width: 100%;"   >
        <thead>
            <tr>
                <th class="col_no" style="text-align: center;" >No.</th>
                <th class="col_email" style="text-align: center;" >Username</th>
                <th class="col_name" style="text-align: center;" >Name</th>
                <th class="col_type" style="text-align: center;" >Type</th>
                <th class="col_sd" style="text-align: center;" >SD</th>
                <th class="col_sd_roll" style="text-align: center;" >SD Roll</th>
                <th class="col_pl" style="text-align: center;" >PL</th>
                <th class="col_pl_roll" style="text-align: center;" >PL Roll</th>
                <th class="col_status" style="text-align: center;" >Status</th>
                <th class="col_action" style="text-align: center;" >Action</th>
            </tr>
        </thead>
    </table>
    </div>


    
    <!-- <div class="table-responsive">
        <table id="tbl_dashboard" class="stripe compact row-border order-column nowrap" style="width: 100%" >
            <thead>
                <tr>
                    <th style="text-align: center; width: 5px;">No.</th>
                    <th style="text-align: center;" >Username</th>
                    <th style="text-align: center;" >Name</th>
                    <th style="text-align: center;" >SD</th>
                    <th style="text-align: center;" >SD Roll</th>
                    <th style="text-align: center;" >PL</th>
                    <th style="text-align: center;" >PL Roll</th>
                    <th style="text-align: center; width: 50px;" >Action</th>
                </tr>
            </thead>
            <tbody>                           
                @foreach($users as $key => $val)
                <tr>
                    <td>{{ ($key+1) }}</td>
                    <td>{{ $val->email }}
                        &nbsp; <a href="#" name="btn_reset_pw" data-ref_id="{{ $val->id }}" >re-pass</a>
                    </td>
                    <td>{{ $val->name }}</td>
                    <td style="text-align: center;">
                        @if($val->is_sales_dashboard)
                        <span class="badge badge-success">Yes</span>
                        @endif
                    </td>
                    <td style="text-align: center;">{{ $val->sales_dashboard_roll_name }}</td>
                    <td style="text-align: center;">
                        @if($val->is_product_library)
                        <span class="badge badge-success">Yes</span>
                        @endif
                    </td>
                    <td style="text-align: center;">{{ $val->product_library_roll_name }}</td>
                    <td> 
                        <a name="btn_edit_user" class="btn btn-mini" data-ref_id="{{ $val->id }}" href="#"> Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div> -->
    <!--/. table-responsive -->

    

    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
    
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->



<!-- The Modal -->
<div class="modal" id="modalNewUser">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" name="modal_title">New User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>


    <form id="formNewUser" class="form-control" method="post" >{{ csrf_field() }}
      <!-- Modal body -->
      <div class="modal-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <label for="first_name" class="col-md-3 col-form-label"></label>
                        <div class="col-sm-12">
                            <input type="text" name="first_name" id="first_name"  class="form-control" placeholder="First Name..."   value="" required="" >
                        </div>
                    </div>
                    <!--/.form-group row-->

                    <div class="row">
                        <label for="last_name" class="col-md-3 col-form-label"></label>
                        <div class="col-sm-12">
                            <input type="text" name="last_name" id="last_name"  class="form-control" placeholder="Last Name..."   value="" required=""  >
                        </div>
                    </div>
                    <!--/.form-group row-->

                    <div class="row">
                        <label for="email" class="col-md-3 col-form-label"></label>
                        <div class="col-sm-12">
                            <input type="text" name="email" id="email"  class="form-control" placeholder="Email..."   value=""  >
                        </div>
                    </div>
                    <!--/.form-group row-->

                    <div class="row">
                        <label for="password" class="col-md-3 col-form-label"></label>
                        <div class="row col-sm-12">
                            <div class="col-sm-6">
                                <input type="password" name="password" id="password" class="form-control" autocomplete="off" placeholder="Default Password Here..." required>
                            </div>
                            <div class="col-sm-6">
                                <label name="lbl_password"></label>
                            </div>
                        </div>
                    </div>
                    <!--/.form-group row-->             

                </div>
                <!--/.col-6-->


                <div class="col-md-6">
                    <div class="row">
                        <div class="row col-sm-12">
                            <input type="checkbox" value="1" name="is_admin" class="form-control col-sm-2" /> <label class="label-control">Admin</label>
                        </div>
                        <!--/.col-sm-12-->
                    </div>
                    <!--/.row-->

                    <div class="row">
                        <div class="row col-sm-12">
                            <input type="checkbox" value="1" name="is_sales_dashboard" class="form-control col-sm-2" /> <label class="label-control">Sales Dashboard</label>
                        </div>
                        <!--/.col-sm-12-->
                    </div>
                    <!--/.row-->

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="password" class="col-sm-3">Roll : </label>
                            <select name="sales_dashboard_roll_name" class="form-control col-sm-6" disabled="disabled">
                                <option value="">-</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                <option value="sales_admin">Sales Admin</option>
                                <option value="sales">Sales</option>
                            </select>
                        </div>
                        <!--/.col-sm--->
                        <div class="col-sm-6">
                            <label for="password" class="col-sm-6">Default Salesman : </label>
                            <select name="salesman_id" class="form-control col-sm-6" disabled="disabled">
                                <option value=""> - Optional -</option>
                                @foreach($salesmen as $val_ddl)
                                <option value="{{ $val_ddl->id }}" 
                                    >{{ $val_ddl->salesman_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--/.col-sm--->
                    </div>
                    <!--/.row-->

                    <div class="row">
                        <div class="row col-sm-12">
                            <input type="checkbox" value="1" name="is_product_library" class="form-control col-sm-2" /> <label class="label-control">Product Library</label>
                        </div>
                        <!--/.col-sm-12-->
                    </div>
                    <!--/.row-->

                    <div class="row">
                        <div class="col-sm-12">
                            <label for="password" class="col-sm-3">Roll : </label>
                            <select name="product_library_roll_name" class="form-control col-sm-6" disabled="disabled">
                                <option value="">-</option>
                                <option value="admin">Admin</option>
                                <option value="technique">Technique</option>
                                <option value="dcc">DCC</option>
                            </select>
                        </div>
                        <!--/.col-sm-12-->
                    </div>
                    <!--/.row-->
                </div>
                <!--/.col-->

            </div>
            <!--/.row-->
        
      </div>
      <!--/.body-->

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" name="btn_new_user_save" class="btn btn-success" >Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </form>
    <!--/.form-->

    </div>
  </div>
</div>     
<!--/. The Modal -->    





<!-- The Modal -->
<div class="modal" id="modalEditUser">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" name="modal_title">Edit User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>


    <form id="formEditUser" class="form-control" method="post" >{{ csrf_field() }}
      <!-- Modal body -->
      <div class="modal-body">
            <input type="hidden" name="id" value="" />
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <label for="first_name" class="col-md-3 col-form-label"></label>
                        <div class="col-sm-12">
                            <input type="text" name="first_name" id="first_name"  class="form-control" placeholder="First Name..."   value="" required="" >
                        </div>
                    </div>
                    <!--/.form-group row-->

                    <div class="row">
                        <label for="last_name" class="col-md-3 col-form-label"></label>
                        <div class="col-sm-12">
                            <input type="text" name="last_name" id="last_name"  class="form-control" placeholder="Last Name..."   value="" required=""  >
                        </div>
                    </div>
                    <!--/.form-group row-->

                    <div class="row">
                        <label for="email" class="col-md-3 col-form-label"></label>
                        <div class="col-sm-12">
                            <input type="text" name="email" id="email"  class="form-control" placeholder="Email..."   value=""  >
                        </div>
                    </div>
                    <!--/.form-group row-->

                    <!-- <div class="row">
                        <label for="password" class="col-md-3 col-form-label"></label>
                        <div class="row col-sm-12">
                            <div class="col-sm-6">
                                <input type="password" name="password" id="password" class="form-control" autocomplete="off" placeholder="Default Password Here..." required>
                            </div>
                            <div class="col-sm-6">
                                <label name="lbl_password"></label>
                            </div>
                        </div>
                    </div> -->
                    <!--/.form-group row-->          

                     <div class="row">
                        <label for="status" class="col-md-3 col-form-label"></label>
                        <div class="row col-sm-12">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="status" id="status_1" class="custom-control-input" value="1" >
                                <label class="custom-control-label" for="status_1"> Active</label> 
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" name="status" id="status_2" class="custom-control-input" value="2" >
                                <label class="custom-control-label" for="status_2"> Inactive</label> 
                            </div>
                        </div>
                    </div>
                    <!--/.form-group row     -->        

                </div>
                <!--/.col-6-->


                <div class="col-md-6">
                    <div class="row">
                        <div class="row col-sm-12">
                            <input type="checkbox" value="1" name="is_admin" class="form-control col-sm-2" /> <label class="label-control">Admin</label>
                        </div>
                        <!--/.col-sm-12-->
                    </div>
                    <!--/.row-->

                    <div class="row">
                        <div class="row col-sm-12">
                            <input type="checkbox" value="1" name="is_sales_dashboard" class="form-control col-sm-2" /> <label class="label-control">Sales Dashboard</label>
                        </div>
                        <!--/.col-sm-12-->
                    </div>
                    <!--/.row-->

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="password" class="col-sm-3">Roll : </label>
                            <select name="sales_dashboard_roll_name" class="form-control col-sm-6" disabled="disabled">
                                <option value="">-</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                <option value="sales_admin">Sales Admin</option>
                                <option value="sales">Sales</option>
                            </select>
                        </div>
                        <!--/.col-sm--->
                        <div class="col-sm-6">
                            <label for="password" class="col-sm-6">Default Salesman : </label>
                            <select name="salesman_id" class="form-control col-sm-6" disabled="disabled">
                                <option value=""> - Optional -</option>
                                @foreach($salesmen as $val_ddl)
                                <option value="{{ $val_ddl->id }}" 
                                    >{{ $val_ddl->salesman_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--/.col-sm--->
                    </div>
                    <!--/.row-->

                    <div class="row">
                        <div class="row col-sm-12">
                            <input type="checkbox" value="1" name="is_product_library" class="form-control col-sm-2" /> <label class="label-control">Product Library</label>
                        </div>
                        <!--/.col-sm-12-->
                    </div>
                    <!--/.row-->

                    <div class="row">
                        <div class="col-sm-12">
                            <label for="password" class="col-sm-3">Roll : </label>
                            <select name="product_library_roll_name" class="form-control col-sm-6" disabled="disabled">
                                <option value="">-</option>
                                <option value="admin">Admin</option>
                                <option value="technique">Technique</option>
                                <option value="dcc">DCC</option>
                            </select>
                        </div>
                        <!--/.col-sm-12-->
                    </div>
                    <!--/.row-->
                </div>
                <!--/.col-->

            </div>
            <!--/.row-->
        
      </div>
      <!--/.body-->

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" name="btn_edit_user_save" class="btn btn-success" > Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </form>
    <!--/.form-->

    </div>
  </div>
</div>     
<!--/. The Modal -->     


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
    $('input[name="is_admin"]').on('change',function(){ //alert();
        if ($(this).prop('checked')) {
            $('select[name="sales_dashboard_roll_name"]').attr('disabled',false).val('admin');
            $('input[name="is_sales_dashboard"]').prop('checked',true);
            $('select[name="product_library_roll_name"]').attr('disabled',false).val('admin');
            $('input[name="is_product_library"]').prop('checked',true);
            
          }else{
            $('select[name="sales_dashboard_roll_name').attr('disabled',true).val('');
            $('input[name="is_sales_dashboard"]').prop('checked',false);
            $('select[name="product_library_roll_name').attr('disabled',true).val('');
            $('input[name="is_product_library"]').prop('checked',false);
          }
    }); //. $('#grading_group_id').change(function(){   

    $('input[name="is_sales_dashboard"]').on('change',function(){ //alert();
        if ($(this).prop('checked')) {
            $('select[name="sales_dashboard_roll_name"]').attr('disabled',false).val('');
            $('select[name="salesman_id"]').attr('disabled',false).val('');
          }else{
            $('select[name="sales_dashboard_roll_name"]').attr('disabled',true).val('');
            $('select[name="salesman_id"]').attr('disabled',true).val('');
          }
    }); //. $('#grading_group_id').change(function(){   

    $('input[name="is_product_library"]').on('change',function(){ //alert();
        if ($(this).prop('checked')) {
            $('select[name="product_library_roll_name"]').attr('disabled',false).val('');
          }else{
            $('select[name="product_library_roll_name"]').attr('disabled',true).val('');
          }
    }); //. $('#grading_group_id').change(function(){   


    // $('select[name="sales_dashboard_roll_name"]').on('change',function(){ 
    //     if($(this).val()=='sales'){
    //         $('select[name="salesman_id"]').attr('disabled',false).val('');
    //     }else{
    //         $('select[name="salesman_id"]').attr('disabled',true).val('');            
    //     }
    // }); //. $('#grading_group_id').change(function(){ 


    
    

    //Modal Next Step  
    $('button[name="btn_edit_user_save"]').on('click',function(){ //alert('big');
         params = $('#formEditUser').serialize(); 
        // console.log(params); 
        $.ajaxSetup({
              headers: { 
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          }); 
         $.ajax({
            url: "{{ url('/admin/edit-user_ajax') }}",
            type: 'post',
            dataType:"json",
            data: params,
            error: function(xhr, status, error) {
                console.log(xhr);
              var err = eval("(" + xhr.responseText + ")");
              alert(JSON.parse(xhr.responseText).message);
            },
            success: function (data) { 
                $('#modalEditUser').modal('hide');         
                if(data.success=="success"){   
                    $('#divFlashAlert').append('<div class="alert alert-success alert-block">'+
                        '<button type="button" class="close" data-dismiss="alert">×</button>'+ 
                            '<strong>'+data.msg+'</strong>'+
                    '</div>');   
                    // var table = $('#tbl_dashboard').DataTable( {
                    //     ajax: "data.json"
                    // } );
                     
                    getList();
                }else{
                    //alert('msg');
                    $('#divFlashAlert').append('<div class="alert alert-danger alert-block">'+
                        '<button type="button" class="close" data-dismiss="alert">×</button>'+ 
                            '<strong>'+data.msg+'</strong>'+
                    '</div>');      
                } 
            }
        }); // /.ajax   
    }); //. $('button[name="btn_new_customer_save"]').on('click',function(){  
    //Modal Next Step





    //Modal New Customer Begin
    $('a[name="btn_new_user"]').click(function(){ //alert('big');
        $('#modalNewUser').modal('show');        
    }); //. $('a[name=btnSearchEvaluator]').click(function(){ 
    //Modal New Customer End


    $('button[name="btn_new_user_save"]').on('click',function(){ //alert('big');
         params = $('#formNewUser').serialize(); 
        console.log(params); 
        $.ajaxSetup({
              headers: { 
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          }); 
         $.ajax({
            url: "{{ url('/admin/add-user_ajax') }}",
            type: 'post',
            dataType:"json",
            data: params,
            error: function(xhr, status, error) {
                console.log(xhr);
              var err = eval("(" + xhr.responseText + ")");
              alert(JSON.parse(xhr.responseText).message);
            },
            success: function (data) { 
                $('#modalNewUser').modal('hide');         
                if(data.success=="success"){   
                    $('#divFlashAlert').append('<div class="alert alert-success alert-block">'+
                        '<button type="button" class="close" data-dismiss="alert">×</button>'+ 
                            '<strong>'+data.msg+'</strong>'+
                    '</div>');  
                    getList(); 
                }else{
                    //alert('msg');
                    $('#divFlashAlert').append('<div class="alert alert-danger alert-block">'+
                        '<button type="button" class="close" data-dismiss="alert">×</button>'+ 
                            '<strong>'+data.msg+'</strong>'+
                    '</div>');      
                } 
            }
        }); // /.ajax   
    }); //. $('button[name="btn_new_customer_save"]').on('click',function(){  

    $('input[name="password"]').keyup(function(){             
        $('label[name="lbl_password"]').text($(this).val());
    });// $('input[name="new_pwd"]').keyup(function(){   

    var table; // = $('#table').DataTable();
    function getList(){
        if ($.fn.DataTable.isDataTable('#table')) {
            table.ajax.reload( null, false );
        }else{
            table = $('#table').DataTable( {
                searching: false,
                paging: false,
                info: false,
                fixedHeader: true,
                ajax: {
                    type: 'GET',
                    url: '{{ route('userJson') }}',
                    dataSrc: 'users',
                },
                autoWidth: false,
                columns: [
                    { data: null },
                    { data: null },
                    { data: 'name' },
                    { data: 'type' },
                    { data: null },
                    { data: 'sales_dashboard_roll_name' },
                    { data: null },
                    { data: 'product_library_roll_name' },
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
                    {   targets: 'col_type',
                        width: 10,
                        className: 'dt-center'
                     },
                    {   targets: 'col_sd',
                        width: 10,
                        className: 'dt-center',
                         render: function (data, type, row, meta) {
                            return row.is_sales_dashboard==1 ? '<span class="badge badge-success">Yes</span>' : '';
                         }
                     },
                     {   targets: 'col_sd_roll',
                        width: 10,
                        className: 'dt-center'
                     },
                     {   targets: 'col_pl',
                        width: 10,
                        className: 'dt-center',
                         render: function (data, type, row, meta) {
                            return row.is_product_library==1 ? '<span class="badge badge-success">Yes</span>' : '';
                         }
                     },
                     {   targets: 'col_pl_roll',
                        width: 10,
                        className: 'dt-center'
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
                            return '<a name="btn_edit_user" class="btn btn-mini" data-ref_id="'+row.id+'" href="#" ><i class="fa fa-edit"></i> Edit</a>';
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
                    success: function (data) {        
                        if(data.success=="success"){   
                            $('#divFlashAlert').append('<div class="alert alert-success alert-block">'+
                                '<button type="button" class="close" data-dismiss="alert">×</button>'+ 
                                    '<strong>'+data.msg+'</strong>'+
                            '</div>');              
                        }else{
                            //alert('msg');
                            $('#divFlashAlert').append('<div class="alert alert-danger alert-block">'+
                                '<button type="button" class="close" data-dismiss="alert">×</button>'+ 
                                    '<strong>'+data.msg+'</strong>'+
                            '</div>');      
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
            var tmpUrl = '{{ url('/admin/get-user') }}'+'/'+params.id;
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

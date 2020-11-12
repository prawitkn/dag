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
      <li class="breadcrumb-item active">บันทึกคะแนน รายแบบทดสอบรายวิชา</li>
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
      <h1 class="display">บันทึกคะแนน
	 <!--  &nbsp;<a href="{{ url('online_store/customers/new') }}" class="btn btn-primary shadow rounded" name="btn_add" /> เพิ่ม</a> -->
      </h1>
      

    </header>
    <!-- Page Header-->
  <form id="frm2" method="POST" action="" >
    <div class="row">
      <div class="col-md-6">
        <select name="class_name" class="form-control">
          <option value=""> - หลักสูตร รุ่น - </option>
          @foreach($program_classes as $val)
            <option value="{{$val->id}}">{{$val->program_class_name }}</option>
          @endforeach
        </select>
        <input type="hidden" name="class_id" value="" />
      </div>

      <div class="col-md-6">
        <select name="test_name" class="form-control">
          <option value=""> - วิชา แบบทดสอบ - </option>
        </select>
        <input type="hidden" name="test_id" value="" />
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">

	    <div class="table-responsive">
	    <table id="tbl_main" class="hover compact" style="width: 100%;"   >
	        <thead>
	            <tr>
	                <th class="col_no" style="text-align: center;" >ลำดับ</th>
                  <th class="col_name" style="text-align: center;" >ยศ ชื่อ สกุล</th>
                  <th class="col_org" style="text-align: center;" >ต้นสังกัด</th>
                  <th class="col_action" style="text-align: center;" >คะแนน</th>
	            </tr>
	        </thead>
	    </table>
	    </div>    
		<!--/.table-responsive-->
	  </div>
    <!--/.col-->
	</div>
  <!--/.row-->
  <div class="row">
      <button type="submit" class="btn btn-primary rounded shadow" > บันทึก</button>
  </div>
  <!--/.row-->
  </form>
  <!--/.frm2-->
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
                    url: "{{ url('dag_school/program-course-tests/student_list') }}",
                    data: {
                      class_id: function() { return $('input[name="class_id"]').val() },
                      test_id: function() { return $('input[name="test_id"]').val() },
                    },
                    dataSrc: 'items',
                },
                autoWidth: false,
                columns: [
                    { data: null },
                    { data: 'student_name' },
                    { data: 'org_name' },
                    { data: null }
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
                    {   targets: 'col_action',
                        width: 80,
                        className: 'dt-center',
                         render: function (data, type, row, meta) {
                          var tmp_score = (!row.score?"0":row.score);
                          var tmp = '<input type="hidden" name="class_student_ids[]" value="'+row.class_student_id+'" />'+
                          '<input name="scores[]" type="number" min="0" step="0.1" class="form-control" style="text-align: right;" '+
                          'value="'+tmp_score+'" />';
                            return tmp;
                         }
                     }
                ]
            } );
        }    
        // $('#tbl_main').fadeIn('slow');
    } //.getList()

    // getList();

    $('select[name="class_name"]').on('change', function() { 
      // alert($(this).val());
      $('input[name="class_id"]').val($(this).val());
      var params = {};
    // var tmp = $('#frm1').serialize();
    // // $.each($('input[name="reference_item_ids[]"]'), function(){
    // //  tmp=tmp+'&'+$(this).serialize();
    // // });    
    // params = tmp;
    params = {
      class_id: $('input[name="class_id"]').val(),
    };

      console.log(params);
      // return;
        $('select[name="test_name"]').empty().append('<option value=""> - วิชา แบบทดสอบ - </option>');
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }); 
        $.ajax({
          url: "{{ url('/dag_school/program-class-test-students/test-list') }}",
          type: 'get', dataType:"json", data: params,
          success: function (res) { 
              console.log(res);
              if(res.success=="success"){
                $.each(res.items, function( index, value ) {
                  // alert( index + ": " + value );
                  $('select[name="test_name"]').append('<option value="'+value['id']+'">'+value['program_course_test_name']+'</option>');
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
        getList();
      }
    });

    $('select[name="test_name"]').on('change', function() { 
      // alert($(this).val());
      $('input[name="test_id"]').val($(this).val());
      if($(this).val()!=""){
        getList();
      }
    });

    $('#frm2').submit(function(e){ 
      e.preventDefault(); // For Form Valid and not use default href link

      var params = {};
        var tmp = $('#frm2').serialize();
        // $.each($('input[name="ref_ids[]"]'), function(){
        //   tmp=tmp+'&'+$(this).serialize();
        // });
        params = tmp; 
        console.log(params); 
        // return;
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }); 
        $.ajax({
          url: "{{ url('dag_school/program-course-tests/update-scores') }}",
          type: 'post', dataType:"json", data: params,
          success: function (res) { console.log(res);
            alert(res.msg);
              if(res.success=="success"){
                getList();
              }else{
              console.log(res.items);
                  //alert(res.msg);
              } 
          },
          error: function(xhr, status, error) {
            console.log(xhr);
            var err = eval("(" + xhr.responseText + ")");
            alert(JSON.parse(xhr.responseText).message);
          }
        }); // /.ajax   
    }); // click

}); //.$(document).ready(function(){


</script>


@endsection

@extends('layouts.dagSchoolLayout.design')

@section('head')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection

@section('content')

<!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/online_store') }}">หน้าแรก</a></li>
      <li class="breadcrumb-item active">วิชาหลักสูตร</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="display">วิชาหลักสูตร : <b>วิชา {{ $program_course->course_name }}</b>
      </h1>
      

    </header>
    <!-- Page Header-->
    <div class="row">
      <div class="col-md-12">

    <div class="card">
    <form id="frm1" method="POST" action="">
      <div class="card-body">
                        @csrf
        <input type="hidden" name="id" value="{{ $program_course->id }}" />
                              
        <div class="row">
          <div class="form-group col-md-3">
            <input type="checkbox" name="status" id="status" data-toggle="toggle" data-size="mini" 
            @if( $program_course->status ) checked @endif
            >
            ใช้งาน 
            
          </div><!--/.col-->
        </div>

        <div class="row">
         <!--  `course_hierarchy`, `course_no`, `course_name`, `course_description`, `course_hours`, `credit` -->
         <div class="form-group col-md-2">
            <label for="course_hierarchy">Course hierarchy</label>
            <input type="text" class="form-control" name="course_hierarchy" value="{{ $program_course->course_hierarchy }}" required >
          </div><!--/.col-6-->
          <div class="form-group col-md-2">
            <label for="course_no">ลำดับ</label>
            <input type="text" class="form-control" name="course_no" value="{{ $program_course->course_no }}"  >
          </div><!--/.col-6-->
          <div class="form-group col-md-4">
            <label for="course_name">ชื่อวิชา</label>
            <input type="text" class="form-control" name="course_name" value="{{ $program_course->course_name }}" required >
          </div><!--/.col-6-->
          <div class="form-group col-md-4">
            <label for="course_description">รายละเอียด</label>
            <input type="text" class="form-control" name="course_description" value="{{ $program_course->course_description }}"  >
          </div><!--/.col-6-->
        </div><!--/row-->

        <div class="row">
         <!--  `course_hierarchy`, `course_no`, `course_name`, `course_description`, `course_hours`, `credit` -->
         <div class="form-group col-md-2">
            <label for="course_hours">ชั่วโมง</label>
            <input type="text" class="form-control" name="course_hours" value="{{ $program_course->course_hours }}"  >
          </div><!--/.col-6-->
          <div class="form-group col-md-2">
            <label for="credit">เครดิต</label>
            <input type="text" class="form-control" name="credit" value="{{ $program_course->credit }}"  >
          </div><!--/.col-6-->
        </div><!--/row-->

	      <!-- Submit-->
	      
      </div>
      <!--/.card-body-->

      <div class="card-footer">
        <div class="col-12 d-flex no-block align-items-center">

            <div class="ml-auto text-right">				      
          <a href="#" name="btn_clear" class="btn btn-secondary rounded shadow" /> ล้างข้อมุล</a>
          <button type="submit" name="btn_create" class="btn btn-primary shadow rounded" > บันทึก</button>
            </div>
        </div>
      </div>
      <!--/.card-footer-->
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

<!-- Add fancybox JS 
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/libs/fancybox-master/dist/jquery.fancybox.min.css') }}">
<script src="{{ asset('public/assets/libs/fancybox-master/dist/jquery.fancybox.min.js') }}"></script>


<!-- Set default evaluator -->
<script type="text/javascript">

$(document).ready(function(){	
  $('#status').bootstrapToggle();
  $('#status').change(function() {
    // if($(this).is(':checked')){
    //   $('select[name="pos_group_name"]').prop('disabled','');
    //   $('select[name="pos_branch_name"]').prop('disabled','');
    // }else{
    //   $('select[name="pos_group_name"]').prop('disabled',true);
    //   $('select[name="pos_branch_name"]').prop('disabled',true);
    // }
  })

  function formClear(){
    $('input[name="customer_name"]').val('');

    $('input[name="customer_name"]').select();
  }

	// formClear();
  $('input[name="customer_name"]').select();

  $('a[name="btn_clear"]').click(function(e){  
    formClear();
  }); // click

  $('#frm1').submit(function(e){ 
    e.preventDefault(); // For Form Valid and not use default href link

    var params = {};
    var tmp = $('#frm1').serialize();
      params = tmp;   
      console.log(params);
     $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      }); 
      $.ajax({
        url: "{{ url('/dag_school/program-courses/update') }}",
        type: 'post', dataType:"json", data: params,
        success: function (res) { 
            console.log(res);
            if(res.success=="success"){
           alert(res.msg);
             location.reload();
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
  }); // click


});

</script>



@endsection





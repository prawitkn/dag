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
      <li class="breadcrumb-item active">วิชาหลักสูตรddd</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="display">วิชาหลักสูตร : <b>วิชา {{ $program_course_test->course_name }}</b>
      </h1>
      

    </header>
    <!-- Page Header-->
    <div class="row">
      <div class="col-md-12">

    <div class="card">
    <form id="frm1" method="POST" action="">
      <div class="card-body">
                        @csrf
        <input type="hidden" name="id" value="{{ $program_course_test->id }}" />
                              
        <div class="row">
          <div class="form-group col-md-3">
            <input type="checkbox" name="status" id="status" data-toggle="toggle" data-size="mini" 
            @if( $program_course_test->status ) checked @endif
            >
            ใช้งาน 
            
          </div><!--/.col-->
        </div>
        
            <div class="row">
              <div class="col-md-4">    
                <div class="form-group-material">          
                  <select name="program_course_name" class="form-control" required>
                    <option value=""> - Select - </option>
                  @foreach($program_courses as $program_course)
                    <option value="{{$program_course->id}}"
                      @if( $program_course_test->program_course_id == $program_course->id ) selected @endif
                      >{{                       
                      $program_course->course_no.' '.$program_course->course_name }}</option>
                  @endforeach
                  </select>
                  <label for="program_course_name" class="label-material-select" >วิชา : </label>      
                  <input type="hidden" name="program_course_id" value="{{ $program_course_test->program_course_id }}" />
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group-material">
                  <input type="text" class="input-material" name="program_course_test_name" value="{{ $program_course_test->program_course_test_name }}" required >
                  <label for="program_course_test_name" class="label-material" >แบบทดสอบ/เรื่องทดสอบ : </label>   
                </div>
              </div><!--/.col-6-->

              <div class="col-md-2">
                <div class="form-group-material">
                  <input type="text" class="input-material" name="score" value="{{ $program_course_test->score }}" required >
                  <label for="score" class="label-material" >คะแนนเต็ม : </label>   
                </div>
              </div><!--/.col-6-->

            </div><!--/row-->
      

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
    $('input[name="program_course_test_name"]').val('');
    $('input[name="score"]').val('');
    $('select[name="program_course_name"]').prop("selectedIndex", 0);

    $('input[name="program_course_test_name"]').select();
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
        url: "{{ url('/dag_school/program-course-tests/update') }}",
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





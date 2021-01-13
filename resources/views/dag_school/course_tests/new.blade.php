@extends('layouts.dagSchoolLayout.design')

@section('head')
@endsection

@section('content')

<!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/online_store') }}">หน้าแรก</a></li>
      <li class="breadcrumb-item active"> ลูกค้า</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="display">เพิ่มแบบทดสอบ
      </h1>

    </header>
    <!-- Page Header-->
    <div class="row">
      <div class="col-md-12">

    <div class="card">
      <form id="frm1" href="#">
        <div class="card-body">

          <input type="hidden" id="id" value="" />
        
            <div class="row">
              <div class="col-md-4">    
                <div class="form-group-material">          
                  <select name="program_course_name" class="form-control" required>
                    <option value=""> - Select - </option>
                  @foreach($program_courses as $program_course)
                    <option value="{{$program_course->id}}">{{ $program_course->course_no.' '.$program_course->course_name }}</option>
                  @endforeach
                  </select>
                  <label for="program_course_name" class="label-material-select" >วิชา : </label>      
                  <input type="hidden" name="program_course_id" value="" />
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group-material">
                  <input type="text" class="input-material" name="program_course_test_name" value="" required >
                  <label for="program_course_test_name" class="label-material" >แบบทดสอบ/เรื่องทดสอบ : </label>   
                </div>
              </div><!--/.col-6-->

              <div class="col-md-2">
                <div class="form-group-material">
                  <input type="text" class="input-material" name="score" value="" required >
                  <label for="score" class="label-material" >คะแนนเต็ม : </label>   
                </div>
              </div><!--/.col-6-->

            </div><!--/row-->
      
        </div>
        <!--/.card-body-->

        <div class="card-footer">
          <div class="col-12 d-flex no-block align-items-center">

              <div class="ml-auto text-right">
          <a href="#" name="btn_clear" class="btn btn-secondary rounded shadow" /> ล้างข้อมุล</a>
          <button type="submit" name="btn_create" class="btn btn-primary shadow rounded" > บันทึก</button>
          <!-- <a href="#" name="btn_save_n_confirm" class="btn btn-primary rounded shadow" />Save & Confirm</a> -->
                  
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

<!-- Set default evaluator -->
<script type="text/javascript">

$(document).ready(function(){	

	function formClear(){
		$('input[name="program_course_test_name"]').val('');
    $('input[name="score"]').val('');
    $('select[name="program_course_name"]').prop("selectedIndex", 0);

    $('input[name="program_course_test_name"]').select();
	}
	
	formClear();

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
      url: "{{ url('/dag_school/program-course-tests/create') }}",
      type: 'post', dataType:"json", data: params,
      success: function (res) { console.log(res);
        if(res.success=="success"){
          alert(res.msg);
          formClear();
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

  $('select[name="program_course_name"]').on('change', function() {
      $('input[name="program_course_id"]').val($(this).val());
      getList();
    });
});

</script>



@endsection





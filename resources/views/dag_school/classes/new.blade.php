@extends('layouts.dagSchoolLayout.design')

@section('head')
@endsection

@section('content')

<!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/online_store') }}">หน้าแรก</a></li>
      <li class="breadcrumb-item active"> รุ่นหลักสูตร</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="display">เพิ่มรุ่นหลักสูตร
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
          <div class="form-group col-md-12">
            <select name="program_name" class="form-control" required>
            <option value=""> - หลักสูตร - </option>
            @foreach($programs as $program)
              <option value="{{ $program->id }}">{{ $program->program_name }}</option>
            @endforeach
          </select>
          <input type="hidden" name="program_id" value="" />
          </div><!--/.col-6-->
        </div><!--/row-->

          <div class="row"> 
          <div class="form-group col-md-10">
            <label for="program_class_name">ชื่อรุ่น</label>
            <input type="text" class="form-control" name="program_class_name" value="" required >
          </div><!--/.col-6-->

          <div class="form-group col-md-2">
            <label for="program_class_qty">จำนวนนักเรียน</label>
            <input type="text" class="form-control" name="program_class_qty" value=""  >
          </div><!--/.col-6-->
        </div><!--/row-->

        <div class="row">
         <div class="form-group col-md-2">
            <label for="course_hours">ชั่วโมง</label>
            <input type="text" class="form-control" name="course_hours" value=""  >
          </div><!--/.col-6-->

          <div class="form-group col-md-2">
            <label for="course_days">วัน</label>
            <input type="text" class="form-control" name="course_days" value=""  >
          </div><!--/.col-6-->

          <div class="form-group col-md-2">
            <label for="credit">เครดิต</label>
            <input type="text" class="form-control" name="credit" value=""  >
          </div><!--/.col-6-->
        </div><!--/row-->




        <div class="row">
         <div class="form-group col-md-2">
            <label for="confirm_title">คำนำหน้า</label>
            <input type="text" class="form-control" name="confirm_title" value=""  >
          </div><!--/.col-6-->

          <div class="form-group col-md-4">
            <label for="confirm_full_name">ชื่อ นามสกุล</label>
            <input type="text" class="form-control" name="confirm_full_name" value=""  >
          </div><!--/.col-6-->

          <div class="form-group col-md-6">
            <label for="confirm_position_abb">ตำแหน่ง (ผอ.กสบ.สบ.ทหาร)</label>
            <input type="text" class="form-control" name="confirm_position_abb" value=""  >
          </div><!--/.col-6-->
        </div>

        <div class="row">          
          <div class="form-group col-md-2">
            <label for="approve_title">คำนำหน้า</label>
            <input type="text" class="form-control" name="approve_title" value=""  >
          </div><!--/.col-6-->

          <div class="form-group col-md-4">
            <label for="approve_full_name">ชื่อ นามสกุล</label>
            <input type="text" class="form-control" name="approve_full_name" value=""  >
          </div><!--/.col-6-->

          <div class="form-group col-md-6">
            <label for="approve_position_abb">ตำแหน่ง (จก.สบ.ทหาร)</label>
            <input type="text" class="form-control" name="approve_position_abb" value=""  >
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
    $('input[name="approve_position_abb"]').val('');
    $('input[name="approve_full_name"]').val('');
    $('input[name="approve_title"]').val('');
    $('input[name="confirm_position_abb"]').val('');
    $('input[name="confirm_full_name"]').val('');
    $('input[name="confirm_title"]').val('');
    $('input[name="credit"]').val('0');
    $('input[name="course_days"]').val('0');
    $('input[name="course_hours"]').val('0');
    $('input[name="program_class_qty"]').val('0');
    $('input[name="program_class_name"]').val('');

    $('input[name="program_class_name"]').select();
  }

  // formClear();
  $('input[name="program_class_name"]').select();

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
      url: "{{ url('/dag_school/program-classes/create') }}",
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

  $('select[name="program_name"]').change(function(e){ 
      $('input[name="program_id"]').val($('select[name="program_name"] option').filter(":selected").val());  
  }); // change
});

</script>



@endsection





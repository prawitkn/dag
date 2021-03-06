@extends('layouts.ossLayout.design')

@section('head')
@endsection

@section('content')

<!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/online_store') }}">หน้าแรก</a></li>
      <li class="breadcrumb-item active"> บริการศูนย์บริการแบบเบ็ดเสร็จของ บก.ทท.</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="display">บันทึก
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
              <div class="form-group col-md-2">
                <div class="form-group-material">
                  <input  type="text" name="issue_date" required class="input-material datepicker" data-format="yyyy-mm-dd" placeholder="">
                  <label for="issue_date" class="label-material active">วันที่</label>
                </div>
                <!--/.form-group-material-->
              </div>
              <!--/.col-->

              <div class="col-md-4">
                <select name="service_type_name" class="form-control" required>
                  <option value=""> ประเภทการให้บริการ </option>
                  @foreach($service_types as $val)
                    <option value="{{$val->id}}">{{$val->service_type_name }}</option>
                  @endforeach
                </select>
                <input type="hidden" name="service_type_id" value="" />
              </div>

              <div class="col-md-4">
                <select name="service_topic_name" class="form-control" >
                  <option value=""> หัวข้อการให้บริการ </option>
                  @foreach($service_types as $val)
                    <option value="{{$val->id}}">{{$val->service_topic_name }}</option>
                  @endforeach
                </select>
                <input type="hidden" name="service_topic_id" value="" />
              </div>

              <div class="col-md-2">
                <select name="customer_type_name" class="form-control" required>
                  <option value=""> ผู้ขอรับริการ </option>
                  @foreach($customer_types as $val)
                    <option value="{{$val->id}}">{{$val->customer_type_name }}</option>
                  @endforeach
                </select>
                <input type="hidden" name="customer_type_id" value="" />
              </div>

            </div><!--/row-->

            <div class="row">

              <div class="col-md-6">
                <label for="remark">อื่น ๆ</label>
                <textarea name="remark" class="form-control"></textarea>
              </div><!--/.col-6-->
              
            </div>
      
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

<link href="{{ asset('public/assets/libs/bootstrap-datepicker-custom-thai/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<script src="{{ asset('public/assets/libs/bootstrap-datepicker-custom-thai/dist/js/bootstrap-datepicker-custom.js') }}"></script>
<script src="{{ asset('public/assets/libs/bootstrap-datepicker-custom-thai/dist/locales/bootstrap-datepicker.th.min.js') }}" charset="UTF-8"></script>



<!-- Set default evaluator -->
<script type="text/javascript">

$(document).ready(function(){ 
  $('.datepicker').datepicker({
        daysOfWeekHighlighted: "0,6",
        autoclose: true,
        format: 'dd/mm/yyyy',
        todayBtn: true,
        minDate: '01/01/2020',
        language: 'en',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: false              //Set เป็นปี พ.ศ.
    });  
        //กำหนดเป็นวันปัจุบัน
    $('.datepicker').datepicker('setDate', '0');

  function formClear(){
    $('textarea[name="remark"]').val('');
    $('select[name="customer_type_name"]').val('');
    $('input[name="customer_type_id"]').val('');
    $('select[name="service_topic_name"]').val('');
    $('input[name="service_topic_id"]').val('');
    $('select[name="service_type_name"]').val('');
    $('input[name="service_type_id"]').val('');
    $('.datepicker').datepicker('setDate', '0');

    $('input[name="customer_name"]').select();
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
      url: "{{ url('/oss/service-data/create') }}",
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

  $('select[name="service_type_name"]').on('change', function() { 
      // alert($(this).val());
      $('input[name="service_type_id"]').val($(this).val());
      var params = {};
    // var tmp = $('#frm1').serialize();
    // // $.each($('input[name="reference_item_ids[]"]'), function(){
    // //  tmp=tmp+'&'+$(this).serialize();
    // // });    
    // params = tmp;
    params = {
      service_type_id: $('input[name="service_type_id"]').val(),
    };

      console.log(params);
      // return;
        $('select[name="service_topic_name"]').empty().append('<option value=""> - หัวข้อการให้บริการ - </option>');
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }); 
        $.ajax({
          url: "{{ url('/oss/service_topics/list-by-service_type') }}",
          type: 'get', dataType:"json", data: params,
          success: function (res) { 
              console.log(res);
              if(res.success=="success"){
                $.each(res.items, function( index, value ) {
                  // alert( index + ": " + value );
                  $('select[name="service_topic_name"]').append('<option value="'+value['id']+'">'+value['service_topic_name']+'</option>');
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
        // getList();
      }
    });

     $('select[name="service_topic_name"]').on('change', function() { 
      // alert($(this).val());
      $('input[name="service_topic_id"]').val($(this).val());
    });

     $('select[name="customer_type_name"]').on('change', function() { 
      // alert($(this).val());
      $('input[name="customer_type_id"]').val($(this).val());
    });
});

</script>



@endsection





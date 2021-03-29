@extends('layouts.masterDataLayout.md_design')


@section('head')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection

@section('content')

<!-- Breadcrumb-->
<!-- <div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/online_store') }}">Home</a></li>
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
				Shift : {{ $shift->shift_code }} / {{ $shift->shift_name.' ('.$shift->begin_hour.':'.$shift->begin_min.'-'.$shift->end_hour.':'.$shift->end_minute.') ' }}
			</h4>

            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('master') }}">Home</a></li>

                        <li class="breadcrumb-item" aria-current="page"><a href="{{ url('master/shifts/view-list') }}" > Shifts</a></li>
						<li class="breadcrumb-item active" aria-current="page">Edit Shift</a></li>
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

    <div class="row">
      <div class="col-md-12">

    <div class="card">
    <form id="frm1" href="#">
      <div class="card-body">
                        @csrf
        <input type="hidden" name="id" value="{{ $shift->id }}" />

		<div class="row">
          <div class="form-group col-md-3">
            <input type="checkbox" name="status" id="status" data-toggle="toggle" data-size="mini" 
            @if( $shift->status ) checked @endif
            >
            Active            
          </div><!--/.col-->
        </div>

        <div class="row">
              <div class="form-group col-md-2">
                <label for="shift_code">Shift Code</label>
                <input type="text" class="form-control" name="shift_code" value="{{ $shift->shift_code }}" required >
              </div><!--/.col-6-->

			  <div class="form-group col-md-2">
                <label for="shift_name">Shift Name</label>
                <input type="text" class="form-control" name="shift_name" value="{{ $shift->shift_name }}" required >
              </div><!--/.col-6-->

			  <div class="form-group col-md-2">
					<div class="form-group-material">
	                <label for="begin_hour" class="label-material-select" >Begin Hour</label>							
				  <select name="begin_hour" class="form-control select-material" >
                        @for($i = 0; $i<=23; $i++)
                        <option value="{{ $i }}" 
						@if( $shift->begin_hour == $i ) selected @endif 
						>{{substr('0'.$i,-2)}}</option>
						@endfor
                    </select> 
					</div>
	              <!--/.form-group-material-->
	            </div>
	            <!--/.col-->

				<div class="form-group col-md-2">
					<div class="form-group-material">
	                <label for="begin_minute" class="label-material-select" >Begin Min</label>							
				  <select name="begin_minute" class="form-control select-material"  >
                        @for($i = 0; $i<=45; $i+=15)
                        <option value="{{ $i }}" 						
						@if( $shift->begin_minute == $i ) selected @endif 
						>{{substr('0'.$i,-2)}}</option>
						@endfor
                    </select> 
					</div>
	              <!--/.form-group-material-->
	            </div>
	            <!--/.col-->

				<div class="form-group col-md-2">
					<div class="form-group-material">
	                <label for="end_hour" class="label-material-select" >End Hour</label>							
				  <select name="end_hour" class="form-control select-material" >
	                    @for($i = 0; $i<=23; $i++)
	                    <option value="{{ $i }}" 
						@if( $shift->end_hour == $i ) selected  @endif
						>{{substr('0'.$i,-2)}}</option>
						@endfor
                    </select> 
					</div>
	              <!--/.form-group-material-->
	            </div>
	            <!--/.col-->

				<div class="form-group col-md-2">
					<div class="form-group-material">
	                <label for="end_minute" class="label-material-select" >End Min</label>							
				  <select name="end_minute" class="form-control select-material" >
                        @for($i = 0; $i<=45; $i+=15)
                        <option value="{{ $i }}" 
						@if( $shift->end_minute == $i ) selected @endif
						>{{substr('0'.$i,-2)}}</option>
						@endfor
                    </select> 
					</div>
	              <!--/.form-group-material-->
	            </div>
	            <!--/.col-->

            </div><!--/row-->

	      <!-- Submit-->
	      
      </div>
      <!--/.card-body-->

      <div class="card-footer">
        <div class="col-12 d-flex no-block align-items-center">

            <div class="ml-auto text-right">				      
          <a href="#" name="btn_clear" class="btn btn-secondary rounded shadow" /> Clear</a>
          <button type="submit" name="btn_create" class="btn btn-primary shadow rounded" > Save</button>
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
//   $('#status').bootstrapToggle();
//   $('#status').change(function() {
//     // if($(this).is(':checked')){
//     //   $('select[name="pos_group_name"]').prop('disabled','');
//     //   $('select[name="pos_branch_name"]').prop('disabled','');
//     // }else{
//     //   $('select[name="pos_group_name"]').prop('disabled',true);
//     //   $('select[name="pos_branch_name"]').prop('disabled',true);
//     // }
//   })

  function formClear(){ 
    $('input[name="machine_description"]').val('');
		$('input[name="machine_code"]').val('');
		$('select[name="location_name"]').prop("selectedIndex", 0);
		$('input[name="location_id"]').val('');

		$('input[name="machine_code"]').select();
  }

	// formClear();
  $('input[name="machine_description"]').select();

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
        url: "{{ url('/master/shifts/update') }}",
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

//   $('select[name="location_name"]').change(function(e){  
//       $('input[name="location_id"]').val($('select[name="location_name"] option').filter(":selected").val());
// 	  $('input[name="machine_code"]').select();  
//     }); // change
});

</script>



@endsection





@extends('layouts.adminLayout.design')

@section('head')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection

@section('content')

<!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">User</li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="display">Edit User : <b>{{ $user->name }}</b>
      </h1>
      

    </header>
    <!-- Page Header-->
    <div class="row">
      <div class="col-md-12">

    <div class="card">
      <div class="card-body">
	  <form id="frm1" method="POST" action="">
                        @csrf
        <input type="hidden" name="id" value="{{ $user->id }}" />
                              
        <div class="row">
  	      <div class="form-group col-md-6">

            <div class="row">
              <div class="form-group col-md-3">
                <input type="checkbox" name="status" id="status" data-toggle="toggle" data-size="mini" 
                @if( $user->status ) checked @endif
                >
                Active 
                
              </div><!--/.col-->
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label for="register-username">First Name                </label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="first_name" value="{{ ($user->first_name!=''?$user->first_name:$user->name) }}" required autocomplete="first_name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
              </div><!--/.col-6-->

              <div class="form-group col-md-6">
                <label for="register-username">Surname                </label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" required autocomplete="last_name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
              </div><!--/.col-6-->
            </div><!--/row-->

            

            
  	      </div><!--/.col-6-->


          <div class="form-group col-md-6">
            
          </div>
        </div><!--/row-->

        


            <div class="row">
              <div class="form-group col-md-3">
                <input type="checkbox" name="is_user_pos" id="is_user_pos" data-toggle="toggle" data-size="mini" 
                @if( $user->pos_status == 1 ) checked @endif
                >
                POS 
                
              </div><!--/.col-->

              <div class="form-group col-md-3">
                <label for="password">Group : </label>
                <input type="hidden" name="pos_group_id" value="{{ $user->pos_group_id }}" />
                <select name="pos_group_name" id="pos_group_name" class="form-control">
                    <option value="">-</option>
                    @foreach($pos_groups as $val)
                    <option value="{{ $val->id }}"
                        @if($val->id==$user->pos_group_id) selected @endif 
                        >{{ $val->group_name }}</option>
                    @endforeach
                </select>
              </div><!--/.col-->

              <div class="form-group col-md-3">
                <label for="password">Branch : </label>
                <input type="hidden" name="pos_branch_id" value="{{ $user->pos_branch_id }}" />
                <select name="pos_branch_name" id="pos_branch_name" class="form-control">
                    <option value="">-</option>
                    @foreach($pos_branches as $val)
                    <option value="{{ $val->id }}"
                        @if($val->id==$user->pos_branch_id) selected @endif 
                        >{{ $val->branch_code }}</option>
                    @endforeach
                </select>
               
              </div><!--/.col-->

            </div><!--/row-->


            <div class="row">
              <div class="form-group col-md-3">
                <input type="checkbox" name="is_user_online_store" id="is_user_online_store" data-toggle="toggle" data-size="mini" 
                @if( $user->online_store_status == 1 ) checked @endif
                >
                Sales Order 
                
              </div><!--/.col-->

              <div class="form-group col-md-3">
                <label for="password">Group : </label>
                <input type="hidden" name="pos_group_id" value="{{ $user->pos_group_id }}" />
                <select name="online_store_group_name" id="online_store_group_name" class="form-control">
                    <option value="">-</option>
                    @foreach($os_groups as $val)
                    <option value="{{ $val->id }}"
                        @if($val->id==$user->online_store_group_id) selected @endif 
                        >{{ $val->group_name }}</option>
                    @endforeach
                </select>
              </div><!--/.col-->

              <div class="form-group col-md-3">
                <label for="password">Customer : </label>
                <input type="hidden" name="online_store_customer_id" value="{{ $user->online_store_customer_id }}" />
                <select name="online_store_customer_name" id="online_store_customer_name" class="form-control">
                    <option value="">-</option>
                    @foreach($os_customers as $val)
                    <option value="{{ $val->id }}"
                        @if($val->id==$user->online_store_customer_id) selected @endif 
                        >{{ $val->customer_name }}</option>
                    @endforeach
                </select>
               
              </div><!--/.col-->

            </div><!--/row-->

            
            <div class="row">
              <div class="col-md-12">
               <!--    <button type="submit" class="btn btn-primary">
                  {{ __('Save') }}
              </button> -->

                  <a href="#" name="btn_save" class="btn btn-primary">Save</a> 
              </div>
                
            </div><!--/row-->

	      <!-- Submit-->
	      
	    </form>
      </div>
      <!--/.card-body-->

      <div class="card-footer">
        <div class="col-12 d-flex no-block align-items-center">

            <div class="ml-auto text-right">
				
            </div>
        </div>
      </div>
      <!--/.card-footer-->
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
  $('#is_user_pos').bootstrapToggle();
  $('#is_user_pos').change(function() {
    if($(this).is(':checked')){
      $('select[name="pos_group_name"]').prop('disabled','');
      $('select[name="pos_branch_name"]').prop('disabled','');
    }else{
      $('select[name="pos_group_name"]').prop('disabled',true);
      $('select[name="pos_branch_name"]').prop('disabled',true);
    }
  })

  function formClear(){
		$('input[name="product_id"]').val('');
		$('input[name="produce_code"]').val('');
		$('.datepicker').datepicker('setDate', '0');
		$('select[name="machine_code"]').prop("selectedIndex", 0);
		$('input[name="machine_id"]').val('');
		$('input[name="meter"]').val(0);
		$('input[name="net_weight"]').val(0);
		$('input[name="gross_weight"]').val(0);
		$('input[name="seq_no"]').val(0);
	}
	
	// formClear();


    $('a[name="btn_save"]').click(function(e){  
      var params = {};
    //   params.product_id = $('input[name="product_id"]').val();
    //   params.product_code = $('input[name="product_code"]').val();
    //   params.issue_date = datepickerToSqlDate($('input[name="issue_date"]').val());
    //   params.machine_code = $('select[name="machine_code"] option').filter(":selected").val();
    //   params.machine_id = $('input[name="machine_id"]').val();
    //   params.meter = $('input[name="meter"]').val();
    //   params.net_weight = $('input[name="net_weight"]').val();
    //   params.gross_weight = $('input[name="gross_weight"]').val();
    //   params.seq_no = $('input[name="seq_no"]').val();
    //   params.reference_item_ids = $('input[name="reference_item_ids[]"]').val();
	//   params = $('#frm1').serialize()  + '&reference_item_ids=' + JSON.stringify(ref_items);
	var tmp = $('#frm1').serialize();
	// $.each($('input[name="reference_item_ids[]"]'), function(){
	// 	tmp=tmp+'&'+$(this).serialize();
	// });
	params = tmp;
	  console.log(tmp);
    // return;
      $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      }); 
      $.ajax({
        url: "{{ url('/admin/users2/update') }}",
        type: 'post', dataType:"json", data: params,
        success: function (res) { 
            console.log(res);
            if(res.success=="success"){
	      		 alert(res.msg);
            }else{
                
            } 
        },
        error: function(xhr, status, error) {
          console.log(xhr);
          var err = eval("(" + xhr.responseText + ")");
          alert(JSON.parse(xhr.responseText).message);
        }
      }); // /.ajax   
    }); // click


	$('select[name="pos_group_name"]').change(function(e){ 
      $('input[name="pos_group_id"]').val($('select[name="pos_group_name"] option').filter(":selected").val());  
    }); // change

    $('select[name="pos_branch_name"]').change(function(e){ 
      $('input[name="pos_branch_id"]').val($('select[name="pos_branch_name"] option').filter(":selected").val());  
    }); // change

});

</script>



@endsection





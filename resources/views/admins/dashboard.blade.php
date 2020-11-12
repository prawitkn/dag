@extends('layouts.adminLayout.design')

@section('head')
@endsection

@section('content')

<!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item active"><a href="index.html">Home</a></li>
    </ul>
  </div>
</div>
<!-- Breadcrumb-->

<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="display">
	  	Welcome to Admin
      </h1>
      

    </header>
    <!-- Page Header-->
    <div class="row">
      <div class="col-md-12">
	  </div>
	  <!--/.col-->
	</div>
	<!--/.row-->

  </div>
  <!--/.containter-fluid-->
</section> 

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
</style>

<script type="text/javascript">
$(document).ready(function(){

    

    $('select[name="customer_markets"]').on('change',function(){ 
        var tmp = $(this); 
        var params = {
                id: $(this).attr('data-ref_id'),
                value: $(this).find(':selected').val()
            };       
        console.log(params);
        //alert(params.value);
        
        $.ajaxSetup({
              headers: { 
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          }); 
         $.ajax({
            url: "{{ url('/sales-dashboard/set-customer_application_type') }}",
            type: 'post',
            dataType:"json",
            data: params,
            error: function(xhr, status, error) {
                //console.log(xhr);
              var err = eval("(" + xhr.responseText + ")");
              alert(JSON.parse(xhr.responseText).message);
            },
            success: function (data) { 
                if(data.success=="success"){
                    tmp.parents("tr:first").css('background-color','green').fadeOut('slow').css('background-color','white').fadeIn('slow');                    
                }else{
                    tmp.parents("tr:first").css('background-color','red').fadeOut('slow').css('background-color','white').fadeIn('slow');
                    alert('msg');
                } 
            }
        }); // /.ajax   
    }); //. $('#grading_group_id').change(function(){ 


    $('select[name="customer_importances"]').on('change',function(){ 
        var tmp = $(this); 
        var params = {
                id: $(this).attr('data-ref_id'),
                value: $(this).find(':selected').val()
            };       
        console.log(params);
        //alert(params.value);        
        $.ajaxSetup({
              headers: { 
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          }); 
         $.ajax({
            url: "{{ url('/sales-dashboard/set-customer_importance') }}",
            type: 'post',
            dataType:"json",
            data: params,
            error: function(xhr, status, error) {
                //console.log(xhr);
              var err = eval("(" + xhr.responseText + ")");
              alert(JSON.parse(xhr.responseText).message);
            },
            success: function (data) { 
                if(data.success=="success"){
                    tmp.parents("tr:first").css('background-color','green').fadeOut('slow').css('background-color','white').fadeIn('slow');                    
                }else{
                    tmp.parents("tr:first").css('background-color','red').fadeOut('slow').css('background-color','white').fadeIn('slow');
                    alert('msg');
                } 
            }
        }); // /.ajax   
    }); //. $('#grading_group_id').change(function(){ 

    //Modal Next Step
    $('a[name="btn_latest_journeyed_at"]').click(function(){ //alert('big');
        //alert($(this).attr('data-ref-id'));
        getLatestSalesJourney($(this).attr('data-ref_id'));
        $('#modalNextStep').modal('show');         
        // $('#modalSearchCustomer input[name="refId"]').val($(this).attr('data-id')); 
        // $('#modalSearchCustomer input[name="refId"]').attr('data-return-id',$(this).parent().find('input:hidden:first').attr('name'));

        // $('#modalSearchCustomer input[name="search_keyword"]').select();
    }); //. $('a[name=btnSearchEvaluator]').click(function(){ 

    $('a[name="searchCustomerCodeRemove"]').click(function(){ //alert('big');
        //$('input[name="searchCustomerId"]').val('');
        $(this).parent().find('input:hidden:first').val('');
        $(this).parent().find('a:first').text('Search')
        // $('a[name="searchCustomerCode"]').text('ค้นหา');
    }); //. $('a[name=btnSearchEvaluator]').click(function(){ 

    function getLatestSalesJourney(search_keyword){ 
        var params = {
                id: search_keyword
            };       //alert(params.id);
        $.ajaxSetup({
              headers: { 
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          }); 
            var tmpUrl = '{{ url('/sales-dashboard/get-latest_sales_journey_by_cust_id') }}'+'/'+params.id;
         $.ajax({
            url: tmpUrl,
            type: 'post',
            dataType:"json",
            error: function(xhr, status, error) {
                console.log(xhr);
              // var err = eval("(" + xhr.responseText + ")");
              // alert(JSON.parse(xhr.responseText).message);
            },
            success: function (data) { //alert(data.row_count);
                console.log(data);
                $('#modalNextStepDetails textarea').empty();
                if(data.row_count==0){
                    //
                }else{ //alert(JSON.parse(data.items));
                    var val = data.items;
                    $('h4[name="modal_customer_name"]').text(val.customer_name);
                    $('span[name="modal_issue_date"]').text(val.issue_date.substring(0,10));
                    $('span[name="modal_salesman_name"]').text(val.salesman_name);
                    $('input[name="modal_topic"]').val(val.title);
                    $('textarea[name="modal_details"]').val(val.desc);
                    $('textarea[name="modal_next_step"]').val(val.next_step);
                    
                    var baseUrl = '{{ asset('storage/app/sales_journeys') }}';
                    $('span[name="left_file"]').empty();
                    $.each(data.files, function(key,value){
                        console.log(value);
                        var tmpHtml = '<a target="_blank" href="'+baseUrl+'/'+value.sales_journey_id+'/'+'files'+'/'+value.sales_journey_file_name+'" >'+value.sales_journey_file_display_name+'</a><br/>';                        
                        $('span[name="left_file"]').append(tmpHtml); 
                    });
                    $.each(data.images, function(key,value){
                        console.log(value);

                        var tmpHtml = '<a target="_blank" href="'+baseUrl+'/'+value.sales_journey_id+'/'+'images'+'/'+value.sales_journey_photo_name+'" >'+
                        '<a href="'+baseUrl+'/'+value.sales_journey_id+'/'+'images'+'/'+value.sales_journey_photo_name+'" data-fancybox="images" data-caption="'+value.sales_journey_photo_display_name+'" >'+
                        '<img style="width: 100px;" src="'+baseUrl+'/'+value.sales_journey_id+'/'+'images'+'/'+value.sales_journey_photo_name+'" '+
                            'alt="'+value.sales_journey_photo_display_name+'" '+
                            '/>'+
                        '</a>';  
                        $('span[name="left_file"]').append( tmpHtml+'&nbsp;');  
                    });
                }    
            }
        }); // /.ajax        
    }
    //Modal Next Step





    //Modal New Customer Begin
    $('a[name="btn_new_customer"]').click(function(){ //alert('big');
        //alert($(this).attr('data-ref-id'));
        //getLatestSalesJourney($(this).attr('data-ref-id'));
        $('#modalNewCustomer').modal('show');         
        // $('#modalSearchCustomer input[name="refId"]').val($(this).attr('data-id')); 
        // $('#modalSearchCustomer input[name="refId"]').attr('data-return-id',$(this).parent().find('input:hidden:first').attr('name'));

        // $('#modalSearchCustomer input[name="search_keyword"]').select();
    }); //. $('a[name=btnSearchEvaluator]').click(function(){ 

    $('a[name="searchCustomerCodeRemove"]').click(function(){ //alert('big');
        //$('input[name="searchCustomerId"]').val('');
        $(this).parent().find('input:hidden:first').val('');
        $(this).parent().find('a:first').text('Search')
        // $('a[name="searchCustomerCode"]').text('ค้นหา');
    }); //. $('a[name=btnSearchEvaluator]').click(function(){ 
    //Modal New Customer End




    $('select[name="sid"]').change(function(){  //alert('big');
        var sid=$(this).val();
        window.location.href = "{{ url('/sales-dashboard') }}?sid="+sid;
    }); //. $('a[name=applyTopicListEmployee]').click(function(){ 

    $('input[name="search_customer_name"]').keypress(function(){  //alert('big');
        // var salesman_id=$(this).val();
        // window.location.href = "{{ url('/sales-dashboard') }}/"+salesman_id+"/0";
    }); //. $('a[name=applyTopicListEmployee]').click(function(){ 

    $('i[name="btnIsVisit"]').click(function(){ //alert('big');
        var tmp = $(this); 
        var params = {
                id: $(this).attr('data-ref_id'),
                value: $(this).attr('data-set_visit_value')
            };       
        console.log(params);
        //alert(params.value);
        
        $.ajaxSetup({
              headers: { 
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          }); 
         $.ajax({
            url: "{{ url('/sales-dashboard/set-customer_is_visit') }}",
            type: 'post',
            dataType:"json",
            data: params,
            error: function(xhr, status, error) {
                //console.log(xhr);
              var err = eval("(" + xhr.responseText + ")");
              alert(JSON.parse(xhr.responseText).message);
            },
            success: function (data) { 
                if(data.success=="success"){
                    // alert('success');
                    switch(params.value){
                        case "1" : 
                            tmp.attr('data-set_visit_value',0);
                            tmp.toggleClass('fas fa-star far fa-star');
                            var row = tmp.parents("tr:first");
                            row.insertBefore(tmp.parents("tbody").children("tr:first"));
                            break;
                        case "0" : 
                            tmp.attr('data-set_visit_value',1);
                            tmp.toggleClass('far fa-star fas fa-star'); 
                            var row = tmp.parents("tr:first");
                            row.insertAfter(tmp.parents("tbody").children("tr:last"));
                            break;
                        default : alert('default');
                    }
                }else{
                    alert('msg');
                } 
            }
        }); // /.ajax   
    }); //. i[name="btnIsVisit"]').click(function(){
        
    $('div[name="divProgress"]').click(function(){ //alert('bigbar');
        var tmp = $(this);
        var params = {
                id: $(this).attr('data-ref_id'),
                value: $(this).attr('data-current_progress_level')
            };       
        console.log(params);
        $.ajaxSetup({
              headers: { 
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          }); 
         $.ajax({
            url: "{{ url('/sales-dashboard/set-customer_progress_level') }}",
            type: 'post',
            dataType:"json",
            data: params,
            error: function(xhr, status, error) {
                //console.log(xhr);
              var err = eval("(" + xhr.responseText + ")");
              alert(JSON.parse(xhr.responseText).message);
            },
            success: function (data) { 
                if(data.success=="success"){
                     // alert('success');
                    tmp.attr('style','width: '+data.current_progress_level+'%');
                    tmp.attr('data-current_progress_level',data.current_progress_level);
                    
                    switch(data.current_progress_level){
                        case 20 : 
                            tmp.text(1);
                            tmp.removeClass('bg-dark'); tmp.addClass('bg-danger'); 
                            break;
                        case 40 : 
                            tmp.text(2);
                            tmp.removeClass('bg-danger'); tmp.addClass('bg-warning'); 
                        break;
                        case 60 : 
                            tmp.text(3);
                            tmp.removeClass('bg-warning'); tmp.addClass('bg-info');
                        break;
                        case 80 : 
                            tmp.text(4);
                            tmp.removeClass('bg-info'); tmp.addClass('bg-primary');  
                        break;
                        case 100 : 
                            tmp.text(5);
                            tmp.removeClass('bg-primary'); tmp.addClass('bg-success'); 
                        break;
                        default : 
                            tmp.text('-');
                            tmp.removeClass('bg-success'); tmp.addClass('bg-dark');
                    }
                }else{
                    alert('msg');
                } 
            }
        }); // /.ajax   
    }); //. $('a[name=btnSearchEvaluator]').click(function(){ 

        

    $('select[name="country_id"]').on('change',function(){ //alert();
        switch($(this).find(":selected").val()){
            case "1" : //alert(1);
                // $('#customer_location_type_2').attr('checked', false);
                // $('#customer_location_type_1').attr('checked', true);
                $('a[name="customer_location_type_2"]').removeClass('btn btn-success').addClass('btn btn-light');
                $('a[name="customer_location_type_1"]').removeClass('btn btn-light').addClass('btn btn-success');
                $('#customer_location_type_id').val(1);
                break;
            default :  //alert('default');
                // $('#customer_location_type_1').attr('checked', false);
                // $('#customer_location_type_2').attr('checked', true);
                $('a[name="customer_location_type_1"]').removeClass('btn btn-success').addClass('btn btn-light');
                $('a[name="customer_location_type_2"]').removeClass('btn btn-light').addClass('btn btn-success');
                $('#customer_location_type_id').val(2);
        }
    }); //. $('#grading_group_id').change(function(){    

    //On Load
    $('#customer_location_type_1').attr('checked', true); 
});
</script>


@endsection

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/images/favicon.png') }}">
    <title>AK : Sales Dashboard</title>
    <!-- Custom CSS -->
    <link href="{{ asset('public/assets/libs/flot/css/float-chart.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('public/dist/css/style.min.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- <link href="{{ asset('public/fonts/thsarabunnew/thsarabunnew.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('storage/app/fonts/thsarabunnew/thsarabunnew.css') }}" rel="stylesheet">
    <style>
        /*@font-face {
            font-family: 'THSarabunNew';
            src: url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew-webfont.eot') }});
            src: url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew-webfont.eot?#iefix') }}) format('embedded-opentype');
                 url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew-webfont.woff') }}) format('woff');
                 url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew-webfont.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: normal;
        }*/
        /*
        @font-face {
            font-family: 'THSarabunNew';
            src: url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew_bolditalic-webfont.eot') }});
            src: url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew_bolditalic-webfont.eot?#iefix') }}) format('embedded-opentype');
                 url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew_bolditalic-webfont.woff') }}) format('woff');
                 url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew_bolditalic-webfont.ttf') }}) format('truetype');
            font-weight: bold;
            font-style: italic;
        }
        @font-face {
            font-family: 'THSarabunNew';
            src: url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew_italic-webfont.eot') }});
            src: url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew_italic-webfont.eot?#iefix') }}) format('embedded-opentype');
                 url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew_italic-webfont.woff') }}) format('woff');
                 url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew_italic-webfont.ttf') }}) format('truetype');
            font-weight: normal;
            font-style: italic;
        }

        @font-face {
            font-family: 'THSarabunNew';
            src: url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew_bold-webfont.eot') }});
            src: url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew_bold-webfont.eot?#iefix') }}) format('embedded-opentype');
                 url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew_bold-webfont.woff') }}) format('woff');
                 url({{ asset('storage/app/fonts/thsarabunnew/thsarabunnew_bold-webfont.ttf') }}) format('truetype');
            font-weight: bold;
            font-style: normal;
        }*/       
      *, html, body {
        font-family: serif;
     /*   font-family: THSarabunNew;
        font-weight: bold !important;*/
      }
        i.icon {
        font-family: sans-serif !important;
      }


      table input[type="radio"] {
            -ms-transform: scale(1.5); /* IE 9 */
            -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
            transform: scale(1.5);
        }
      }
    </style>
    
    
@yield('head')

</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

@include('layouts.salesJourneyLayout.sj_header')

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    
    <div id="main-wrapper" class="" data-sidebartype="full">
   <!--  <div id="main-wrapper" class="mini-sidebar" data-sidebartype="full"> -->

 

@yield('content')

@include('layouts.salesJourneyLayout.sj_footer')      
        
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('public/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Bootstrap tether Core JavaScript -->
     <script src="{{ asset('public/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('public/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('public/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/extra-libs/sparkline/sparkline.js') }}"></script>

    <!--Wave Effects -->
    <script src="{{ asset('public/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('public/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('public/dist/js/custom.min.js') }}"></script>

    <!--This page JavaScript -->
    <!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="{{ asset('public/assets/libs/flot/excanvas.js') }}"></script>
    <script src="{{ asset('public/assets/libs/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('public/assets/libs/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('public/assets/libs/flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('public/assets/libs/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('public/assets/libs/flot/jquery.flot.crosshair.js') }}"></script>
    <script src="{{ asset('public/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>



  
    <!-- <script src="{{ asset('dist/js/pages/chart/chart-page-init.js') }}"></script> -->
    
    <!-- Jquery Validation -->
     <!-- <script src="{{ asset('public/assets/libs/jquery-validation/dist/localization/messages_th.js') }}"></script> 
    <script src="{{ asset('public/assets/libs/jquery-validation/dist/additional-methods.js') }}"></script> -->
    <!-- Jquery Validation -->
    <script src="{{ asset('public/assets/libs/bootstrap-validate/dist/bootstrap-validate.js') }}"></script>

    <!-- datatable js -->
    <script src="{{ asset('public/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ asset('public/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>

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

    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
         

        //  $('table.zero_config').DataTable({
        //     fixedHeader: true
        //     , stateSave: true
        // });

    </script>

    <!-- <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    </script> -->
<script type="text/javascript">

    $(document).ready(function(){
        
        

        $('#current_pwd').focusout(function(){
            var current_pwd=$('#current_pwd').val();
            $.ajax({
                target:'get',
                url: '{{ url('/admin/check-pwd') }}',
                data:{current_pwd:current_pwd
                },success:function(resp){
                    if(resp=="false"){
                        $('#chkPwd').html('<font color="red">Current Password Is Incorrect</font>');
                    }else{
                        $('#chkPwd').html('<font color="green">Current Password Is Correct</font>');
                    }
                },error:function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });//$('#current_pwd').focusout(function(){

        $('.btn-deleteCategory').click(function(){
            if(prompt('Please enter "DELETE" for delete.', '')==="DELETE"){ 
                return true;
            }
            return false;
        });//$('#current_pwd').focusout(function(){

        $('.btn-setActiveMaster').click(function(){
            if(confirm('Are you sure ?', '')){ 
                return true;
            }
            return false;
        });// $('.btn-deleteMaster').click(function(){
            
        $('.btn-editMaster').click(function(){
            if(prompt('Please enter "edit" in Capital letters for edit.', '')==="EDIT"){ 
                return true;
            }
            return false;
        });// $('.btn-deleteMaster').click(function(){

        // $('.btn-deleteMaster').click(function(){
        //     if(prompt('Please enter "delete" in Capital letters for delete.', '')==="DELETE"){ 
        //         return true;
        //     }
        //     return false;
        // });// $('.btn-deleteMaster').click(function(){
            
        $(document).on('click', 'a.btn-deleteMaster', function(){ // alert('big');
            if(prompt('Please enter "delete" in Capital letters for delete.', '')==="DELETE"){ 
                return true;
            }
            return false;
        }); //. $('button[name="btn_latest_journeyed_save"]').on('click',function(){  

        $('.btn-closeTerm').click(function(){
            if(prompt('Please enter "close" in Capital letters for close.', '')==="CLOSE"){ 
                return true;
            }
            return false;
        });// $('.btn-deleteMaster').click(function(){
        
        $('.ddl_evaluator_all').change(function(){
            if(prompt('Please enter "delete" in Capital letters for delete.', '')==="DELETE"){ 
                return true;
            }
            return false;
        });//$('#current_pwd').focusout(function(){


        $('#btnReGradingGroup').click(function(){ //alert('#btnReGradingGroup');
            var gradedCount = $(this).attr('data-graded'); //alert(gradedCount);
            if(confirm('คุณต้องการแก้ไขกลุ่มการตัดเกรดใหม่ โดยมีจำนวน '+gradedCount+'รายการ ที่มีการตัดเกรดไว้แล้ว ใช่หรือไม่', 'ยืนยันการทำงาน')){ 
                // return true;
                $('#frmReGradingGroup').submit();
            }
            return false;
        });

        $('#btnGrading').click(function(){ //alert('#btnReGradingGroup');
            var gradedCount = $(this).attr('data-graded'); //alert(gradedCount);
            if(confirm('คุณต้องการตัดเกรด โดยมีจำนวน '+gradedCount+'รายการ ที่มีการตัดเกรดไว้แล้ว ใช่หรือไม่', 'ยืนยันการทำงาน')){ 
                //return true;
                if(prompt('ป้องคำว่า "GRADING" เพื่อยืนยันการคำนวณเกรด', '')==="GRADING"){                    
                    $('#frmGradingCalc').submit();
                }else{ alert('ยกเลิกการคำนวณเกรด'); }
            }
            return false;
        });

    });//$(document).ready(function(){
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('a[name=btnPrev]').click(function(){ alert('btnPrev');            
            $('input[name=next_topic_group_id]').val($(this).attr("data-topic_id"));
            alert($('input[name=next_topic_group_id]').val());
            
            document.form1.submit();
        });//$('#current_pwd').focusout(function(){

        $('a[name=btnNext]').click(function(){ alert('btnNext');
            $('input[name=next_topic_group_id]').val($(this).attr("data-topic_id"));
            alert($('input[name=next_topic_group_id]').val());
            
            $.ajax({
                url: '/evaluates/save-evaluate',
                type: 'post',
                dataType: 'json',
                data: $('form#form1').serialize(),
                success: function(data) {
                         }
            });  
        });//$('#current_pwd').focusout(function(){  

    });//$(document).ready(function(){
</script>


<!-- Set default evaluator -->
<script type="text/javascript">
    $(document).ready(function(){

        $('a[name=btnSearchEvaluator]').click(function(){ 
            //alert('btnSearchEvaluator');
            var params = {
                position_rank_id: $(this).attr('data-position_rank_id').val()
            };
             alert(params.position_rank_id);
            $.ajax({
                url: '/evaluates/list-evaluator',
                type: 'post',
                dataType: 'json',
                data: params,
                success: function(data) {
                         }
            }); 
        }); //. $('a[name=btnSearchEvaluator]').click(function(){


        




        //SEARCH Employee Begin
        $('a[name="searchEmployeeCode"]').click(function(){ //alert('big');
            $('#modalSearchEmployee').modal('show');         
            $('#modalSearchEmployee input[name="refId"]').val($(this).attr('data-id')); 
            $('#modalSearchEmployee input[name="refId"]').attr('data-return-id',$(this).parent().find('input:hidden:first').attr('name'));

            $('#modalSearchEmployee input[name="searchWord"]').select();
        }); //. $('a[name=btnSearchEvaluator]').click(function(){ 

        $('a[name="searchEmployeeCodeRemove"]').click(function(){ //alert('big');
            //$('input[name="searchEmployeeId"]').val('');
            $(this).parent().find('input:hidden:first').val('');
            $(this).parent().find('a:first').text('ค้นหา')
            // $('a[name="searchEmployeeCode"]').text('ค้นหา');
        }); //. $('a[name=btnSearchEvaluator]').click(function(){ 

        function searchEmployee(searchWord){ 
            var params = {
                    searchWord: searchWord
                };       
            //alert(params.searchWord);
            $.ajaxSetup({
                  headers: { 
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              }); 
             $.ajax({
                url: "{{ url('/employees/list-employees') }}",
                type: 'get',
                dataType:"json",
                data: params,
                error: function(xhr, status, error) {
                    //console.log(xhr);
                  var err = eval("(" + xhr.responseText + ")");
                  alert(JSON.parse(xhr.responseText).message);
                },
                success: function (data) { 
                    $('#modalSearchEmployee table tbody').empty();
                    if(data.rowCount==0){
                        //
                    }else{
                        $.each($.parseJSON(data.data), function(key,value){
                            $('#modalSearchEmployee table tbody').append(
                            '<tr>' +
                                '<td style="text-align: center;">' +
                                '   <div class="btn-group">' +
                                '   <a href="javascript:void(0);" data-name="searchRadio" ' +
                                '   data-id="'+value.id+'" ' +
                                '   data-code="'+value.person_full_name+'" ' +
                                '   class="btn" title="เลือก"> ' +
                                '   <i class="mdi mdi-checkbox-blank-outline"></i> </a> ' +
                                '   </div>' +
                                '</td>' + 
                                '<td style="display: none;">'+ value.id +'</td>' +
                                '<td style="text-align: center;">'+ value.person_full_name +'</td>' +
                                '<td style="text-align: center;">'+ value.position_name +'</td>' +
                            '</tr>'
                            );      
                        });
                    }    
                }
            }); // /.ajax        
        }

        $('#modalSearchEmployee input[name="searchWord"]').keyup(function(e){ 
            searchEmployee($(this).val());
        });

        $(document).on("click",'#modalSearchEmployee a[data-name="searchRadio"]',function() {
            // $('input[name='+curId+']').val($(this).closest("tr").find('td:eq(1)').text());
            // $('input[name='+curName+']').val($(this).closest("tr").find('td:eq(2)').text());
            // alert($(this).attr('data-id'));
            // alert($(this).attr('data-code'));
            refId = $('#modalSearchEmployee [name="refId"]').val();
            returnId = $('#modalSearchEmployee [name="refId"]').attr('data-return-id');
            $('a[name="searchEmployeeCode'+refId+'"]').text($(this).attr('data-code'));  
            $('input[name="'+returnId+''+refId+'"]').val($(this).attr('data-id'));
            $('#modalSearchEmployee').modal('hide');
            //getList();
        });
        //Search Employee End










        //SEARCH Evaluator Begin
        $('a[name="searchEvaluatorCode"]').click(function(){ //alert('big');
            $('#modalSearchEvaluator').modal('show');  

            // get div ID
            refDivGroupId = $(this).parent().parent().find('div[name="searchEvaluator"]').attr('id');
            $('#modalSearchEvaluator input[name="refDivGroupId"]').val(refDivGroupId); 
            // get different element name for post
            returnElementName = $(this).parent().find('input:hidden:first').attr('name');
            $('#modalSearchEvaluator input[name="refDivGroupId"]').attr('data-return-elelment-name', returnElementName);

            // get item ID
            //returnElementName = $(this).parent().find('input:hidden:first').attr('name');
            $('#modalSearchEvaluator input[name="refDivGroupId"]').attr('data--id', $(this).attr('data-item-id'));
            searchEvaluator('', $(this).attr('data-item-id'));
            $('#modalSearchEvaluator input[name="searchWord"]').select();
        }); //. $('a[name=btnSearchEvaluator]').click(function(){ 

        $('a[name="searchEvaluatorCodeRemove"]').click(function(){ //alert('big');
            //$('input[name="searchEvaluatorId"]').val('');
            $(this).parent().find('input:hidden:first').val('');
            $(this).parent().find('a:first').text('ค้นหา')
            // $('a[name="searchEvaluatorCode"]').text('ค้นหา');
        }); //. $('a[name=btnSearchEvaluator]').click(function(){ 

        function searchEvaluator(searchWord, position_rank_id){ 
            var params = {
                    searchWord: searchWord,
                    position_rank_id: position_rank_id
                };       
            //alert(params.employee_id);
            console.log(params);
            $.ajaxSetup({
                  headers: { 
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              }); 
             $.ajax({
                url: "{{ url('/employees/list-evaluators') }}",
                type: 'get',
                dataType:"json",
                data: params,
                error: function(xhr, status, error) {
                    //console.log(xhr);
                  var err = eval("(" + xhr.responseText + ")");
                  alert(JSON.parse(xhr.responseText).message);
                },
                success: function (data) { 
                    $('#modalSearchEvaluator table tbody').empty();
                    if(data.rowCount==0){
                        //
                    }else{
                        $.each($.parseJSON(data.data), function(key,value){
                            $('#modalSearchEvaluator table tbody').append(
                            '<tr>' +
                                '<td style="text-align: center;">' +
                                '   <div class="btn-group">' +
                                '   <a href="javascript:void(0);" data-name="searchRadio" ' +
                                '   data-id="'+value.id+'" ' +
                                '   data-code="'+value.person_full_name+'" ' +
                                '   class="btn" title="เลือก"> ' +
                                '   <i class="mdi mdi-checkbox-blank-outline"></i> </a> ' +
                                '   </div>' +
                                '</td>' + 
                                '<td style="display: none;">'+ value.id +'</td>' +
                                '<td style="text-align: center;">'+ value.person_full_name +'</td>' +
                                '<td style="text-align: center;">'+ value.position_name +'</td>' +
                            '</tr>'
                            );      
                        });
                    }    
                }
            }); // /.ajax        
        }

        $('#modalSearchEvaluator input[name="searchWord"]').keyup(function(e){ 
            searchEvaluator($(this).val(), $('#modalSearchEvaluator input[name="refDivGroupId"]').attr('data-item-id') );
        });

        $(document).on("click",'#modalSearchEvaluator a[data-name="searchRadio"]',function() {
            dataCode = $(this).attr('data-code');
            dataId = $(this).attr('data-id');

            refDivGroupId = $('#modalSearchEvaluator [name="refDivGroupId"]').val();
            returnElementName = $('#modalSearchEvaluator [name="refDivGroupId"]').attr('data-return-elelment-name'); //alert(returnElementName);
            $('#'+refDivGroupId+' a[name="searchEvaluatorCode"]').text(dataCode);  
            $('#'+refDivGroupId+' input[name="'+returnElementName+'"]').val(dataId);
            $('#modalSearchEvaluator').modal('hide');
            //getList();

            // if Header Search
            if(refDivGroupId=="searchEvaluator01"){
                $('#table_evaluator_setting tr').each(function() {
                    $(this).find('td:eq(5)').find('a[name="searchEvaluatorCode"]').text(dataCode);
                    $(this).find('td:eq(5)').find('input[type="hidden"]').val(dataId);
                });
            }
        });
        //Search Evaluator End

        $('#grading_group_id_hd').change(function(){ 
            var grading_group_id = $('#grading_group_id_hd option:selected').val();
            //alert(grading_group_id);
            $('#table_evaluator_setting tr').each(function() {
                //alert($(this).find('td:eq(4) select').val(grading_group_id));
                $(this).find('td:eq(4) select').val(grading_group_id);
                //$(this).find('td:eq(4)').find('select').val(grading_group_id);
            });
        }); //. $('#grading_group_id').change(function(){ 

        $('#final_grading_group_id_hd_grading').change(function(){ 
            var final_grading_group_id = $('#final_grading_group_id_hd_grading option:selected').val();
            //alert(final_grading_group_id);
            $('.table_grading tr').each(function() {
                //alert($(this).find('td:eq(4) select').val(grading_group_id));
                $(this).find('td:eq(4) select').val(final_grading_group_id);
                //$(this).find('td:eq(4)').find('select').val(grading_group_id);
            });
        }); //. $('#grading_group_id').change(function(){ 


        //Topic
        $('#frmTopicList button[type="submit"]').attr('disabled','disabled');

        $('input[name="checkedTopicIds[]"]').on('change',function(){ 
            $('#frmTopicList button[type="submit"]').attr('disabled','disabled');
            var checkedCount=0;
            $('input[name="checkedTopicIds[]"]').each(function () {
                //alert($(this).parent().parent().html());
                if(this.checked){
                    $(this).parent().parent().find('td input[name="checkedSeqNos[]"]').prop("disabled", false).select();
                    checkedCount = checkedCount+1;
                }else{
                    $(this).parent().parent().find('td input[name="checkedSeqNos[]"]').val('0').attr('disabled','disabled');
                }
            }); //alert(checkedCount);
            if(checkedCount>0){
                //alert('checked');
                $('#frmTopicList button[type="submit"]').prop("disabled", false);
            }
        }); //. $('#grading_group_id').change(function(){ 


            
        $('#frmApplyTopicsToEmployees a').attr('data-checked','0');
        $("#frmApplyTopicsToEmployees").on('change', 'input[name="checkedEmployeeIds[]"]', function(){
             $('#frmApplyTopicsToEmployees a').attr('data-checked','0');
            var checkedCount=0;
            $('input[name="checkedEmployeeIds[]"]').each(function () {
                checkedCount = (this.checked ? checkedCount+=1 : checkedCount );
            }); //alert(checkedCount);
            if(checkedCount>0){
                $('#frmApplyTopicsToEmployees a').attr('data-checked',checkedCount);
            }
        });


        

        // Apply topics to employees.
        $('a[name="btnApplyTopicListEmployeeSearch"]').click(function(){ //alert('big');
            var params = {
                    grading_group_id: $('select[name="grading_group_id"] :selected').val(),
                    position_rank_id: $('select[name="position_rank_id"] :selected').val(),
                    section_id: $('select[name="section_id"] :selected').val(),
                    department_id: $('select[name="department_id"] :selected').val() 
                };       
            //alert(params.searchWord);
            $.ajaxSetup({
                  headers: { 
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              }); 
             $.ajax({
                url: "{{ url('/employees/filter-list-employee') }}",
                type: 'get',
                dataType:"json",
                data: params,
                error: function(xhr, status, error) {
                    //console.log(xhr);
                  var err = eval("(" + xhr.responseText + ")");
                  alert(JSON.parse(xhr.responseText).message);
                },
                success: function (data) { 
                    $('table[name="tblApplyEmployees"] tbody').empty();
                    if(data.rowCount==0){
                        //
                    }else{
                        $.each($.parseJSON(data.data), function(key,value){
                            $('table[name="tblApplyEmployees"] tbody').append(
                            '<tr>' +
                                '<td style="text-align: center;">' +
                                ' <input type="checkbox" name="checkedEmployeeIds[]" value="'+value.id+'" >'+
                                '</td>' + 
                                '<td style="text-align: center;">'+ value.person_full_name +'</td>' +
                                '<td style="text-align: center;">'+ value.position_name +'</td>' +
                            '</tr>'
                            );      
                        });
                    }    
                }
            }); // /.ajax     
        }); //. $('a[name=applyTopicListEmployee]').click(function(){ 


    $('a[name="btnApplyTopicListEmployeeSubmitReNew"]').click(function(){
        // Valid.
        if($(this).attr('data-checked')=="0"){
            alert("กรุณาเลือกพนักงานอย่างน้อย 1 รายการ");
            return false;
        }
        $('[name="apply_type_name"]').val('reNew');

        $('#frmApplyTopicsToEmployees').submit();
    }); //. $('a[name=btnApplyTopicListEmployeeSubmitReNew]').click(function(){ 

    $('a[name="btnApplyTopicListEmployeeSubmitAppend"]').click(function(){ 
        // Valid.
        if($(this).attr('data-checked')=="0"){
            alert("กรุณาเลือกพนักงานอย่างน้อย 1 รายการ");
            return false;
        }
        $('[name="apply_type_name"]').val('append');

        $('#frmApplyTopicsToEmployees').submit();
    }); //. $('a[name=btnApplyTopicListEmployeeSubmitReNew]').click(function(){ 


});//$(document).ready(function(){
</script>


</body>

@yield('footer')

</html>

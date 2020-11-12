@extends('layouts.productLibraryLayout.prodlib_design')
@section('content')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Register</h4>

                        <a href="#" name="formAdd" data-id="" class="btn btn-outline-primary" ><i class="fa fas-plus"></i> New</a>

                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Register</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12">
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

                <div class="card">
                <form id="form1" class="" enctype="multipart/form-data" method="post" action="{{ url('/prodlib/add-product') }}" >{{ csrf_field() }}



                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Product</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Specification</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">Files</a>
                  </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane container active" id="home">
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="product_code" type="text" class="form-control" name="product_code" placeholder="Product Code"   value="" required >
                                </div>
                                <div class="form-group">
                                    <input id="width" type="text" class="form-control" name="width" placeholder="Width"   value=""  >
                                </div>
                            </div>
                            <!--/.col-3-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="product_name" type="text" class="form-control" name="product_name" placeholder="Product Name"   value="" required >
                                </div>
                            </div>
                            <!--/.col-3-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <textarea id="product_desc" type="text" class="form-control" name="product_desc" placeholder="Product Description"></textarea>
                                </div>
                            </div>
                            <!--/.col-3-->
                        </div>
                        <!--/.row-->

                        
                  </div>

                  <div class="tab-pane container fade" id="menu1">
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input id="rc" type="text" class="form-control" name="rc" placeholder="%RC" value="" >
                                </div>
                            </div>
                            <!--/.col-3-->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id=" working_temperature" type="text" class="form-control" name="working_temperature" placeholder="Working Temperature (°C)" value="" >
                                </div>
                            </div>
                            <!--/.col-4-->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="thickness" type="text" class="form-control" name="thickness" placeholder="Thickness(mm.)" value="" >
                                </div>
                            </div>
                            <!--/.col-4-->
                        </div>
                        <!--/.row-->


                        
                        <div class="row">
                            <div class="row col-md-6">
                                <label for="weight_gm" class="col-md-4 col-form-label">Weight</label>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input id="weight_gm" type="text" class="form-control" name="weight_gm" placeholder="g/m2" value="" >
                                    </div>
                                </div>
                                <!--/.col-4-->

                               <div class="col-md-4">
                                    <div class="form-group">
                                        <input id="weight_ozyd" type="text" class="form-control" name="weight_ozyd" placeholder="oz/yd2" value="" >
                                    </div>
                                </div>
                                <!--/.col-4-->                                   
                            </div>
                            <!--/.col-md-6-->

                            <div class="row col-md-6">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="tensile_strength_warp_kgfin" type="text" class="form-control" name=" tensile_strength_warp_kgfin" placeholder="Warp (Kgf/in)" value="" >
                                    </div>
                                </div>
                                <!--/.col-4-->
 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="tensile_strength_warp_nin" type="text" class="form-control" name="tensile_strength_warp_nin" placeholder="Warp (N/in)" value="" >
                                    </div>
                                </div>
                                <!--/.col-4-->
                            </div>
                            <!--/.col-md-6-->
                        </div>
                        <!--/.row-->

                        <div class="row">
                            <div class="row col-md-6">
                                <label for="product_type_of_yarn_id" class="col-md-4 col-form-label">Density (Pick/in)</label>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input id="density_pick_warp" type="text" class="form-control" name="density_pick_warp" placeholder="Warp" value="" >
                                    </div>
                                </div>
                                <!--/.col-4-->

                               <div class="col-md-4">
                                    <div class="form-group">
                                        <input id="density_pick_weft" type="text" class="form-control" name="density_pick_weft" placeholder="Weft" value="" >
                                    </div>
                                </div>
                                <!--/.col-4-->                                   
                            </div>
                            <!--/.col-md-6-->

                            <div class="row col-md-6">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="tensile_strength_weft_kgfin" type="text" class="form-control" name="tensile_strength_weft_kgfin" placeholder="Weft (Kgf/in)" value="" >
                                    </div>
                                </div>
                                <!--/.col-4-->   

                               <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="tensile_strength_weft_nin" type="text" class="form-control" name="tensile_strength_weft_nin" placeholder="Weft (N/in)" value="" >
                                    </div>
                                </div>
                                <!--/.col-4-->    
                            </div>
                            <!--/.col-md-6-->
                        </div>
                        <!--/.row-->
                        
                  </div>
                  <!--/.tab-menu1-->

                  <div class="tab-pane container fade" id="menu2">
                        <div class="row"  style="margin-top: 5px;">
                            <div class="col-md-6">
                                <label for="upload_files[]" class="col-md-2 col-form-label">DTS</label>
                                <a href="#" name="btn_dts_add" class="btn btn-primary"><i class="mdi mdi-plus"></i> New DTS</a>
                                <div name="div_upload_files" class="col-md-12">
                                    <!--<div class="row">
                                        <div class="col-md-6">
                                            <input type="file" name="upload_files[]" id="upload_files[]"  class="form-control" />
                                        </div>--><!--/.col-3-->
                                        <!--<div class="col-md-6">
                                            <input type="text" name="upload_file_display_name[]" class="form-control" placeholder="DTS file name" />
                                        </div>--><!--/.col-9-->
                                    <!--</div>--><!--/.row-->
                                </div>
                                <!--/.div_upload_file-->

                                <div class="row col-md-12">
                                    <div id="" class="form-group"></div>
                                </div>
                                
                            </div>
                            <!--/.col-6-->

                            <div class="col-md-6">
                                <label for="upload_images" class="col-md-2 col-form-label">Picture</label>
                                <a href="#" name="btn_image_add" class="btn btn-primary"><i class="mdi mdi-plus"></i> New Photo</a>

                                <div name="div_upload_images" class="col-md-12">
                                    <!--<div class="row">
                                        <div class="col-md-6">
                                            <input type="file" name="upload_images[]" id="upload_images[]"  class="form-control"  />
                                        </div>--><!--/.col-3-->
                                        <!--<div class="col-md-6">
                                            <input type="text" name="upload_photo_display_name[]" class="form-control" placeholder="Picture file name" />
                                        </div>--><!--/.col-9-->
                                    <!--</div>--><!--/.row-->

                                </div>
                                <!--/.div_upload_file-->

                                <div class="row col-md-12">
                                    <div id="images_preview" class="form-group"></div>
                                </div>
                                
                            </div>
                            <!--/.col-6-->

                            
                        </div>
                        <!--/.row col-12-->
                        
                  </div>
                  <!--/.tab menu2-->
                </div>

                <div class="col-md-6">
                    

                </div>
                <!--/.col-6-->

                
                </div>
                <!--/card-->
                                    

            <div class="border-top">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-table-edit"></i> Save</button>


                </div>
            </div>
        </form>
        <!--/.form1-->
    </div>
    <!--/.card-->        
</div>
<!--/.row-->
</div>
<!--/.col-12-->
</div>
<!--/.row-->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->


<!-- The Modal -->
<div class="modal" id="modalForm">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Customer Search</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

        <form href="#" >
      <!-- Modal body -->
      <div class="modal-body">
            <input type="hidden" name="action" value="" />


        
            <div class="field-wrapper">
                <input type="email" name="email" id="">
                <div class="field-placeholder"><span>Enter your email</span></div>
            </div>
            <div class="field-wrapper">
                <input type="password" name="password" id="">
                <div class="field-placeholder"><span>Enter your password</span></div>
            </div>
      </div>
      <!-- model-body-->

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary" > Save</button>
      </div>
      </form>
        <!--form-->

    </div>
  </div>
</div>       



@endsection   

@section('footer')

<style>
    .field-wrapper{
        position: relative;
        margin-bottom: 15px;
    }
    
    .field-wrapper input{
        border: 1px solid #DADCE0;
        padding: 15px;
        border-radius: 4px;
        width: 100%;
    }

    .field-wrapper .field-placeholder{
        font-size: 16px;
        position: absolute;
        /* background: #fff; */
        bottom: 17px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        color: #80868b;
        left: 8px;
        padding: 0 8px;
        -webkit-transition: transform 150ms cubic-bezier(0.4,0,0.2,1),opacity 150ms cubic-bezier(0.4,0,0.2,1);
        transition: transform 150ms cubic-bezier(0.4,0,0.2,1),opacity 150ms cubic-bezier(0.4,0,0.2,1);
        z-index: 1;

        text-align: left;
        width: 100%;
    }        
    
    .field-wrapper .field-placeholder span{
        background: #ffffff;
        padding: 0px 8px;
    }

    .field-wrapper input:not([disabled]):focus~.field-placeholder
    {
        color:#1A73E8;
    }
    
    .field-wrapper input:not([disabled]):focus~.field-placeholder,
    .field-wrapper.hasValue input:not([disabled])~.field-placeholder
    {
        -webkit-transform: scale(.75) translateY(-39px) translateX(-60px);
        transform: scale(.75) translateY(-39px) translateX(-60px);
        
    }   
</style>

<script>
function previewImages() { //alert('previewImages');
    var $preview = $('#images_preview').empty();
      if (this.files) $.each(this.files, readAndPreview);

      function readAndPreview(i, file) {
        
        if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
          return alert(file.name +" is not an image");
        } // else...
        
        var reader = new FileReader();

        $(reader).on("load", function() {
          $preview.append($("<img/>", {src:this.result, height:100}));
        });

        reader.readAsDataURL(file);
        
      } // readAndPreview
}// previewImages

$(document).ready(function(){
    $(".field-wrapper .field-placeholder").on("click", function () {
        $(this).closest(".field-wrapper").find("input").focus();
    });
    $(".field-wrapper input").on("keyup", function () {
        var value = $.trim($(this).val());
        if (value) {
            $(this).closest(".field-wrapper").addClass("hasValue");
        } else {
            $(this).closest(".field-wrapper").removeClass("hasValue");
        }
    });


    //Form Add
    $('a[name="formAdd"]').click(function(){ //alert('big');
        $('#modalForm').modal('show');         

        $('#modalForm input[name="search_keyword"]').select();
    }); //. $('a[name=btnSearchEvaluator]').click(function(){ 

    // Apply topics to employees.
    $('a[name="btn_dts_add"]').click(function(){ // alert('big');
        $('div[name="div_upload_files"] ').append(
        '<div class="row">'+
            '<div class="col-md-6">'+
                '<input type="file" name="upload_files[]" id="upload_files[]"  class="form-control" />'+
            '</div>'+
            '<div class="col-md-6">'+
                '<input type="text" name="upload_file_display_name[]" class="form-control" placeholder="DTS file name" />'+
            '</div>'+
        '</div>'
        );   
    }); //. $('a[name=applyTopicListEmployee]').click(function(){ 

    $('a[name="btn_image_add"]').click(function(){ // alert('big');
        $('div[name="div_upload_images"] ').append(
        '<div class="row">'+
            '<div class="col-md-6">'+
                '<input type="file" name="upload_images[]" id="upload_images[]"  class="form-control"  />'+
            '</div>'+
            '<div class="col-md-6">'+
                '<input type="text" name="upload_photo_display_name[]" class="form-control" placeholder="Picture file name" />'+
            '</div>'+
        '</div>'
        ); 
        $('input[name="upload_images[]"').on("change", previewImages); 
    }); //. $('a[name=applyTopicListEmployee]').click(function(){ 
});
</script>
@endsection

@extends('layouts.adminLayout.admin_design')
@section('content')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">User</h4>

                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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

                        <div class="row">
                            <label for="product_serie_id" class="col-md-3 col-form-label">Product Series</label>
                            <div class="col-md-3">
                              <select name="product_serie_id" id="product_serie_id" class="form-control" >
                                <option value="">-</option>
                                @foreach($productSeries as $val)
                                <option value="{{ $val->id }}"
                                    
                                    >{{ $val->product_serie_name }}</option>
                                @endforeach
                            </select>
                            </div>
                            <!--/.col-4-->

                            <label for="product_chemical_treatment_id" class="col-md-3 col-form-label">Chemical Treatment</label>
                            <div class="col-md-3">
                              <select name="product_chemical_treatment_id" id="product_chemical_treatment_id" class="form-control">
                                <option value="">-</option>
                                @foreach($productChemicalTreatments as $val)
                                <option value="{{ $val->id }}"
                                    
                                    >{{ $val->product_chemical_treatment_code }}</option>
                                @endforeach
                            </select>
                            </div>
                            <!--/.col-4-->

                        </div>
                        <!--/.row-->

                        <div class="row">
                            <label for="product_availability_id" class="col-md-3 col-form-label">Availability</label>
                            <div class="col-md-3">
                                <select name="product_availability_id" id="product_availability_id" class="form-control">
                                    <option value="">-</option>
                                    @foreach($productAvailabilities as $val)
                                    <option value="{{ $val->id }}"
                                        
                                        >{{ $val->product_availability_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--/.col-4-->

                            <label for="product_operation_id" class="col-md-3 col-form-label">Operations</label>
                            <div class="col-md-3">
                                <select name="product_operation_id" id="product_operation_id" class="form-control">
                                    <!-- <option value="">-</option> -->
                                    @foreach($productOperations as $val)
                                    <option value="{{ $val->id }}"
                                        
                                        >{{ $val->product_operation_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--/.col-4-->
                        </div>
                        <!--/.row-->

                        <div class="row">
                            <label for="product_application_id" class="col-md-3 col-form-label">Application</label>
                            <div class="col-md-3">
                                <select name="product_application_id" id="product_application_id" class="form-control">
                                    <!-- <option value="">-</option> -->
                                    @foreach($productApplications as $val)
                                    <option value="{{ $val->id }}"
                                        
                                        >{{ $val->product_application_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--/.col-4-->

                            <label for="product_weave_style_id" class="col-md-3 col-form-label">Weave Style</label>
                            <div class="col-md-3">
                                <select name="product_weave_style_id" id="product_weave_style_id" class="form-control">
                                    <option value="">-</option>
                                    @foreach($productWeaveStyles as $val)
                                    <option value="{{ $val->id }}"
                                        
                                        >{{ $val->product_weave_style_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--/.col-4-->
                        </div>
                        <!--/.row-->

                        <div class="row">
                            <label for="product_category_id" class="col-md-3 col-form-label">Category</label>
                            <div class="col-md-3">
                                <select name="product_category_id" id="product_category_id" class="form-control">
                                    <!-- <option value="">-</option> -->
                                    @foreach($productCategories as $val)
                                    <option value="{{ $val->id }}"
                                        
                                        >{{ $val->product_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--/.col-8-->
                            <div class="col-md-3">
                                <input id="quantity" type="text" class="form-control" name="quantity" style="text-align: right;" placeholder="Quantity" required value="" >
                            </div>
                            <!--/.col-4-->

                            <div class="col-md-3">
                                <select name="product_sales_uom_id" id="product_sales_uom_id" class="form-control">
                                    <!-- <option value="">-</option> -->
                                    @foreach($productSalesUoms as $val)
                                    <option value="{{ $val->id }}"
                                        
                                        >{{ $val->product_sales_uom_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--/.col-4-->
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
                                <label for="product_type_of_yarn_id" class="col-md-4 col-form-label">Type of Yarns</label>

                                <select name="product_type_of_yarn_weft_id" id="product_type_of_yarn_weft_id" class="form-control col-md-2">
                                    <option value="">-</option>
                                    @foreach($productTypeOfYarns as $val)
                                    <option value="{{ $val->id }}"
                                        
                                        >{{ $val->product_type_of_yarn_name }}</option>
                                    @endforeach
                                </select>
                                <label name="product_type_of_yarn_weave_text" class="col-md-2 col-form-label"></label>

                                <select name="product_type_of_yarn_warp_id" id="product_type_of_yarn_warp_id" class="form-control col-md-2">
                                    <option value="">-</option>
                                    @foreach($productTypeOfYarns as $val)
                                    <option value="{{ $val->id }}"
                                        
                                        >{{ $val->product_type_of_yarn_name }}</option>
                                    @endforeach
                                </select>
                                <label name="product_type_of_yarn_warp_tex" class="col-md-2 col-form-label"></label>                                   
                            </div>
                            <!--/.col-md-6-->

                            <div class="col-md-6">
                                <div class="col-md-12" style="text-align: center;">
                                    <label>Tensile Strength</label>      
                                </div>
                                <!--/.col-12-->
                                
                            </div>
                            <!--/.col-md-6-->
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
          
@endsection   

@section('footer')
 

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
    $('#weight_gm').keyup(function(e){ 
        try{   
            $("#weight_ozyd").val($(this).val()/33.91);
        }catch{}
    });
    $('#tensile_strength_warp_kgfin').keyup(function(e){ 
        try{    
            $("#tensile_strength_warp_nin").val($(this).val()/9.8);
        }catch{}
    });
    $('#tensile_strength_weft_kgfin').keyup(function(e){ 
        try{   
            $("#tensile_strength_weft_nin").val($(this).val()/9.8);
        }catch{}
    });

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

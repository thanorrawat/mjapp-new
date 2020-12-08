  

<?php $__env->startSection('title', $titlepage); ?>



<?php $__env->startSection('pagecss'); ?>
    <!-- Bootstrap CSS-->
    
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap-datepicker.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/jquery-timepicker/jquery.timepicker.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/awesome-bootstrap-checkbox.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap-select.min.css') ?>" type="text/css">


<!-- bootstrap 4.x is supported. You can also use the bootstrap css 3.3.x versions -->

<link href="<?php echo e(asset("node_modules/bootstrap-fileinput/css/fileinput.min.css")); ?>" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet"> 
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"> 
<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css" rel="stylesheet"> 
<style>

/*panel*/
.panel {
  margin-bottom: 10px
}

.panel-heading {
    border-color:#eff2f7 ;
    font-size: 16px;
    font-weight: 300;
}

.panel-title {
    color: #2A3542;
    font-size: 14px;
    font-weight: 400;
    margin-bottom: 0;
    margin-top: 0;
    font-family: 'Open Sans', sans-serif;
}


/*product list*/

.product-list img{
    width: 100%;
    border-radius: 4px 4px 0 0;
    -webkit-border-radius: 4px 4px 0 0;
}

.product-list .pro-img-box {
    position: relative;
}
.adtocart {
    background: #fc5959;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    color: #fff;
    display: inline-block;
    text-align: center;
    border: 3px solid #fff;
    left: 45%;
    bottom: -25px;
    position: absolute;
}

.adtocart i{
    color: #fff;
    font-size: 25px;
    line-height: 42px;
}

.pro-title {
    color: #5A5A5A;
    display: inline-block;
    margin-top: 20px;
    font-size: 16px;
}

.product-list .price {
    color:#fc5959 ;
    font-size: 15px;
}

.pro-img-details {
    margin-left: -15px;
}

.pro-img-details img {
    width: 100%;
}

.pro-d-title {
    font-size: 16px;
    margin-top: 0;
}

.product_meta {
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
    padding: 10px 0;
    margin: 15px 0;
}

.product_meta span {
    display: block;
    margin-bottom: 10px;
}
.product_meta a, .pro-price{
    color:#fc5959 ;
}

.pro-price, .amount-old {
    font-size: 18px;
    padding: 0 10px;
}

.amount-old {
    text-decoration: line-through;
}

.quantity {
    width: 120px;
}

.pro-img-list {
    margin: 10px 0 0 -15px;
    width: 100%;
    display: inline-block;
}

.pro-img-list a {
    float: left;
    margin-right: 10px;
    margin-bottom: 10px;
}            

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentnoblock'); ?>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <?php if(session()->has('create_message')): ?>
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('create_message')); ?></div> 
<?php endif; ?>
<?php if(session()->has('edit_message')): ?>
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('edit_message')); ?></div> 
<?php endif; ?>
<?php if(session()->has('import_message')): ?>
    <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('import_message')); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>
<?php if(session()->has('message')): ?>
    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message')); ?></div> 
<?php endif; ?>
                <div class="card">
                    
                    <div class="card-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>

                        <form id="product-form" method="POST" action="<?php if(!empty($lims_product_data->id)): ?><?php echo e(url("products/update")); ?><?php else: ?><?php echo e(url("products")); ?><?php endif; ?>" enctype="multipart/form-data">



                            <?php echo e(csrf_field()); ?>

                            <div class="form-group row">
                                <label class="col-md-2"><?php echo e(trans('file.Product Name')); ?> *</strong> </label>
                                <div class="col-md-10">
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name" 
                                <?php if(!empty($lims_product_data->name) ): ?> 
                                value="<?php echo e($lims_product_data->name); ?>"
                                   <?php endif; ?>
                                
                                required>
                                <span class="validation-msg" id="name-error"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2" ><?php echo e(trans('file.category')); ?> *</strong> </label>
                            <div class="col-md-4">
                            <div class="input-group">
                              <select name="category_id" required class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Category...">
                                <?php $__currentLoopData = $lims_category_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option 
                                     <?php if(!empty($lims_product_data->category_id) && $lims_product_data->category_id== $category->id ): ?> 
                                      selected
                                        <?php endif; ?>
                                        value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                          </div>
                          <span class="validation-msg"></span>
                        </div>
                  
                        <label  class="col-md-2"><?php echo e(trans('file.Product Code')); ?> *</strong> </label>
                        <div class="col-md-4">  
                            <input type="text" name="code" class="form-control" id="code" aria-describedby="code"
                            <?php if(!empty($lims_product_data->category_code) ): ?> 
                           value="<?php echo e($lims_product_data->category_code); ?>"
                              <?php endif; ?>
                            required>
                            
                     
                        </div>
                        <span class="validation-msg" id="code-error"></span>
                    </div>


                    <div class=" form-group row">
                        <label class="col-md-2" ><?php echo e(trans('file.Product Unit')); ?> *</strong> </label>
                        <div class="col-md-4"> 
                        <div class="input-group">
                          <select required class="form-control selectpicker" name="unit_id">
                            <option value="" disabled selected>Select Product Unit...</option>
                            <?php $__currentLoopData = $lims_unit_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($unit->base_unit==null): ?>
                                    <option
                                    <?php if(!empty($lims_product_data->unit_id) && $lims_product_data->unit_id== $unit->id ): ?> 
                                    selected
                                      <?php endif; ?>
                             value="<?php echo e($unit->id); ?>"><?php echo e($unit->unit_name); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                      </div>
                  
                      <span class="validation-msg"></span>  </div>
       
                    <label class="col-md-2"><?php echo e(trans('file.Alert Quantity')); ?></strong> </label>
                    <div class="col-md-4"> 
                    <input type="number" name="alert_quantity" class="form-control" 
                    
                    <?php if(!empty($lims_product_data->alert_quantity) ): ?> 
                    value="<?php echo e($lims_product_data->alert_quantity); ?>"
                       <?php endif; ?>
                    step="any">
                </div>

                </div>

                <div class="form-group row">
                    <label class="col-md-2"><?php echo e(trans('file.Product Details')); ?></label>
                    <div class="col-md-10"> 
                    <textarea name="product_details" class="form-control" rows="3"><?php if(!empty($lims_product_data->product_details) ): ?><?php echo e($lims_product_data->product_details); ?><?php endif; ?></textarea>
                </div>
            </div>
           
        <div class="form-group row">
                                <label class="col-md-2"><?php echo e(trans('file.Product Type')); ?> *</strong> </label>
                                <div class="col-md-10">
                                <div class="input-group">
                                    <select name="type" required class="form-control selectpicker" id="type">
                                        <option    <?php if(!empty($lims_product_data->type) && $lims_product_data->type== "standard"): ?> 
                                            selected
                                              <?php endif; ?> value="standard">Standard</option>
                                        <option  <?php if(!empty($lims_product_data->type) && $lims_product_data->type== "Combo"): ?> selected <?php endif; ?>
                                              value="combo">Combo</option>
                                        
                                    </select>
                                </div>
                            </div></div>
                            <div id="combo"  >
                                <label><?php echo e(trans('file.add_product')); ?></label>
                                <div class="search-box input-group mb-3">
                                    <button class="btn btn-secondary"><i class="fa fa-barcode"></i></button>
                                    <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Please type product code and select..." class="form-control" />
                                </div>

                                <div class="col-md-12">
                               
                          
<label><?php echo e(trans('file.Combo Products')); ?></label>
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-hover order-list">
                                            <thead>
                                                <tr>
                                                    <th><?php echo e(trans('file.product')); ?></th>
                                                    <th><?php echo e(trans('file.Quantity')); ?></th>
                                                    <th><?php echo e(trans('file.Unit Price')); ?></th>
                                                    <th><i class="dripicons-trash"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                           

                                <label class="col-md-2"><?php echo e(trans('file.Product Image')); ?></strong>  <i class="dripicons-question" data-toggle="tooltip" title="<?php echo e(trans('file.You can upload multiple image. Only .jpeg, .jpg, .png, .gif file can be uploaded. First image will be base image.')); ?>"></i> </label>
                                <div class="col-md-10"> 
<?php if(!empty($imagearr) && $imagearr[0]!="zummXD2dvAtI.png"): ?>
<div class="row product-list">
    <?php for($i = 0; $i < count($imagearr); $i++): ?>
    <div class="col-md-4">
        <section class="panel">
            <div class="pro-img-box">
                <img src="<?php echo e(url("public/images/product")."/".$imagearr[$i]); ?>" alt="">
          
            </div>
            <div class="panel-body text-center">
                <input type="checkbox" name="imagesdelete[]" value="<?php echo e($imagearr[$i]); ?>">
                <label class="badge badge-danger"> <i class="fa fa-trash" aria-hidden="true"></i> Delete</label>

            </div>

        </section>
    </div>
    <?php endfor; ?>
</div>
<?php endif; ?>

                 
                                    <input id="imageUpload" name="image[]" type="file" class="file" multiple 
                                    data-allowed-file-extensions='["jpeg", "jpg" , "png", "gif"]'
                                     data-show-caption="true" data-msg-placeholder="Select {files} for upload...">
                             
                                <span class="validation-msg" id="image-error"></span>
                            </div>
                        </div>
<input type="hidden" name="barcode_symbology" value="C128">
<?php if(!empty($lims_product_data->id) ): ?>
<input type="hidden" name="id" value="<?php echo e($lims_product_data->id); ?>">
<?php endif; ?>
<div class="form-group">
                                <input type="submit" value="<?php echo e(trans('file.submit')); ?>" id="submit-btn" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagejs'); ?>
<script type="text/javascript" src="<?php echo asset('public/vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo asset('public/vendor/bootstrap/js/bootstrap-select.min.js') ?>"></script>


<!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/piexif.min.js" type="text/javascript"></script>
    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
        This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/sortable.min.js" type="text/javascript"></script>
    <!-- purify.min.js is only needed if you wish to purify HTML content in your preview for 
        HTML files. This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/purify.min.js" type="text/javascript"></script>
    <!-- popper.min.js below is needed if you use bootstrap 4.x (for popover and tooltips). You can also use the bootstrap js 
       3.3.x versions without popper.min.js. -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- bootstrap.min.js below is needed if you wish to zoom and preview file content in a detail modal
        dialog. bootstrap 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- the main fileinput plugin file -->

    <script src="<?php echo e(asset("node_modules/bootstrap-fileinput/js/fileinput.js")); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#imageUpload").fileinput({
    theme: "fas",
    language: "th",
    showUpload : false
});
        });
</script>
    <!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`) -->
<script src="<?php echo e(asset("node_modules/bootstrap-fileinput/themes/fas/theme.min.js")); ?>"></script>

    <!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
    <script src="<?php echo e(asset("node_modules/bootstrap-fileinput/js/locales/th.js")); ?>"></script>




<script type="text/javascript">


$("#combo").hide();

    // $('[data-toggle="tooltip"]').tooltip(); 

    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    // $('#genbutton').on("click", function(){
    //   $.get('gencode', function(data){
    //     $("input[name='code']").val(data);
    //   });
    // });

    

    // tinymce.init({
    //   selector: 'textarea',
    //   height: 130,
    //   plugins: [
    //     'advlist autolink lists link image charmap print preview anchor textcolor',
    //     'searchreplace visualblocks code fullscreen',
    //     'insertdatetime media table contextmenu paste code wordcount'
    //   ],
    //   toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
    //   branding:false
    // });

    // $('select[name="type"]').on('change', function() {
    //     if($(this).val() == 'combo'){
    //         $("input[name='cost']").prop('required',false);
    //         $("select[name='unit_id']").prop('required',false);
    //         hide();
    //         $("#combo").show(300);
    //         $("input[name='price']").prop('disabled',true);
    //         $("#is-variant").prop("checked", false);
    //         $("#variant-section, #variant-option").hide(300);
    //     }
    //     else if($(this).val() == 'digital'){
    //         $("input[name='cost']").prop('required',false);
    //         $("select[name='unit_id']").prop('required',false);
    //         $("input[name='file']").prop('required',true);
    //         hide();
    //         $("#digital").show(300);
    //         $("#combo").hide(300);
    //         $("input[name='price']").prop('disabled',false);
    //         $("#is-variant").prop("checked", false);
    //         $("#variant-section, #variant-option").hide(300);
    //     }
    //     else if($(this).val() == 'standard'){
    //         $("input[name='cost']").prop('required',true);
    //         $("select[name='unit_id']").prop('required',true);
    //         $("input[name='file']").prop('required',false);
    //         $("#cost").show(300);
    //         $("#unit").show(300);
    //         $("#alert-qty").show(300);
    //         $("#variant-option").show(300);
    //         $("#digital").hide(300);
    //         $("#combo").hide(300);
    //         $("input[name='price']").prop('disabled',false);
    //     }
    // });







    //     if( $("#type").val() == 'combo' ) {
    //         var rownumber = $('table.order-list tbody tr:last').index();
    //         if (rownumber < 0) {
    //             alert("Please insert product to table!")
    //             return false;
    //         }
    //     }



</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin_lte.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
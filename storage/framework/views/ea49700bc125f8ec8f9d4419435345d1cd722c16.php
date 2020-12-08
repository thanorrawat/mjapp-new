 
<?php $__env->startSection('title',  __('file.product')); ?>
<?php $__env->startSection('pagecss'); ?>
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet"> 
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"> 
<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css" rel="stylesheet"> 

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

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

<section>
    <div class="container-fluid">
        <?php if(in_array("products-add", $all_permission)): ?>
            <a href="<?php echo e(route('products.create')); ?>" class="btn btn-info"><i class="dripicons-plus"></i> <?php echo e(__('file.add_product')); ?></a>
            <a href="#" data-toggle="modal" data-target="#importProduct" class="btn btn-primary"><i class="dripicons-copy"></i> <?php echo e(__('file.import_product')); ?></a>
        <?php endif; ?>
    </div>
    <div class="table-responsive">
      
        <table id="product-data-table" class="table" style="width: 100%">
            <thead>
                <tr>
                    
                    <th><?php echo e(trans('file.Image')); ?></th>
                    <th><?php echo e(trans('file.name')); ?></th>
                    <th><?php echo e(trans('file.Code')); ?></th>
                   <th><?php echo e(trans('file.Product Type')); ?></th>
                    <th><?php echo e(trans('file.category')); ?></th>
                    <th><?php echo e(trans('file.Product Details')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                      
                </tr>
            </thead>
            
        </table>


    </div>
</section>



<div id="product-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('Product Details')); ?></h5>
          <button id="print-btn" type="button" class="btn btn-default btn-sm ml-3"><i class="dripicons-print"></i> <?php echo e(trans('file.Print')); ?></button>
          <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">

        </div>
      </div>
    </div>
</div>

<div id="importProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <?php echo Form::open(['route' => 'product.import', 'method' => 'post', 'files' => true]); ?>

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Import Product</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          
           <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php echo e(trans('file.Upload CSV File')); ?> *</label>
                        <?php echo e(Form::file('file', array('class' => 'form-control','required'))); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> <?php echo e(trans('file.Sample File')); ?></label>
                        <a href="public/sample_file/sample_products_mj.csv" class="btn btn-info btn-block btn-md"><i class="dripicons-download"></i>  <?php echo e(trans('file.Download')); ?></a>
                    </div>
                </div>
           </div>           
            <?php echo e(Form::submit('Submit', ['class' => 'btn btn-primary'])); ?>

        </div>
        <?php echo Form::close(); ?>

      </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagejs'); ?>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script>
$('#product-data-table').DataTable({

    processing: true,
        serverSide: true,
      //  ajax: '<?php echo e(url("products/product-data?csrf=".csrf_token())); ?>',
        "ajax":{

"url": "<?php echo e(url("products/product-data")); ?>",
//"dataType": "json",
"type": "GET",
"data":{ csrf: "<?php echo e(csrf_token()); ?>"}

},
        columns: [
           // { data: 'id', name: 'products.id' },
            { data: 'image', name: 'products.image' },
            { data: 'name', name: 'products.name' },
            { data: 'code', name: 'products.code' },
            { data: 'cate_type', name: 'categories.cate_type' },
            { data: 'category', name: 'categories.name' },
            { data: 'details', name: 'products.product_details' },
            { data: 'action', name: 'action' }
        ],
        dom: 'Blfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    });
    $(document).on("click", ".productpopup", function(){
  
        let productid = $(this).attr( "data-productid" );
         
//alert("productid")
      //  $('#product-details .modal-body').html(productid)
      $('#product-details .modal-body').load('<?php echo e(url("products/details")); ?>/'+productid);       

    });
    $("#print-btn").on("click", function(){
          var divToPrint=document.getElementById('product-details');
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media  print {.modal-dialog { max-width: 1000px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
          newWin.document.close();
          setTimeout(function(){newWin.close();},10);
    });
    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout-theme-gradient-able.app2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
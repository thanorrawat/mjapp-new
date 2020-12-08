  
<?php $__env->startSection('title',  __('file.category')); ?>
<?php $__env->startSection('pagecss'); ?>
    <!-- table sorter stylesheet-->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('public/vendor/datatable/dataTables.bootstrap4.min.css') ?>">


<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if($errors->has('name')): ?>
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e($errors->first('name')); ?></div>
<?php endif; ?>
<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message')); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>

<section>
    <div class="container-fluid mb-2">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="dripicons-plus"></i> <?php echo e(trans("file.Add Category")); ?></button>&nbsp;
        <button class="btn btn-primary" data-toggle="modal" data-target="#importCategory"><i class="dripicons-copy"></i> <?php echo e(trans('file.Import Category')); ?></button>
    </div>
    <div class="table-responsive">
        <table id="category-table" class="table table-bordered" style="width: 100%">
            <thead>
                <tr>
                  
                    <th>No.</th>
                    <th><?php echo e(trans('file.category')); ?></th>
                    <th>TYPE</th>
                    <th>code</th>
                    <th>คำอธิบาย</th>
                    
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th> 
                </tr>
            </thead>
        </table>
    </div>
</section>

<!-- Create Modal -->
<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
      <div class="modal-content">
        <?php echo Form::open(['route' => 'category.store', 'method' => 'post']); ?>

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Category')); ?></h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
          <form>
            <div class="form-group">
                <label><?php echo e(trans('file.category')); ?> *</label>
                <?php echo e(Form::text('name',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => trans('file.Type category name...')  ))); ?>

            </div>
            <div class="form-group">
              <label><?php echo e(trans('file.category code')); ?> *</label>
              <?php echo e(Form::text('code',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => trans('file.Type category code...')  ))); ?>

          </div>
          <div class="form-group">
            <label><?php echo e(trans('file.category type')); ?> *</label>
            <?php echo e(Form::text('cate_type',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => trans('file.Type category type...')  ))); ?>

        </div>
        <div class="form-group">
          <label><?php echo e(trans('file.category description')); ?> </label>
          <?php echo e(Form::textarea('description',null,array('class' => 'form-control', 'placeholder' => trans('file.Type category description...')  ))); ?>

      </div>
            
            <div class="form-group">       
              <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
            </div>
          </form>
        </div>
        <?php echo e(Form::close()); ?>

      </div>
    </div>
</div>
<!-- Edit Modal -->
<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo e(Form::open(['route' => ['category.update', 1], 'method' => 'PUT'] )); ?>

      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Update Category')); ?></h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
      </div>
      <div class="modal-body">
        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
          <div class="form-group">
            <label><?php echo e(trans('file.category')); ?> *</label>
            <?php echo e(Form::text('name',null, array('required' => 'required', 'class' => 'form-control'))); ?>

        </div>
        <div class="form-group">
            <label><?php echo e(trans('file.category code')); ?> *</label>
            <?php echo e(Form::text('code',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => trans('file.Type category code...')  ))); ?>

        </div>
        <div class="form-group">
            <label><?php echo e(trans('file.category type')); ?> *</label>
            <?php echo e(Form::text('cate_type',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => trans('file.Type category type...')  ))); ?>

        </div>
        <div class="form-group">
          <label><?php echo e(trans('file.category description')); ?> </label>
          <?php echo e(Form::textarea('description',null,array('class' => 'form-control', 'placeholder' => trans('file.Type category description...')  ))); ?>

      </div>
            <input type="hidden" name="category_id">
        <div class="form-group">
            <label><?php echo e(trans('file.Parent Category')); ?></label>
            <select name="parent_id" class="form-control selectpicker" id="parent">
                <option value="">No <?php echo e(trans('file.parent')); ?></option>
                <?php $__currentLoopData = $lims_category_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group">       
            <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
          </div>
        </div>
      <?php echo e(Form::close()); ?>

    </div>
  </div>
</div>
<!-- Import Modal -->
<div id="importCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
      <div class="modal-content">
        <?php echo Form::open(['route' => 'category.import', 'method' => 'post', 'files' => true]); ?>

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Import Category')); ?></h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
            <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
           <p><?php echo e(trans('file.The correct column order is')); ?> (name*, parent_category) <?php echo e(trans('file.and you must follow this')); ?>.</p>
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
                        <a href="public/sample_file/sample_category_mj.csv" class="btn btn-info btn-block btn-md"><i class="dripicons-download"></i>  <?php echo e(trans('file.Download')); ?></a>
                    </div>
                </div>
            </div>
            <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
        </div>
        <?php echo e(Form::close()); ?>

      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagejs'); ?>
        <!-- datatable -->
        <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/pdfmake.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/vfs_fonts.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/jquery.dataTables.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/dataTables.bootstrap4.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/dataTables.buttons.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.bootstrap4.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.colVis.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.html5.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo asset('public/vendor/datatable/buttons.print.min.js') ?>"></script>
<script type="text/javascript">
$('#category-table').DataTable({
processing: true,
serverSide: true,
"ajax":{
"url": "<?php echo e(url("category/category-data")); ?>",
//"dataType": "json",
"type": "GET",
"data":{ csrf: "<?php echo e(csrf_token()); ?>"}
},
        columns: [
     
          
            {"data": "number"},
            {"data": "name"},
            {"data": "cate_type"},
            {"data": "code"},
            {"data": "description"},
            {"data": "action"}
        ],
        dom: 'Blfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
        , dom: '<"row"lfB>rtip'
    
    });


    $(document).on("click", ".open-EditCategoryDialog", function(){
          var url ="category/";
          var id = $(this).data('id').toString();
          url = url.concat(id).concat("/edit");
         // alert(url)
          $.get(url, function(data){
            $("#editModal input[name='name']").val(data['name']);
            $("#editModal input[name='code']").val(data['code']);
            $("#editModal input[name='cate_type']").val(data['cate_type']);
            $("#editModal input[name='description']").val(data['description']);
            $("#editModal select[name='parent_id']").val(data['parent_id']);
            $("#editModal input[name='category_id']").val(data['id']);
            $('.selectpicker').selectpicker('refresh');
          });
    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin_lte.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
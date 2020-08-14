@extends('layout-theme-gradient-able.app2') 
@section('title',  __('file.category'))
@section('pagecss')
    <!-- table sorter stylesheet-->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('public/vendor/datatable/dataTables.bootstrap4.min.css') ?>">


@endsection
@section('content')
@if($errors->has('name'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('name') }}</div>
@endif
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

<section>
    <div class="container-fluid">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="dripicons-plus"></i> {{trans("file.Add Category")}}</button>&nbsp;
        <button class="btn btn-primary" data-toggle="modal" data-target="#importCategory"><i class="dripicons-copy"></i> {{trans('file.Import Category')}}</button>
    </div>
    <div class="table-responsive">
        <table id="category-table" class="table table-bordered" style="width: 100%">
            <thead>
                <tr>
                  
                    <th>No.</th>
                    <th>{{trans('file.category')}}</th>
                    <th>TYPE</th>
                    <th>code</th>
                    <th>คำอธิบาย</th>
                    {{-- <th>{{trans('file.Parent Category')}}</th>
                    <th>{{trans('file.Number of Product')}}</th>
                    <th>{{trans('file.Stock Quantity')}}</th>
                    <th>{{trans('file.Stock Worth (Price/Cost)')}}</th>--}}
                    <th class="not-exported">{{trans('file.action')}}</th> 
                </tr>
            </thead>
        </table>
    </div>
</section>

<!-- Create Modal -->
<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
      <div class="modal-content">
        {!! Form::open(['route' => 'category.store', 'method' => 'post']) !!}
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Category')}}</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
          <form>
            <div class="form-group">
                <label>{{trans('file.category')}} *</label>
                {{Form::text('name',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => trans('file.Type category name...')  ))}}
            </div>
            <div class="form-group">
              <label>{{trans('file.category code')}} *</label>
              {{Form::text('code',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => trans('file.Type category code...')  ))}}
          </div>
          <div class="form-group">
            <label>{{trans('file.category type')}} *</label>
            {{Form::text('cate_type',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => trans('file.Type category type...')  ))}}
        </div>
        <div class="form-group">
          <label>{{trans('file.category description')}} </label>
          {{Form::textarea('description',null,array('class' => 'form-control', 'placeholder' => trans('file.Type category description...')  ))}}
      </div>
            {{-- <div class="form-group">
                <label>{{trans('file.Parent Category')}}</label>
                {{Form::select('parent_id', $lims_categories, null, ['class' => 'form-control','placeholder' => trans('file.Parent Category') ])}}
            </div>                 --}}
            <div class="form-group">       
              <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
            </div>
          </form>
        </div>
        {{ Form::close() }}
      </div>
    </div>
</div>
<!-- Edit Modal -->
<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
        {{ Form::open(['route' => ['category.update', 1], 'method' => 'PUT'] ) }}
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Update Category')}}</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
      </div>
      <div class="modal-body">
        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
          <div class="form-group">
            <label>{{trans('file.category')}} *</label>
            {{Form::text('name',null, array('required' => 'required', 'class' => 'form-control'))}}
        </div>
        <div class="form-group">
            <label>{{trans('file.category code')}} *</label>
            {{Form::text('code',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => trans('file.Type category code...')  ))}}
        </div>
        <div class="form-group">
            <label>{{trans('file.category type')}} *</label>
            {{Form::text('cate_type',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => trans('file.Type category type...')  ))}}
        </div>
        <div class="form-group">
          <label>{{trans('file.category description')}} </label>
          {{Form::textarea('description',null,array('class' => 'form-control', 'placeholder' => trans('file.Type category description...')  ))}}
      </div>
            <input type="hidden" name="category_id">
        <div class="form-group">
            <label>{{trans('file.Parent Category')}}</label>
            <select name="parent_id" class="form-control selectpicker" id="parent">
                <option value="">No {{trans('file.parent')}}</option>
                @foreach($lims_category_all as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">       
            <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
          </div>
        </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
<!-- Import Modal -->
<div id="importCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
      <div class="modal-content">
        {!! Form::open(['route' => 'category.import', 'method' => 'post', 'files' => true]) !!}
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Import Category')}}</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
           <p>{{trans('file.The correct column order is')}} (name*, parent_category) {{trans('file.and you must follow this')}}.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{trans('file.Upload CSV File')}} *</label>
                        {{Form::file('file', array('class' => 'form-control','required'))}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> {{trans('file.Sample File')}}</label>
                        <a href="public/sample_file/sample_category_mj.csv" class="btn btn-info btn-block btn-md"><i class="dripicons-download"></i>  {{trans('file.Download')}}</a>
                    </div>
                </div>
            </div>
            <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
        </div>
        {{ Form::close() }}
      </div>
    </div>
</div>
@endsection
@section('pagejs')
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
"url": "{{ url("category/category-data") }}",
//"dataType": "json",
"type": "GET",
"data":{ csrf: "{{ csrf_token() }}"}
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

@endsection
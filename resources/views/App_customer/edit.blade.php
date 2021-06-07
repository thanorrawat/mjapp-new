@extends('Admin_lte.app') 

@section('title',  __('file.Add Customer')) 
@section('contentnoblock')
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Update Customer')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => ['customer.update',$lims_customer_data->id], 'method' => 'put', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" name="customer_group" value="{{$lims_customer_data->customer_group_id}}">
                                    <label>{{trans('file.Customer Group')}} *</strong> </label>
                                    <select required class="form-control selectpicker" name="customer_group_id">
                                        @foreach($lims_customer_group_all as $customer_group)
                                            <option value="{{$customer_group->id}}">{{$customer_group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.name')}} *</strong> </label>
                                    <input type="text" name="name" value="{{$lims_customer_data->name}}" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Customer Code')}} *</strong> </label>
                                    <input type="text" name="customercode" value="{{$lims_customer_data->customercode}}" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Company Name')}} </label>
                                    <input type="text" name="company_name" value="{{$lims_customer_data->company_name}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Price Group')}} </label>
                           

<select required class="form-control selectpicker" name="price_group">
                                      
<option @if ($lims_customer_data->price_group=='A') selected  @endif
                                             value="A">Standard A</option>

 <option @if ($lims_customer_data->price_group=='B') selected  @endif
                                                value="B">Standard B</option>
<option @if ($lims_customer_data->price_group=='C') selected  @endif
                                                    value="C">Standard C</option>
<option @if ($lims_customer_data->price_group=='D') selected  @endif
                                                        value="D">Standard D</option>
                                   
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Email')}}</label>
                                    <input type="email" name="email" value="{{$lims_customer_data->email}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Phone Number')}} *</label>
                                    <input type="text" name="phone_number" required value="{{$lims_customer_data->phone_number}}" class="form-control">
                                    @if($errors->has('phone_number'))
                                   <span>
                                       <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Tax Number')}}</label>
                                    <input type="text" name="tax_no" class="form-control" value="{{$lims_customer_data->tax_no}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Address')}} *</label>
                                    <input type="text" name="address" required value="{{$lims_customer_data->address}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.City')}} *</label>
                                    <input type="text" name="city" required value="{{$lims_customer_data->city}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.State')}}</label>
                                    <input type="text" name="state" value="{{$lims_customer_data->state}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Postal Code')}}</label>
                                    <input type="text" name="postal_code" value="{{$lims_customer_data->postal_code}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Country')}}</label>
                                    <input type="text" name="country" value="{{$lims_customer_data->country}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-3">
                                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('pagejs')
<script type="text/javascript">

    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
        
    var customer_group = $("input[name='customer_group']").val();
    $('select[name=customer_group_id]').val(customer_group);
</script>
@endsection
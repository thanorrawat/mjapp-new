
<div class="form-group row">
<div class="col-md-6 row"><label class="col-md-5">{{ __('file.customer') }}</label><div class="col-md-7"> 
<select name="selectcustomer" id="selectcustomer" required>
<option value="">{{ __('file.Select Customer') }}</option>
@foreach ($customers as $customer )
<option @if(!empty($cartDetails->customer_id) && $cartDetails->customer_id ==$customer->id) selected @endif value="{{ $customer->id }}">{{ $customer->name }}</option>
@endforeach
</select>
</div></div>
<div class="col-md-6 row"><label class="col-md-5">{{ __('file.Delivery Date') }}</label><div class="col-md-7"> 
<input type="text" class="form-control datepicker" id="deliverydate" name="deliverydate"  value="@if(!empty($cartDetails->deliverydate)){{ date('j/m/Y', strtotime($cartDetails->deliverydate))  }}@else{{ date("j/m/Y") }}@endif">
    </div></div>
    </div>   

    <div class="form-group row">

      <div class="col-md-6 row"><label class="col-md-5">{{ __('file.Order Type') }}</label><div class="col-md-7"> 

  <input type="radio" @if((!empty($cartDetails->ordertype) && $cartDetails->ordertype==1) || empty($cartDetails->ordertype) ) checked @endif name="ordertype" id="ordertype_1" value="1"> ปรกติ
  <input @if(!empty($cartDetails->ordertype) && $cartDetails->ordertype==2 ) checked @endif  type="radio" name="ordertype" id="ordertype_2" value="2"> Project
      </div></div>
      <div class="col-md-6 row"><label class="col-md-5">ผู้ขออนุมัติ</label><div class="col-md-7"> 
  <input type="text" name="usercreate" id="usercreate" class="form-control" value="@if(!empty($cartDetails->createby_name))
  {{ $cartDetails->createby_name }}
  @elseif(!empty(Auth::user()->fullname)){{ucfirst(Auth::user()->fullname)}}@else{{ucfirst(Auth::user()->name)}}@endif">
  <input type="hidden" name="usercreate_id" id="usercreate_id" value="{{ Auth::user()->id }}">
      </div></div>
      </div> 

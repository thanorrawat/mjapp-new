<template>
    <div class="AddOrder_Details">

        <div class="card">

            <div class="card-body">
               <!-- <p v-if="errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="error in errors">{{ error }}</li>
    </ul>
  </p> -->

<form action="create_order_addform" method="POST" @submit="checkForm" >
  <input type="hidden" name="_token" :value="csrf">
      <div v-if="!orderid" class="row">
        <div class="col-md-6 row">
          <label class="col-md-4">ประเภทเอกสาร :</label>
          <div class="col-md-8">
            <div class="icheck-primary d-inline">
              <input type="radio" id="doctype_1" name="doctype"  v-model="doctype" value="1" required>
              <label for="doctype_1">Order</label>
            </div>
            <div class="icheck-primary d-inline">
              <input type="radio" id="doctype_2" name="doctype"  v-model="doctype" value="2" required>
              <label for="doctype_2"> ใบจอง  </label>  
            </div>
          </div>
        </div>
        <div class="col-md-6 row">
          <label class="col-md-4">ลูกค้า :</label>
          <div class="col-md-8">
            
            <Select2 name="selectcustomer" v-model="selectcustomer" :options="customerlist" :settings="{ 'placeholder':'กรุณาเลือกลูกค้า'  }"  />
          </div>
        </div>
      </div>


      <div v-if="orderid" class="row">
        <div class="col-md-6 row">
          <label class="col-md-4">ประเภทเอกสาร :</label>
            <div class="col-md-8">
              {{  orderdtall.doctypename}}
            </div>
        </div>

        <div class="col-md-6 row">
          <label class="col-md-4">ลูกค้า :</label>
          <div class="col-md-8">
            {{  orderdtall.customer.cusnam}}  <span v-if="orderdtall.price_group"> ( {{ orderdtall.price_group }} ) </span> 
          </div>
        </div>
      </div>


      

            <div class="row">
<div class="col-md-6 row">
<label class="col-md-4">{{ datelabel1  }} :</label>
<div class="col-md-8">
  {{ thisdate }}
<input type="hidden" name="newdate" v-model="newdate">

</div>
</div>

<div class="col-md-6 row">
<label class="col-md-4">{{ datelabel2 }} :</label>
<div class="col-md-8">
 <date-pick
        v-model="selectdate"
      
        :format="'DD/MM/YYYY'"
    ></date-pick>
<input type="hidden" name="selectdate"  v-model="newselectdate">
</div>

  
</div>
      </div>

                  <div class="row">
<div class="col-md-6 row">
<label class="col-md-4">ประเภท Order :</label>
<div class="col-md-8">
<div class="icheck-primary d-inline">
<input type="radio" id="ordertype_1" name="ordertype" value="1" v-model="ordertype" required>
<label for="ordertype_1">ปรกติ</label></div>

<div class="icheck-primary d-inline">
<input type="radio" id="ordertype_2" name="ordertype" value="2" v-model="ordertype"  required>
<label for="ordertype_2"> Project  </label>  </div>

</div>
</div>

<div class="col-md-6 row">
<label class="col-md-4">ผู้ขออนุมัติ :</label>
<div class="col-md-8">
<input type="text" v-if="!orderid" class="form-control" name="userfullname"  v-model="userfullname" >
<input type="text" v-if="orderid" class="form-control" name="userfullname"  v-model="userfullnamedata" >

</div>
</div>
      </div>
      <div class="text-center">
        <button  class="btn btn-primary" v-if="!orderid" >{{buttonlabel}}</button>
      </div>
      </form>

    </div>
        </div>

        </div>
</template>

<script>
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
var today = dd + '/' + mm + '/' + yyyy;
var today2 =today;




import Vue from 'vue';
import Select2 from 'v-select2-component';
import DatePick from 'vue-date-pick';
import 'vue-date-pick/dist/vueDatePick.css';

import VueSweetalert2 from 'vue-sweetalert2';
 
Vue.use(VueSweetalert2);

export default {
  name: 'order-selectcustomer',
  props: ['userfullname', 'userid','baseurl','orderid','orderdtall'],
  components: {Select2,DatePick},
  mounted() {
  this.customerData();
  this.changedate();

        },
    data() {
      return {
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        userId : document.querySelector("meta[name='user-id']").getAttribute('content'),
        customerlist :[],
        thisdate : today,
        selectdate: today2,
        errors: [],
        doctype : 1,
        selectcustomer: null,
        ordertype:1,
        datelabel1 :'วันที่ทำรายการ',
        datelabel2 : 'กำหนดส่ง',
        buttonlabel : 'สร้างใบOrder',
        newdate:null,
        newselectdate:null,
        userfullnamedata:null,
            }
    },
    methods: {
    customerData(){
    axios.get(this.baseurl+'/api/order_customerlist')
    .then((response)=>{
      this.customerlist = response.data.customerlist; 
    })
    },checkForm: function (e) {
      if (this.selectdate   && this.selectcustomer && this.userfullname ) {
      return true;

    
    /* 
 axios.post('api/order_create',{
doctype : this.doctype,
selectcustomer : this.selectcustomer,
createdate : this.newdate,
selectdate : this.newselectdate,
ordertype : this.ordertype,
userfullname : this.userfullname,
userId :this.userId
                 })
  .then((response)=>{
  this.createorder = response.data;
             
 })
     

if(this.createorder.id>0){

  if(this.createorder.ordernumberfull>0){
this.docfullnumber = this.createorder.ordernumberfull;
  }  if(this.createorder.bookingnumber>0){
this.docfullnumber = this.createorder.bookingnumber;
  }
window.location.href = 'order/'+this.docfullnumber+'/edit';
}
*/
      }else{

      this.errors = [];

      if (!this.selectdate) {
        this.errors.push('กรุณาระบุวันที่');
      }
      if (!this.selectcustomer) {
        this.errors.push('กรุณาเลือกลูกค้า');
      }
        if (!this.userfullname) {
        this.errors.push('กรุณาระบุชื่อผู้ทำรายการ');
      }

Vue.swal({
  icon: 'error',
  title: 'เกิดข้อผิดพลาด',
  text: this.errors,
  toast: true,
  timer: 2000,
  timerProgressBar: true,

});
      }

      e.preventDefault();
    }
,    changedate(){
var myString = this.thisdate;
var mySplitResult = myString.split("/");
this.newdate = mySplitResult[2]+"-"+mySplitResult[1]+"-"+mySplitResult[0];


var myString = this.selectdate;
var mySplitResult = myString.split("/");
this.newselectdate = mySplitResult[2]+"-"+mySplitResult[1]+"-"+mySplitResult[0];





        }



    },  watch: {
    doctype: function () {

 if(this.doctype==='1'){
  this.datelabel1 = 'วันที่ทำรายการ';
  this.datelabel2 = 'กำหนดส่ง';
 this.buttonlabel ='สร้างใบOrder';

 }if(this.doctype==='2'){

   this.datelabel1 = 'วันที่จอง';
  this.datelabel2 = 'วันที่สิ้นสุดการจอง';
 this.buttonlabel ='สร้างใบจอง';

    }
  },selectdate: function (){
 this.changedate();
  },orderdtall: function (){


this.thisdatedata = this.orderdtall.orderdt['created_at'];
var datearr = this.thisdatedata.split("-");
var datearrdate = datearr[2].split(" ");
this.thisdate = datearrdate[0]+"/"+datearr[1]+"/"+datearr[0];
if(this.orderdtall.orderdt['deliverydate']){

  this.thisdatedata2 = this.orderdtall.orderdt['deliverydate'];
  var datearr2 = this.thisdatedata2.split("-");
  this.selectdate= datearr2[2]+"/"+datearr2[1]+"/"+datearr2[0];

}
this.ordertype = this.orderdtall.orderdt['ordertype'];
this.userfullnamedata = this.orderdtall.orderdt['createby_name'];

this.changedate();
  }
    }
        
}



</script>


<style>
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    margin-top: -9px;
}
 div.AddOrder_Details input{
   font-size: 14px;
 }
.vdpOuterWrap.vdpPositionReady.vdpFloating
 {
   z-index: 999999;
 }


 .vdpComponent input {
    display: block;
    width: 100%;
    height: calc(2.25rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    box-shadow: inset 0 0 0 transparent;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.vdpComponent{
  width: 100%;
  margin-bottom: 5px;
}
</style>
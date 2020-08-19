<template>
  
        <div class="row  ">
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.เบบบบ
                    </div>
                </div>
            </div>
    

               <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header"> <h4>สร้าง Memo ขอปรับราคา</h4>
                        </div>

                    <div class="card-body">
  <div class="row mb-1">
                        <label class="col-md-4">สินค้า :</label>
<div class="col-md-8">
 <select class="form-control" name="productlist" id="productslist">
         <option v-for=" product in productslist" :value="product.code">{{ product.code }}-{{  product.name  }}</option>

 </select>
</div>  
                    </div>
                        <div class="row mb-1">

                            <label class="col-md-4">เหตุผลการปรับราคา :</label>
                            <div class="col-md-8"><select class="form-control" name="" id="" >
                                <option v-for=" reason in reasons" :value="reason.value">{{ reason.name }}</option>
                                </select></div>
                                </div>
                      
  <div class="row mb-1">
                        <label class="col-md-4">ลูกค้า :</label>
<div class="col-md-8">


    <div class="custom-control custom-radio"> 
                          <input v-model="cutomertype" class="custom-control-input" type="radio" id="customerRadio1" name="customerRadio" value="1">
                          <label for="customerRadio1" class="custom-control-label">ลูกค้าทั้งหมด</label>
                        </div>

                        
    <div class="custom-control custom-radio">
                          <input v-model="cutomertype"  class="custom-control-input" type="radio" id="customerRadio2" name="customerRadio" value="2"> 
                          <label for="customerRadio2" class="custom-control-label">เลือกลูกค้า</label>
                        </div>

     <select v-if="cutomertype==1" class="form-control mt-1" name="pricetype" id="pricetype" required>
 <option value="">ประเภทราคา</option>
 <option value="A">Standard A</option>
 <option value="B">Standard B</option>
 <option value="C">Standard C</option>
 <option value="D">Standard D</option>

  </select>
  <div v-show="cutomertype==2" id="customerlistbox"  class=" mt-1 ">
     <select class="form-control w-100"  name="customerlist" id="customerlist" required>
 <option value="">เลือกลูกค้า</option>

 <option v-for=" customer in customerlist" :value="customer.customercode">{{ customer.customercode }}-{{  customer.name  }}</option>
  </select>

  </div>

</div>  
                    </div>

                      <div class="row mb-1">
                        <label class="col-md-4">ช่วงเวลาที่มีผล :</label>
<div class="col-md-8">

       <div class="custom-control custom-radio"> 
                          <input v-model="changepricetime" class="custom-control-input" type="radio" id="changepricetime1" name="changepricetime" value="1">
                          <label for="changepricetime1" class="custom-control-label">ถาวร</label>
                        </div>

                        
    <div class="custom-control custom-radio">
                          <input v-model="changepricetime"  class="custom-control-input" type="radio" id="changepricetime2" name="changepricetime" value="2"> 
                          <label for="changepricetime2" class="custom-control-label">เฉพาะครั้งนี้</label>
                        </div>

                            <div class="custom-control custom-radio">
                          <input v-model="changepricetime"  class="custom-control-input" type="radio" id="changepricetime3" name="changepricetime" value="3"> 
                          <label for="changepricetime3" class="custom-control-label">เฉพาะช่วงเวลา</label>
                        </div>

    <!-- Date range -->
    <div v-show="changepricetime==3" class="form-group">
      <label>Date range:</label>

      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">
            <i class="far fa-calendar-alt"></i>
          </span>
        </div>
        <input type="text" class="form-control float-right" id="pricerangedate">
      </div>
      <!-- /.input group -->
    </div>
    

</div>  
                    </div> 


                    <div class="row mb-1">
                        <label class="col-md-3 text-right">ราคาปัจจุบัน :</label>
                        <div class="col-md-3">
                          <input type="number" class="form-control text-right">
                        </div>
                        <label class="col-md-3 text-right">ราคาใหม่ :</label>
                        <div class="col-md-3">
    <input type="number" class="form-control text-right">

                        </div>
                        
                </div>

                <div class="text-center m-1">
<button class="btn btn-primary">ส่ง Memo</button>

                </div>
                </div>
            </div>
        </div>
  
    </div>
</template>

<script>
import Vue from 'vue';

import VueSweetalert2 from 'vue-sweetalert2';
 
Vue.use(VueSweetalert2);


    export default {
          props: ['userfullname', 'userid','baseurl'],

             mounted() {
           this.customerData();
           this.productsData();
  //Date range picker
    $('#pricerangedate').daterangepicker({
    
        "locale": {
        "format": "DD/MM/YYYY",
        }
       })
           
        },
          data() {
        return {
            reasons :[
                {'name':'สินค้าชำรุด','value':'1' },
                {'name':'เพื่อการแข่งขันราคา','value':'2' },
                {'name':'โปรโมชั่น','value':'3' },
              
            ],
            customerlist:[],
            productslist:[],
            cutomertype:1,
            changepricetime:1,
        }},
            methods: {
       customerData(){
         axios.get(this.baseurl+'/api/customer_list')
  .then((response)=>{
   this.customerlist = response.data;   
   $('#customerlist').select2();        
 })
 },
        productsData(){
         axios.get(this.baseurl+'/api/products_list')
  .then((response)=>{
   this.productslist = response.data;  
   $('#productslist').select2();     
 })
 }
 
 },watch:{


 }
    }
</script>

<style>
#customerlistbox .select2-container {
width: 100% !important;
}
</style>
<template>
  
        <div class="row  ">
            <div class="col-md-6">

  <div class="card card-default">
              <div class="card-header"> <h4> รายการ Memo ขอปรับราคา (รอตรวจสอบ) </h4></div>

                    <div class="card-body">

   <b-table :data="memopriceListnoapprove" 
   
         paginated
            backend-pagination
            :total="total"
            :per-page="perPage"
            @page-change="onPageChange"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            aria-page-label="Page"
            aria-current-label="Current page"

  
   
   >
    <b-table-column field="rownumber" label="#" sortable  v-slot="props">
                {{ props.row.rownumber }}
  </b-table-column>
     <b-table-column field="memonumber" label="Number" sortable  v-slot="props">
                {{ props.row.memonumber }}
            </b-table-column>
             <b-table-column field="mmp_productcode" label="Product Code" sortable  v-slot="props">
                {{ props.row.mmp_productcode }}
            </b-table-column>
            <b-table-column field="price_now" label="ราคาเดิม" sortable  v-slot="props">
                {{ props.row.price_now }}
            </b-table-column>
                  <b-table-column field="price_new" label="ราคาใหม่"  sortable  v-slot="props">
                {{ props.row.price_new }}
            </b-table-column>
           
                  <b-table-column field="fullname" label="ผู้ทำรายการ"    v-slot="props">
                {{ props.row.fullname}}
            </b-table-column>

               <b-table-column label="สถานะ" field="status"   sortable  v-slot="props">
                <span v-if="props.row.status==1" class="badge badge-primary"> รออนุมัติ </span>
                <span v-if="props.row.status==2" class="badge badge-success"> อนุมัติแล้ว </span>
                <span v-if="props.row.status==3" class="badge badge-danger"> ไม่อนุมัติ </span>
            </b-table-column>
  <b-table-column label="#" field="id" v-slot="props">
            <button class="btn btn-sm btn-primary" @click="viewmemo(props.row.id)"  data-toggle="modal" data-target="#exampleModal">
       view 
        </button>
            </b-table-column>
   </b-table>



                    </div>
                </div>





                <div class="card card-default">
              <div class="card-header"> <h4> รายการ Memo ขอปรับราคา (ตรวจสอบแล้ว)</h4></div>

                    <div class="card-body">

   <b-table :data="memopriceListapprove" 
   
         paginated
            backend-pagination
            :total="total2"
            :per-page="perPage"
            @page-change="onPageChange"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            aria-page-label="Page"
            aria-current-label="Current page"

  
   
   >
       <b-table-column field="rownumber" label="#" sortable  v-slot="props">
                {{ props.row.rownumber }}
  </b-table-column>
     <b-table-column field="memonumber" label="Number" sortable  v-slot="props">
                {{ props.row.memonumber }}
            </b-table-column>
             <b-table-column field="mmp_productcode" label="Product Code" sortable  v-slot="props">
                {{ props.row.mmp_productcode }}
            </b-table-column>
            <b-table-column field="price_now" label="ราคาเดิม" sortable  v-slot="props">
                {{ props.row.price_now }}
            </b-table-column>
                  <b-table-column field="price_new" label="ราคาใหม่"  sortable  v-slot="props">
                {{ props.row.price_new }}
            </b-table-column>

               <b-table-column label="สถานะ" field="status"   sortable  v-slot="props">
                <span v-if="props.row.status==1" class="badge badge-primary"> รออนุมัติ </span>
                <span v-if="props.row.status==2" class="badge badge-success"> อนุมัติแล้ว </span>
                <span v-if="props.row.status==3" class="badge badge-danger"> ไม่อนุมัติ </span>
            </b-table-column>
  <b-table-column label="#" field="id" v-slot="props">
            <button class="btn btn-sm btn-primary" @click="viewmemo(props.row.id)"  data-toggle="modal" data-target="#exampleModal">
       view 
        </button>
            </b-table-column>
   </b-table>



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
    <v-select  v-model="selected"  :options="options"></v-select>

</div>  
                    </div>
                        <div class="row mb-1">

                            <label class="col-md-4">เหตุผลการปรับราคา :</label>
                            <div class="col-md-8">
                              
                              <select v-model="resonselected" class="form-control" name="" id="" >
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

     <select v-if="cutomertype==1" v-model="pricetype" class="form-control mt-1" name="pricetype" id="pricetype" required>
 <option value="">ประเภทราคา</option>
 <option value="A">Standard A</option>
 <option value="B">Standard B</option>
 <option value="C">Standard C</option>
 <option value="D">Standard D</option>

  </select>
  <div v-show="cutomertype==2" id="customerlistbox"  class=" mt-1 ">
    <v-select  v-model="selectedCustomer"  :options="optionsCustomer"></v-select>


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
        <input v-model="pricerangedateinput" type="text" class="form-control float-right" id="pricerangedate">
      </div>
      <!-- /.input group -->
    </div>
    


</div>  
                    </div> 

<div v-if="nowpricevalue && selected" id="chamgepricebox" >
                    <div class="row mb-1" >

                      
                        <label class="col-md-3 text-right">ราคาปัจจุบัน :</label>
                        <div class="col-md-3">
                          <input v-model="nowpricevalue" type="number" class="form-control text-right">
                        </div>
                        <label class="col-md-3 text-right">ราคาใหม่ :</label>
                        <div class="col-md-3">
    <input v-model="memonewpricre" type="number" class="form-control text-right">

                        </div>
              <div class="col-md-12 text-center alert alert-info mt-1">
                  
                  {{  nowpricename }}
                
                </div>    
                        <b-table-column field="fullname" label="ผู้ทำรายการ"    v-slot="props">
                {{ props.row.fullname}}
            </b-table-column>      
                </div>
       <div class="row mb-1">
                        <label class="col-md-4">หมายเหตุ :</label>
<div class="col-md-8">
<textarea v-model="memoremark"  class="form-control"></textarea>
</div>
</div>
                <div class="text-center m-1">
<button @click="addmemo" class="btn btn-primary">ส่ง Memo</button>

                </div>
                </div></div>
            </div>
        </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Memo No. {{ memoviewdata.memonumber }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div v-if="memoviewdata.productdt" class="modal-body">
       <div class="row">
        <label class="col-md-4">สินค้า :</label>
        <div class="col-md-8">{{memoviewdata.productdt[0].code}} - {{memoviewdata.productdt[0].name}} </div>
      </div>

        <div class="row mt-1">
        <label class="col-md-4">เหตุผลการปรับราคา :</label>
        <div class="col-md-8">{{memoviewdata.reson[0].name}}</div>
      </div>

          <div class="row mt-1">
        <label class="col-md-4">ลูกค้า :</label>
        <div v-if="memoviewdata.mmp_customertype==1" class="col-md-8">ลูกค้าทั้งหมด ( Standard {{ memoviewdata.mmp_typeprice }})</div>
        <div v-if="memoviewdata.mmp_customertype==2" class="col-md-8">{{memoviewdata.customerdt[0].customercode}} - {{memoviewdata.customerdt[0].name}} </div>
      </div>
       <div class="row mt-1">
        <label class="col-md-4">ช่วงเวลาที่มีผล :</label>
        <div v-if="memoviewdata.mmp_when==1" class="col-md-8">ถาวร</div>
        <div v-if="memoviewdata.mmp_when==2" class="col-md-8">เฉพาะครั้งนี้</div>
        <div v-if="memoviewdata.mmp_when==3" class="col-md-8">{{memoviewdata.mmp_daterange}}</div>
      </div>


       <div class="row mt-1">
        <label class="col-md-3">ราคาเดิม :</label>
        <div  class="col-md-3">{{memoviewdata.price_now}}</div>
  <label class="col-md-3">ราคาใหม่ :</label>
        <div  class="col-md-3">{{memoviewdata.price_new}}</div>
      </div>

    <div class="row mt-1">
        <label class="col-md-4">หมายเหตุ :</label>
        <div  class="col-md-8">{{memoviewdata.mmp_remark}}</div>
   
      </div>
          <div class="row mt-1">
        <label class="col-md-4">ผู้ขออนุมัติ :</label>
        <div v-if="memoviewdata.created_by>0"   class="col-md-8">{{  userlistnewindex[memoviewdata.created_by].fullname }}</div>
   
      </div>
             <div class="row mt-1">
        <label class="col-md-4">ทำรายการเมื่อ :</label>
        <div  class="col-md-8">{{memoviewdata.created_at}}</div>
   
      </div>

          
             <div class="row mt-1">
        <label class="col-md-4">สถานะ :</label>
        <div  class="col-md-8">
          

                   <span v-if="memoviewdata.status==1" class="badge badge-primary"> รออนุมัติ </span>
                <span v-if="memoviewdata.status==2" class="badge badge-success"> อนุมัติแล้ว </span>
                <span v-if="memoviewdata.status==3" class="badge badge-danger"> ไม่อนุมัติ </span>
        </div>
   
      </div>
  <div  v-if="memoviewdata.status!=1" class="row mt-1">
       <label  class="col-md-4">ตรวจสอบเมื่อ :</label>
        <div  class="col-md-8">{{memoviewdata.updated_at}}</div>
   
      </div>
             <div  v-if="memoviewdata.status!=1" class="row mt-1">
        <label class="col-md-4">ผู้ตรวจสอบอนุมัติ :</label>
        <div v-if="memoviewdata.approve_by>0"  class="col-md-8">{{ userlistnewindex[memoviewdata.approve_by].fullname}}</div>
   
      </div>





        
      </div>
      <div class="modal-footer">
        <span v-if="(role_id==2 || role_id==6) && memoviewdata.status==1 ">
         <button  type="button" class="btn btn-success" @click="aprovesubmit('Y')"  >อนุมัติ</button>
          <button type="button" class="btn btn-danger" @click="aprovesubmit('N')"  >ไม่อนุมัติ</button>
          </span>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div> 
{{ role_id }}
    </div>
</template>

<script>
import Vue from 'vue';
import vSelect from 'vue-select'
import VueSweetalert2 from 'vue-sweetalert2';
 
Vue.use(VueSweetalert2);
Vue.component('v-select', vSelect);
import 'vue-select/dist/vue-select.css';

import vueNumeralFilterInstaller from 'vue-numeral-filter';
 
Vue.use(vueNumeralFilterInstaller, { locale: 'en-gb' });




import Buefy from 'buefy'


Vue.use(Buefy)

    export default {
          props: ['userfullname', 'userid','baseurl','csrf','role_id'],
 components: {

  },
             mounted() {
           this.customerData();
           this.productsData();
          this.checkpricre();
          this.getmemolist();
          this.getuserlist()
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
      options: [],
    selected:'',
    selectedCustomer:'',
    optionsCustomer:[],
    pricetype:'',
    nowpricename :'',
    nowpricevalue :'',
    memonewpricre:'',
    memoremark:'',
    alertstatus:[],
    resonselected:'',
    pricerangedateinput:'',
memopriceList:[],

                perPage:10,
                total :0,
                total2 :0,
                memoviewdata:[],
                memopriceListnoapprove:[],
                memopriceListapprove:[],
                userlist:[],
userlistnewindex:[],
        }},
            methods: {
       customerData(){
         axios.get(this.baseurl+'/api/customer_list')
  .then((response)=>{
   this.customerlist = response.data;   

let i = 0; 
let len = this.customerlist.length;
this.optionsCustomer = [];
for (; i < len; i++) {
 this.optionsCustomer[i] = {};
  this.optionsCustomer[i]['label'] = this.customerlist[i].customercode+' - '+ this.customerlist[i].name;
  this.optionsCustomer[i]['code'] = this.customerlist[i].customercode;

}

 })
 },
        productsData(){
         axios.get(this.baseurl+'/api/products_list')
  .then((response)=>{
   this.productslist = response.data; 
let i = 0; 
let len = this.productslist.length;
this.options = [];
for (; i < len; i++) {
 this.options[i] = {};
  this.options[i]['label'] = this.productslist[i].code+' - '+ this.productslist[i].name;
  this.options[i]['code'] = this.productslist[i].code;

}
 
 })
 }
 ,
  checkpricre(){ 
    let productcode =  this.selected.code;
    let customertype =  this.cutomertype;
    let customercode =  this.selectedCustomer.code;
    let pricetype =  this.pricetype;
axios.post(this.baseurl+'/api/meoprice_checkprice',{
productcode : productcode ,
customertype :customertype,
customercode: customercode,
pricetype : pricetype,
         })
  .then((response)=>{
    console.log(response.data);
      this.nowpricevalue =  response.data.pricenow;
      this.nowpricename =  response.data.pricename;
 })

 }
 ,addmemo(){
this.pricerangedateinput = document.getElementById("pricerangedate").value;
if(this.changepricetime==3 && this.pricerangedateinput =='' ){

  Vue.swal({
  icon: 'error',
  title: 'ข้อมูลช่วงเวลาไม่ถูกต้อง',
  text: 'กรุณาระบุช่วงเวลา',

});
}
else{


   if(this.memonewpricre && this.resonselected){
  Vue.swal({
  title: 'ยืนยันการส่ง Memo ?',
  text: "คุณต้องการส่ง Memo เพื่อขออนุมัติปรับราคา "+this.selected.label+" เป็น "+parseFloat(this.memonewpricre).toLocaleString()+" บาท ใช่หรือไม่",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ยืนยัน',
  cancelButtonText: 'ยกเลิก'
}).then((result) => {
  if (result.value) {
//<--------------
axios.post(this.baseurl+'/api/meoprice_add',{



productcode : this.selected.code,
reson :  this.resonselected,
when : this.changepricetime,
daterange :  this.pricerangedateinput,
customertype : this.cutomertype,
customercode : this.selectedCustomer.code,
typeprice  : this.pricetype,
remark :this.memoremark,
price_now :this.nowpricevalue,
price_new : this.memonewpricre,
userid :this.userid


  })
 .then((response)=>{
  this.alertstatus=response.data.alertstatus; 

  Vue.swal({
  icon: response.data.alertstatus.icon,
  title: response.data.title,
  text: response.data.alertstatus.text,
  toast: true,
  timer: 2000,
  timerProgressBar: true,
  
});

 this.getmemolist();



 })

//-------------->
    
  }
})
   }else{
  Vue.swal({
  icon: 'error',
  title: 'ข้อมูลไม่ถูกต้อง',
  text: 'กรุณากรอกข้อมูลให้ครบถ้วนและถูกต้อง',

});
   }
 }
 },

getmemolist(){
         axios.get(this.baseurl+'/api/memoprice_list')
  .then((response)=>{
   this.memopriceList = response.data; 

   this.total = 0;
   this.total2 = 0;
let i = 0; 
let len = this.memopriceList.length;
this.options = [];
this.memopriceListnoapprove=[];
this.memopriceListapprove=[];
for (; i < len; i++) {

let memostatus = this.memopriceList[i].status;

if(memostatus==1){
this.total =this.total+1;
this.memopriceListnoapprove[this.total-1] = this.memopriceList[i];
this.memopriceListnoapprove[this.total-1].rownumber = this.total;
}else{
  this.total2 =this.total2+1;
this.memopriceListapprove[this.total2-1] = this.memopriceList[i];
this.memopriceListapprove[this.total2-1].rownumber = this.total2;

}

}
 
 })
 },
viewmemo(id){
           axios.post(this.baseurl+'/api/memoprice_view',{
id : id
           })
  .then((response)=>{
   this.memoviewdata = response.data;   
let pdcode= this.memoviewdata.mmp_productcode;
   this.memoviewdata.productdt = this.productslist.filter(a=>a.code==pdcode);

   let cuscode= this.memoviewdata.mmp_customer;
   this.memoviewdata.customerdt = this.customerlist.filter(b=>b.customercode==cuscode);


   let resonid= this.memoviewdata.mmp_reson;
   this.memoviewdata.reson = this.reasons.filter(b=>b.value==resonid);

})

},getuserlist(){
   axios.post(this.baseurl+'/api/user_list')
  .then((response)=>{
   this.userlist = response.data;   
let i = 0; 
let len = this.userlist.length;
this.userlistnewindex=[];
for (; i < len; i++) {
let userid =  this.userlist[i].id
this.userlistnewindex[userid] = this.userlist[i]; 
}

})

},
aprovesubmit(type){

 if(type=='Y'){

 
  Vue.swal({
  title: 'ยืนยันการอนุมัติราคา ?',
  text: "อนุมัติการปรับราคา Memo No. : "+this.memoviewdata.memonumber+" สินค้า "+this.memoviewdata.productdt[0].code+" - "+this.memoviewdata.productdt[0].name+" เป็น "+parseFloat(this.memoviewdata.price_new).toLocaleString()+" บาท ใช่หรือไม่",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ยืนยัน',
  cancelButtonText: 'ยกเลิก'
}).then((result) => {
  if (result.value) {

$('#exampleModal').modal('hide');

axios.post(this.baseurl+'/api/memoprice_approve',{
memoid : this.memoviewdata.id,
statustype :2,
approve_by :this.userid,
           })
  .then((response)=>{

      this.alertstatus=response.data.alertstatus; 

  Vue.swal({
  icon: response.data.alertstatus.icon,
  title: response.data.title,
  text: response.data.alertstatus.text,
  toast: true,
  timer: 2000,
  timerProgressBar: true,
  });
this.getmemolist();

});


  }
});
 }else{


  Vue.swal({
 title: 'ยืนยันการ ไม่อนุมัติราคา ?',
  text: "ไม่อนุมัติการปรับราคา Memo No. : "+this.memoviewdata.memonumber+" สินค้า "+this.memoviewdata.productdt[0].code+" - "+this.memoviewdata.productdt[0].name+" เป็น "+parseFloat(this.memoviewdata.price_new).toLocaleString()+" บาท ใช่หรือไม่",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ยืนยัน',
  cancelButtonText: 'ยกเลิก'
}).then((result) => {
    if (result.value) {
$('#exampleModal').modal('hide');
this.getmemolist();
axios.post(this.baseurl+'/api/memoprice_approve',{
memoid : this.memoviewdata.id,
statustype :3,
approve_by :this.userid,
           })
  .then((response)=>{

  this.alertstatus=response.data.alertstatus; 
  console.log(response.data.memodt);

  Vue.swal({
  icon: response.data.alertstatus.icon,
  title: response.data.title,
  text: response.data.alertstatus.text,
  toast: true,
  timer: 2000,
  timerProgressBar: true,
});
this.getmemolist();

});

    }
});

 }
}
 },watch:{
selected(){
 this.checkpricre(); 
},
cutomertype(){
this.checkpricre();   
}
,selectedCustomer(){
  this.checkpricre();  
}
,pricetype(){
   this.checkpricre();   
}

 },computed: {
selected(){
 this.checkpricre(); 
}
 }
    }
</script>

<style>
#customerlistbox .select2-container {
width: 100% !important;
}
/* Datatable CSS */
.v-datatable-light{
  width: 100%;
}
.tbody-td,.thead-th{
border:1px solid #ccc;
padding:2px
}

ul.pagination-list {
    list-style: none;
    margin-left: 0;
    margin-top: 0;
}

ul.pagination-list li + li {
    margin-top: 0;
}
</style>
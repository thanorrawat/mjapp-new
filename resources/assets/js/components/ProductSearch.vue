<template>
    <div class=" content is-small"  >

        <order-selectcustomer :baseurl="baseurl" :orderid="orderid" :orderdtall="orderdtall" ></order-selectcustomer>

<div v-if="orderdt.order_status === 1 || orderdt.order_status === 2 " class="row">
<div class="col-md-4">
<div class="card">
              <div class="card-header border-transparent">
          
    <h4 style="display:inline" >เลือกสินค้า</h4>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body ">
                  
<div class="row"><div class="col-md-6 ">

<div class="mb-1" v-if="historylist_code.length>0">
<div  class="icheck-warning d-inline">
<input type="radio" id="listsearchtype_1" name="listsearchtype" value="1" v-model="showsearchtype"  required>
<label for="listsearchtype_1">จากประวัติการขาย</label></div>

<div class="icheck-warning  d-inline">
<input type="radio" id="listsearchtype_2" name="listsearchtype" value="2" v-model="showsearchtype"   required>
<label for="listsearchtype_2"> ทั้งหมด  </label>  </div>
</div>

</div></div>

                  <div class="input-group mb-3">
                  <input type="text" class="form-control" v-model="searchtext" @input="searchget">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                  </div>
                </div>

                <div id="showsearchall"  class="table-responsive">

<ul class="products-list product-list-in-card pl-2 pr-2">
                  <li  class="item" v-for="(product,index) in products" @click="showProductDt(index)">
                  <div class="row">
     <div class="col-3 text-center">
                      <img :src="baseurl+'/public/images/product/'+product.image"  class="img-size-50">
     </div>
<div class="col-6">

     <a href="javascript:void(0)" class="product-title"><text-highlight :queries="queries">{{ product.code}} - {{ product.name}}</text-highlight>
     </a><br><text-highlight :queries="queries"> {{ product.product_details }}</text-highlight>
                        
                        


</div>
<div class="col-3 text-right">
                           <span class="badge badge-warning "><strong>STOCK : </strong> {{ product.qty  | numeral('0,0')}}</span> 
                        <span v-if="historylist_sumsale[product.code]>0" class="badge badge-danger  mr-1"> <strong>Sale : </strong> {{ historylist_sumsale[product.code]  | numeral('0,0')}}</span>
  <br>   <strong>{{categorynamelist[product.category_code] }} </strong></div>
                  </div>
                   


</li>
                  <!-- /.item -->             
                </ul>
                </div>
                <!-- /.table-responsive -->
                   <div v-if="productsall>0"  class="text-center pagingrow ">
 <div class="">จำนวนทั้งหมด {{ productsall  | numeral('0,0') }} รายการ  / {{ allpage  | numeral('0,0') }} หน้า</div>
         
          <div class=""><v-pagination v-model="currentPage" :page-count="totalPages" :classes="bootstrapPaginationClasses"></v-pagination></div>
      </div>
              </div>
                    <!-- /.card-footer -->
            </div>


</div>
<div class="col-md-3 ">
           <div v-if="productshow[0] || productshow.code " class="card">
<div class="card-body">
     <h4>รายละเอียดสินค้า</h4>
<div class="row">
  <div class="col-md-5">

     <img :src="baseurl+'/public/images/product/'+productshow.image"  class="img-thumbnail">
</div>
  <div class="col-md-6">
 
      <strong>{{  productshow['name'] }} </strong>
      <div> <strong>Code : </strong>  {{  productshow['code'] }}  </div>
      <div> <strong>หมวดสินค้า : </strong>  {{categorynamelist[productshow.category_code] }} </div>
<p id="productsdetails">
<!-- <strong>Product Details : </strong> -->
 {{  productshow['product_details'] }}
</p>
<strong>ประวัติการขาย : </strong> {{ historylist_sumsale[productshow['code']]  | numeral('0,0')}} ชิ้น
</div>
</div>
<div class="row mt-2">

  <div class="col-2 text-right"> จำนวน</div>
  <div class="col-4"><input type="number" min="1" class="form-control text-right" v-model="addqty"></div>
  <div class="col">   <button @click="addtodorder(productshow['id'])" class="btn btn-primary btn-flat">
               
                  <i class="far fa-plus-square mr-2"></i>
              {{ buttonlabeladd }}
                </button>   </div>
</div>

              
<ul v-if="diffstockadd<0" class="nav nav-pills flex-column">
                  <li class="nav-item active p-1 m-1" style="border:1px solid red;">
           
         <i class="fas fa-exclamation-triangle text-danger"></i> จำนวนที่ขาด : {{ diffstockaddnumber | numeral('0,0')  }} ชิ้น
               
                
                  </li>
          
            
     
                </ul>
    <!-- {{  productshow }}    -->
       <div class="row mt-1">
                  <div class="col border-right">
                    <div class="description-block">
                      <h5 class="description-header"> {{  stocklist.sumstock1 | numeral('0,0') }}</h5>
                      <span class="description-text">Stock เพื่อขาย</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{  stocklist.sumstock2 | numeral('0,0') }}</h5>
                      <span class="description-text">Order</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col">
                    <div class="description-block">
                      <h5 class="description-header">{{  stocklist.sumstock3 | numeral('0,0') }}</h5>
                      <span class="description-text">จอง</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
     <div class="row mt-1 ">
<h2  class="text-center"> 
ราคาขาย : {{  productprice.priceorder  }}</h2>
<div class="col-12" >
  <b-message type="is-info" >
  <strong>ราคาสำหรับ</strong>
<span v-if="productprice.cuscode"> เฉพาะลูกค้ารหัส {{ productprice.cuscode }}</span>

<span v-if="productprice.typeprice && productprice.typeprice!='SPC' "> Standard {{ productprice.typeprice }}</span>
<span v-if="productprice.pricetime==3" > ช่วงเวลา :  {{ productprice.daterange }}</span>
<span v-if="productprice.once_time==1"> เฉพาะครั้งนี้</span>
</b-message>
</div>

     </div>
   

</div>
</div>

<!-- Relate -->
<div class="card">
<div class="card-body">
<h4>สินค้าใกล้เคียง</h4>
Keyword :  {{relatekey }}
                <div id="relateproducts"  >

<div class="row">
                  <div class=" col-sm-6 mb-2" v-for="(relate_product,index) in relate_products" @click="showProductrelate(index)">
                    <div class="item">
                      <img :src="baseurl+'/public/images/product/'+relate_product.image"  class="img-size-50 float-left mr-2" >
                    
                    <div class="product-info p-1">
               <text-highlight :queries="relate_queries">{{ relate_product.code}} - {{ relate_product.name}}</text-highlight>
                        <span class="badge badge-warning "><strong>STOCK : </strong> {{ relate_product.qty  | numeral('0,0')}}</span> 
                        <span v-if="historylist_sumsale[relate_product.code]>0" class="badge badge-danger "> <strong>Sale : </strong> {{ historylist_sumsale[relate_product.code]  | numeral('0,0')}}</span>

                        <div class="p-1 bg-light text-dark">
                    <strong>{{categorynamelist[relate_product.category_code] }} </strong>
                        </div>
                    </div>

                    </div>
                  </div>
                  <!-- /.item -->             
                </div>
                </div>

</div>
</div>
<!-- Relate -->


</div>

<!-- รายการที่เลือกแล้ว -->
<div class="col-md-5">
           <div class="card">
<div class="card-body">


     <h4>รายการที่เลือก</h4>


<table id="orderlist" class="table table-bordered">
<thead><tr>
<th>ที่</th>
<th>Image</th>
<th>รายละเอียดสินค้า</th>
<th>จำนวน</th>
<th>#</th>
</tr></thead>

   <tbody>
     <tr v-for="(productorder,index) in productlistinorder" >
       <td>{{(index+1)}}</td>
       <td  ><img :src="baseurl+'/public/images/product/'+productorder.image"  class="img-size-50"  ></td>
       <td @click="showProductinorderdt(index)">   <strong >{{productorder.productscode}}</strong>
         <br>
         {{productorder.name}}
       </td>
       <td   class="text-right">{{productorder.orderqty | numeral('0,0') }}

<i style="font-size:90%" data-toggle="modal" data-target="#editqty" class="fas fa-pencil-alt" @click="editqtyorder(index)"></i>

       </td>
    
<td @mouseover="showProductinorderdt(index)" ><i  class="fas fa-backspace  text-danger" @click="removepd(index)"></i></td>


     </tr>
     <tr>
<td></td>
<td></td>
<td class="text-right"><strong>รวม</strong></td>
<td class="text-right">{{ totalorderqty | numeral('0,0')  }}</td>
<td></td>
     </tr>
   </tbody>
</table>
<div v-if="productlistinorder.length > 0"class="approveblock">
<h4>หมายเหตุ</h4>
<textarea class="form-control" v-model="orderdt.remark"></textarea>
<div class="text-center"> <button @click="sendforapprove" class="btn btn-warning btn-lg mt-1"> <i class="far fa-paper-plane"></i> ส่ง {{  doctypename }} เพื่อขออนุมัติ</button> </div>
</div>
</div>
</div>
</div>
<!-- รายการที่เลือกแล้ว -->

</div>

 <div id="modalloder" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
 
      <div class="modal-body text-center">
<img :src="baseurl+'/assets/images/sendmail.gif'" alt="">
<h3>กำลังดำเนินการส่งข้อมูลกรุณารอสักครู่</h3>
      </div>
  
    </div>
  </div>
</div>
    


<!-- Modal -->
<div class="modal fade" id="editqty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขจำนวน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

              {{ editqtyorderdetail.name }}
         <div class="row mt-2">
           <div class="col-4 text-right">
             <strong>จำนวน : </strong>
              </div>
          
           <div class="col-4">
             <input min="1"  class="form-control text-right" type="number" v-model="editqtynew"></div>
           <div class="col"> <button @click="editqtysumit" type="button" class="btn btn-primary">Save changes</button></div>
         </div>
เปลี่ยนแปลง : {{newtracking_qty }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
                 
 <div v-if="orderdt.order_status === 21 || orderdt.order_status === 11 " class="alert alert-primary text-center" role="alert">

   <h4><i class="fas fa-info-circle"></i></h4>
<h4>อยู่ระหว่างการรอนุมัติจาก ผู้จัดการ</h4>
</div>
{{ productprice }}

 </div>



</template>


<script>
import Vue from 'vue';
import TextHighlight from 'vue-text-highlight';
import vPagination from 'vue-plain-pagination'
import Select2 from 'v-select2-component';
import DatePick from 'vue-date-pick';
import 'vue-date-pick/dist/vueDatePick.css';
import VueSweetalert2 from 'vue-sweetalert2';
import vueNumeralFilterInstaller from 'vue-numeral-filter';
 
Vue.use(vueNumeralFilterInstaller, { locale: 'en-gb' })
Vue.use(VueSweetalert2);

 Vue.component('text-highlight', TextHighlight);
 Vue.component('date-pick', DatePick);
Vue.use(VueSweetalert2);
    export default {
        name: 'product-search',
          props: ['baseurl','orderid','showsearchtype','userid','userfullname'],
        mounted() {
this.orderdtget();
this.searchget();
this.categoryname();
this.showproductsinoreder();

        },
         components: { vPagination },
        data(){
    return{
        searchtext :'',
        show:'',
        productscount:'',
        productsall:'',
        allpage:'',
        products:[],
        // groups:[],
        // checkedCategory:[],
        queries: '',
        currentPage: 1,
        totalPages: 485,
        bootstrapPaginationClasses: {
        ul: 'pagination float-right',
        li: 'page-item',
        liActive: 'active',
        liDisable: 'disabled',
        button: 'page-link'  ,

      },  orderdt :[],
        doctypename:null,
        customerdt : [],
datelabel1 :'วันที่ทำรายการ',
datelabel2 : 'กำหนดส่ง',
buttonlabel : 'สร้างใบOrder',
buttonlabeladd : 'เพิ่มในOrder',
newdate:null,
newselectdate:null,
doctypecheck:'1',
selectdate:[],
orderdtall:[],
productshow:[],
customercode:'',
histories:[],

historylist_sumsale:[],

historylist_code:[],
stocklist:[],
cat_code:'',
categorynamelist:[],
relatekey:'',
relate_products:[],
relate_queries:'',
addproductorder :[],
addqty:1,
alertstatus:[],
productlistinorder:[],
docfullnumber:'',
totalorderqty:0,
diffstockadd:'',
editqtyorderdetail:[],
newtracking_qty:0,
editqtynew:0,
orderremark:'',
productprice:[],
    }
},
    watch: {
// searchtext: function() { //ถ้าค่า searchtext เปลี่ยน
// this.currentPage=1;
//  this.searchget() //เรียกใช้ฟังก์ชั่น

//      },
currentPage: function() { //ถ้าค่า currentPage เปลี่ยน
 this.searchget() //เรียกใช้ฟังก์ชั่น

 
 
     }

,doctypecheck: function() { //ถ้าค่า searchtext เปลี่ยน

   if(this.doctypecheck===1){
    
  this.datelabel1 = 'วันที่ทำรายการ';
  this.datelabel2 = 'กำหนดส่ง';
 this.buttonlabel ='สร้างใบOrder';
 this.buttonlabeladd ='เพิ่มในOrder';

 }else if(this.doctypecheck===2){

   this.datelabel1 = 'วันที่จอง';
  this.datelabel2 = 'วันที่สิ้นสุดการจอง';
 this.buttonlabel ='สร้างใบจอง';
 this.buttonlabeladd ='เพิ่มในใบจอง';


    }
 
     },

     customercode: function() {
this.searchget();
this.currentPage=1;
     },
     showsearchtype : function() {
this.searchget();
this.currentPage=1;
     }
,productshow : function() {
this.checkstock();
this.relateproduct();
this.diffstockadd = '';
     }
     ,productlistinorder: function(){

    let sum = 0;
      for(let i = 0; i < this.productlistinorder.length; i++){
        sum += (parseFloat(this.productlistinorder[i].orderqty));
      }
//console.log(sum);
     this.totalorderqty = sum;
 
     },
     addqty: function() {
this.diffstockadd = this.stocklist.sumstock1 - this.addqty;
if(this.diffstockadd<0){
this.diffstockaddnumber = -(this.diffstockadd);
}     }
,editqtynew: function() {

let index =  this.editqtyorderdetail.indexorder
let oldqty =  this.productlistinorder[index].orderqty
  

this.newtracking_qty=this.editqtynew -oldqty
}
     
     },




///////////////////////
     methods: {
     searchget: function() {  //ฟังก์ชั่น
  axios.get(this.baseurl+'/api/orderproducts-search?searchtext='+this.searchtext+'&page='+this.currentPage+'&customer='+this.customercode+'&showsearchtype='+this.showsearchtype)
  .then((response)=>{
              this.products=response.data.products; 
              this.show=response.data.search; 
              this.productscount = response.data.productscount; 
              this.productsall = response.data.productsall; 
              this.allpage = response.data.allpage; 
              this.queries = response.data.searchhilight; 
              this.totalPages= response.data.allpage; 
              this.offset= response.data.offset; 
              // this.groups= response.data.grouped; 
              // this.checkedCategory= response.data.categoryselect; 
              this.histories= response.data.salehistory; 
              this.historylist_sumsale= response.data.historylist_sumsale; 
              this.historylist_code= response.data.historylist_code; 
              if(!this.productshow){
this.showProductDt(0)   
              }

     
 })
 
     },     relateproduct: function() {  //ฟังก์ชั่น
  axios.get(this.baseurl+'/api/orderproducts-search?searchtext='+this.relatekey+'&page=1&customer='+this.customercode+'&showsearchtype=2&relate='+this.productshow['id'])
  .then((response)=>{
              this.relate_products=response.data.products; 
              this.relate_queries = response.data.searchhilight; 

     
 })
 
     }



     , orderdtget: function() {  //ฟังก์ชั่น
  axios.get(this.baseurl+'/api/orderdt/'+this.orderid)
  .then((response)=>{
      this.orderdtall=response.data 
              this.orderdt=response.data.orderdt 
              this.doctypename=response.data.doctypename 
              this.customerdt=response.data.customer
this.doctypecheck=response.data.orderdt['doctype'] 

this.selectdate = response.data.orderdt['deliverydate'] 
this.customercode = response.data.customer['customercode'] 
              
                            
 })
 
     },showProductDt(index){
this.productshow = this.products[index]
let productname = this.products[index].name
this.changrelatekey(productname);

 
     },
changrelatekey(productname){
this.relatekey1 = productname.substring (0,7); //lo w
this.relatekey1arr = this.relatekey1.split(" ");
this.relatekey = this.relatekey1arr[0]
this.relatekey2arr = productname.split("สี");
if(this.relatekey2arr[1]!==null){
  this.relatekey2 =  this.relatekey2arr[1].substring (0,5).split(" ");
this.relatekey =this.relatekey+' '+this.relatekey2[0]
}

}, showProductrelate(index){
this.productshow = this.relate_products[index]

     }
     
     ,
     showProductinorderdt(index){
this.productshow = this.productlistinorder[index]

this.productshow['name']  =this.productlistinorder[index].name;
this.productshow['code'] = this.productlistinorder[index].productscode;
this.productshow['category_code']=this.productlistinorder[index].category_code;
this.productshow['product_details']=this.productlistinorder[index].product_details;
this.productshow['id']=this.productlistinorder[index].pdid;
let productname = this.productlistinorder[index].name;
this.changrelatekey(productname);
     },
     checkstock: function() {  //ฟังก์ชั่น

  axios.get(this.baseurl+'/api/checkstock/'+this.productshow['code'])
  .then((response)=>{
    this.stocklist=response.data.stocklist; 

     
 })
this.checkthisprice(); 
 
 }
,
 categoryname : function() {  //ฟังก์ชั่น
  axios.get(this.baseurl+'/api/categorynamelist')
  .then((response)=>{
    this.categorynamelist=response.data; 
   
 })

 
 },
  addtodorder(productid) {  //ฟังก์ชั่นเพิ่มสินค้า



     if(this.addqty && this.userid && this.orderid ){


  axios.post(this.baseurl+'/api/addproducttoorder',{
    productid : productid,
    orderid :this.orderid,
    addqty :this.addqty,
    productscode : this.productshow['code'],
    doctype : this.orderdt.doctype,
    orderdetails : this.orderdt,
    stocknow:this.stocklist.sumstock1,
    userfullname:this.userfullname,
    userid:this.userid,
  }
  )
  .then((response)=>{
  this.alertstatus=response.data.alertstatus; 
  this.productlistinorder=response.data.productlistinorder; 


  
  Vue.swal({
  icon: response.data.alertstatus.icon,
  title: response.data.title,
  text: response.data.alertstatus.text,
  toast: true,
  timer: 2000,
  timerProgressBar: true,
  
});
this.checkstock();   
 this.showproductsinoreder();
 })


     }

 

 
 }
 ,showproductsinoreder(){
  axios.get(this.baseurl+'/api/showproductinorder/'+this.orderid)
  .then((response)=>{
  this.productlistinorder=response.data; 
   
 })
 },removepd(index){

   Vue.swal({
  title: 'ยืนยันการลบสินค้า?',
  text: "คุณต้องการลบสินค้า "+this.productlistinorder[index].productscode+" ออกจากรายการ"+this.doctypename+"นี้ใช่หรือไม่",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ใช่ ลบได้เลย',
  cancelButtonText: 'ไม่ต้องการลบ'
}).then((result) => {
  if (result.value) {
//<--------------

axios.post(this.baseurl+'/api/removeproducttoorder',{
    productid : this.productlistinorder[index].pdid,
    orderid :this.orderid,

    orderproductid : this.productlistinorder[index].pdorderid,

    
    addqty : this.productlistinorder[index].orderqty, 
    productscode : this.productlistinorder[index].productscode,
    doctype : this.orderdt.doctype,
    orderdetails : this.orderdt,
    userfullname:this.userfullname,
    userid:this.userid,
  })
 .then((response)=>{
  this.alertstatus=response.data.alertstatus; 
  this.productlistinorder=response.data.productlistinorder; 

  Vue.swal({
  icon: response.data.alertstatus.icon,
  title: response.data.title,
  text: response.data.alertstatus.text,
  toast: true,
  timer: 2000,
  timerProgressBar: true,
 
  
});
 this.showproductsinoreder();
  this.checkstock();




 })

//-------------->
    
  }
})

 },editqtyorder(index){

this.editqtyorderdetail = this.productlistinorder[index]
this.editqtynew=this.productlistinorder[index].orderqty
this.editqtyorderdetail.indexorder = index

this.showProductinorderdt(index);
 }
//  ,editqtyinput: function() {
// let indexorder = this.editqtyorderdetail.indexorder;
// let oldqty = this.productlistinorder[indexorder].orderqty
// console.log(oldqty);
// this.newtracking_qty = (+this.editqtynew)-(+oldqty)
//      }
,editqtysumit(){

  if(this.newtracking_qty===0){
      Vue.swal({
  icon: "error",
  title: "ไม่มีการเปลี่ยนแปลง",
  text: "กรูณาเปลี่ยนจำนวนก่อนการบันทึก",
  toast: true,
  timer: 2000,
  timerProgressBar: true,
  
});
  }else{

///////แก้ไขจำนวน


  axios.post(this.baseurl+'/api/editqtyproducttoorder',{
    orderproductid : this.editqtyorderdetail.pdorderid,
    productid : this.editqtyorderdetail.pdid,
    orderid :this.orderid,
    addqty :this.editqtynew,
    diffqty :this.newtracking_qty,
    productscode : this.editqtyorderdetail.productscode,
    doctype : this.orderdt.doctype,
    orderdetails : this.orderdt,
    stocknow:this.editqtyorderdetail.stocknow,
    userfullname:this.userfullname,
    userid:this.userid,
  }
  )
  .then((response)=>{
  this.alertstatus=response.data.alertstatus; 
  this.productlistinorder=response.data.productlistinorder; 

 
  Vue.swal({
  icon: response.data.alertstatus.icon,
  title: response.data.title,
  text: response.data.alertstatus.text,
  toast: true,
  timer: 2000,
  timerProgressBar: true,

});

  $('#editqty').modal('hide')
this.checkstock();   

 })


/////////





   
}
     },
     
     sendforapprove(){
Vue.swal({
  title: 'ยืนยันการส่งเอกสารเพื่อขออนุมัติ',
  text: "ท่านต้องการส่ง "+this.doctypename+" เพื่อขออนุมัติจากผู้จัดการ ใช่หรือไม่?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ใช่',
  cancelButtonText: 'ไม่ ยกเลิการส่ง'
}).then((result) => {
 if (result.value) {
//---
$('#modalloder').modal('show');

  axios.post(this.baseurl+'/api/notify/ordersendmanager',{
  confirm : 1,
  doctype : this.orderdt.doctype,
  ordernumberfull : this.orderdt.ordernumberfull,
  order_id : this.orderdt.id,
  remark : this.orderdt.remark,
  bookingnumber : this.orderdt.bookingnumber,
 userid:this.userid,
  

    
  }
  )
  .then((response)=>{
  this.alertstatus=response.data.alertstatus; 
  this.orderdt=response.data.orderdt; 

$('#modalloder').modal('hide');
 
  Vue.swal({
  icon: response.data.alertstatus.icon,
  title: response.data.title,
  text: response.data.alertstatus.text,

});

});
 }





//--

});

     },checkthisprice(){
         axios.post(this.baseurl+'/api/order_checkprice',{
productcode : this.productshow.code,
cuscode : this.customercode,
typeprice : this.orderdtall.customer.price_group,

         }).then((response)=>{ 

           this.productprice = response.data

         });
     }

////////////////////////////////
     }
     ,
 computed: {

}

    }
    
</script>

<style >
.search-box {
    font-size: 18px;
    padding: 0.4em;
    width: 100%;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
border: 1px sloid #ccc;
    background: #fff url('https://image.flaticon.com/icons/svg/1086/1086933.svg') no-repeat center right 24px/32px !important;
    border-radius: 4px;
margin-bottom: 1em;
}
.pagingrow{

margin-bottom: 0.5em;


}
.searchlist{
    border-bottom: #ccc 1px solid;
}
.searchlist:hover{
  background: #ccc;
}
.description-block{
 font-size: 0.8rem;
}
.text__highlight{
  background:#fff9dd !important;
   padding:0;
   }
#relateproducts .item{
     font-size: 80%;
     border: #ccc 1px solid;
   }
#orderlist i:before {
    font-size: 80%;
}
#orderlist td,#orderlist th{
border-width: thin;
}

</style>
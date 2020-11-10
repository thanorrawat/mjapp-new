<template>

<div>
<button v-if="(orderdtall.orderdt.order_status=='11' || orderdtall.orderdt.order_status=='21') && (role_id==1||role_id==2||role_id==7) " @click="editblock" class="btn btn-warning  mb-1" >{{ texteditbutton }}</button>

 <!-- <div v-if="showedit===2" class="table-responsive" id="orderdt"></div> -->
<div v-if="showedit===1" class="text-right">
<button  @click="showcancelproducts()"  data-toggle="modal" data-target="#canceled" class="btn btn-outline-danger  mb-1" > Canceled Product</button>

</div>

 <table  v-if="showedit===1"  id="orderlist" class="table table-bordered">

<thead><tr>
<th>ที่</th>
<th>{{ langtranslate.Image }}</th>
<th>รายละเอียดสินค้า</th>
<th>Info</th>
<th>ราคา</th>
<th>จำนวน</th>
<th>รวม</th>
<th>#</th>
</tr></thead>

   <tbody>
     <tr v-for="(productorder,index) in productlistinorder" >
       <td>{{(index+1)}}

  
       </td>
       <td  ><img :src="baseurl+'/public/images/product/'+productorder.image"  class="img-size-50"  ></td>
       <td @click="showProductinorderdt(index)">   <strong >{{productorder.productscode}}</strong>
         <br>
         {{productorder.name}}
       </td>
   <td class="content is-small">
<order-product-stock :baseurl="baseurl" :productcode="productorder.productscode" :orderqty="productorder.orderqty" :canclepd="productorder.canclepd"  ></order-product-stock>

   </td>
<td   class="text-right">{{productorder.orderprice| numeral('0,0') }} </td>
<td   class="text-right">{{productorder.orderqty | numeral('0,0') }}

<i style="font-size:90%" data-toggle="modal" data-target="#editqty" class="fas fa-pencil-alt" @click="editqtyorder(index)"></i>

       </td>
<td   class="text-right">{{productorder.amount| numeral('0,0') }} </td>
<td>

<button  v-if="productorder.canclepd==0" @click="canclepd(index)" class="btn btn-danger btn-sm">{{ langtranslate.cancel }}</button>
</td>


     </tr>
     <tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td class="text-right"><strong>รวม</strong></td>
<td class="text-right">{{ totalorderqty | numeral('0,0')  }}</td>
<td class="text-right">{{ ordertotalamount | numeral('0,0')  }}</td>

<td></td>
     </tr>
   </tbody>
</table>



<div  id="orderdt" v-show="showedit===2" v-html="orderview"></div>


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
      <div class="modal-body"> {{ editqtyorderdetail.name }}

              
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



<!-- Modal canceled -->
 <div class="modal fade" id="canceled" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Canceled</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body content is-small"> 
        


<table  v-if="showedit===1"  id="orderlist" class="table table-bordered">

<thead><tr>
<th>ที่</th>
<th>รายละเอียดสินค้า</th>
<th>Info</th>
<th>ราคา</th>
<th>จำนวน</th>
<th>รวม</th>
<th>#</th>
</tr></thead>

   <tbody>
     <tr v-for="(productcancel,index) in cancelproducts" >
       <td>{{(index+1)}}

  
       </td>
            <td>   <strong >{{productcancel.productscode}}</strong>
         <br>
         {{productcancel.name}}
       </td>
   <td>
<order-product-stock :baseurl="baseurl" :productcode="productcancel.productscode" :orderqty="productcancel.orderqty" :canclepd="productcancel.canclepd"  ></order-product-stock>

   </td>
<td   class="text-right">{{productcancel.orderprice| numeral('0,0') }} </td>
<td   class="text-right">{{productcancel.orderqty | numeral('0,0') }}


       </td>
<td   class="text-right">{{productcancel.amount| numeral('0,0') }} </td>
<td>

<button  v-if="productcancel.canclepd==1" @click="readdcanclepd(index)" class="btn btn-primary btn-sm">{{ langtranslate.Re_Add_to_List }}</button>
</td>


     </tr>

     <tr>

       <td colspan="7" class="text-center"> {{ langtranslate.No_Data }} </td>
     </tr>

   </tbody>
</table>




       
      </div>
    </div>
  </div>
</div>

</div>
</template>

<script>
import Vue from 'vue';
import Buefy from 'buefy'
Vue.use(Buefy)
    export default {
                  props: ['orderurl','orderid','baseurl','userid','userfullname','role_id'],
        mounted() {
            this.loadorderdt();
      this.orderdtget();
      this.addproductpricecode();
this.langget();
        },
      
    data(){
    return{
  showedit :2,
 orderview:null,
 productlistinorder:[],
 texteditbutton:'',
 stocklist:[],
 editqtynew:0,
 ordertotalamount:0,
 editqtyorderdetail:[],
 productlistinorder:0,
 productprice:[],
 productshow:[],
 orderdtall:[],
 langtranslate:[],
 cancelproducts:[],
 }
  },
           methods: {
                      langget: function() {  //ฟังก์ชั่น
  axios.get(this.baseurl+'/api/LanguageTraslate')
  .then((response)=>{
this.langtranslate = response.data ;
 this.texteditbutton=this.langtranslate.edit
  })
  },                   orderdtget: function() {  //ฟังก์ชั่น
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
 
     },
editblock(){
    if(this.showedit===2){
this.showedit =1
 this.showproductsinoreder();
    this.texteditbutton=this.langtranslate.View+" "+this.orderdtall.doctypename
    }else{
  this.showedit =2     
   this.texteditbutton=this.langtranslate.edit

    }
},   loadorderdt: function() {  //ฟังก์ชั่น
  axios.get(this.orderurl+'?include=1')
  .then((response)=>{
              this.orderview=response.data; 
 })
 
     }

     ,showproductsinoreder(){
  axios.get(this.baseurl+'/api/showproductinorder/'+this.orderid)
  .then((response)=>{
  this.productlistinorder=response.data; 
   
 })
 }
  ,checkstockpdcode: function(pdcode) {  //ฟังก์ชั่น
  axios.get(this.baseurl+'/api/checkstock/'+pdcode)
  .then((response)=>{
    this.stocklist[pdcode]=response.data.stocklist;  
 })
 }
,editqtyorder(index){

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
    price:this.productshow.orderprice ,
     memonumber:this.productprice.memonumber,
    once_time:this.productprice.once_time,
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
 this.showproductsinoreder();
            this.loadorderdt();

 })


/////////





   
}
     }

        ,
     showProductinorderdt(index){
this.productshow = this.productlistinorder[index]

this.productshow['name']  =this.productlistinorder[index].name;
this.productshow['code'] = this.productlistinorder[index].productscode;
this.productshow['category_code']=this.productlistinorder[index].category_code;
this.productshow['product_details']=this.productlistinorder[index].product_details;
this.productshow['id']=this.productlistinorder[index].pdid;
this.productshow['price']=this.productlistinorder[index].orderprice;
let productname = this.productlistinorder[index].name;

this.checkstock();
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

},
     checkstock: function() {  //ฟังก์ชั่น

  axios.get(this.baseurl+'/api/checkstock/'+this.productshow['code'])
  .then((response)=>{
    this.stocklist=response.data.stocklist; 

     
 })
//this.checkthisprice(); 
 
 },checkthisprice(){
         axios.post(this.baseurl+'/api/order_checkprice',{
productcode : this.productshow.code,
cuscode : this.customercode,
typeprice : this.orderdtall.customer.price_group,

         }).then((response)=>{ 

this.productprice = response.data
let plen = this.productlistpriceobj.length;  
let pricepdindex = this.productlistpriceobj.findIndex(p=>p.productcode == this.productshow.code)
if(pricepdindex!='-1'){
plen = pricepdindex
}
       
this.productlistpriceobj[plen]= response.data
let pdinorderindex = this.productlistinorder.findIndex(po=>po.productscode == this.productshow.code)
if(pdinorderindex!='-1'){

this.productlistinorder[pdinorderindex].price=response.data.priceorder

}

         });
     }
,async addproductpricecode(pdcode,idexorder)   {

  let pdpriceindex = await this.productlistpriceobj.findIndex(p=>p.productcode == pdcode)
  let oderindex = await this.productlistinorder.findIndex(op=>op.productscode == pdcode)

  if(pdpriceindex=="-1"){

          axios.post(this.baseurl+'/api/order_checkprice',{
productcode : pdcode,
cuscode : this.customercode,
typeprice : this.orderdtall.customer.price_group,

         }).then((response)=>{ 
          
this.productlistpriceobj.push(response.data);
if(oderindex!="-1"){
this.productlistinorder[oderindex].price =  response.data.priceorder;
this.productlistinorder[oderindex].amountrow = (+response.data.priceorder)*(+this.productlistinorder[oderindex].orderqty);
 //this.ordertotalamount = +this.ordertotalamount +(+this.productlistinorder[oderindex].amountrow);
}

         })

        
  }else{
if(oderindex!="-1"){
this.productlistinorder[oderindex].price =  response.data.priceorder;
this.productlistinorder[oderindex].amountrow = (+response.data.priceorder)*(+this.productlistinorder[oderindex].orderqty);
// this.ordertotalamount = +this.ordertotalamount +(+this.productlistinorder[oderindex].amountrow);
}

  }

     }
,ordertotalamountget(){
    axios.get(this.baseurl+'/api/showordertotalamount/'+this.orderid)
  .then((response)=>{
      this.ordertotalamount=response.data[0].totalamount
                        
 })
     }
     ,async showproductsinoreder(){
  
  axios.get(this.baseurl+'/api/showproductinorder/'+this.orderid)
  .then((response)=>{
  this.productlistinorder=response.data; 
  })

this.ordertotalamountget();
 
 }
      ,async showcancelproducts(){
  
  axios.get(this.baseurl+'/api/showproductcancel/'+this.orderid)
  .then((response)=>{
  this.cancelproducts=response.data; 
  })

this.ordertotalamountget();
 
 }

,canclepd(index){
  this.showProductinorderdt(index)
   Vue.swal({
  title: 'ยืนยันการยกเลิกสินค้า?',
  text: "คุณต้องการยกเลิกสินค้า "+this.productlistinorder[index].productscode+" ออกจากรายการ"+this.doctypename+"นี้ใช่หรือไม่",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ใช่ ยกเลิกได้เลย',
  cancelButtonText: 'ไม่ต้องการยกเลิก'
}).then((result) => {
  if (result.value) {
//<--------------

axios.post(this.baseurl+'/api/cancleproducttoorder',{
    productid : this.productlistinorder[index].pdid,
    orderid :this.orderid,
    orderproductid : this.productlistinorder[index].pdorderid,  
    addqty : 0, 
    diffqty :'-'+this.productlistinorder[index].orderqty,  
    productscode : this.productlistinorder[index].productscode,
    doctype : this.orderdt.doctype,
    orderdetails : this.orderdt,
    userfullname:this.userfullname,
    userid:this.userid,
  })
 .then((response)=>{
  this.alertstatus=response.data.alertstatus; 
  this.productlistinorder=response.data.productlistinorder; 
 this.showproductsinoreder();
this.checkstock();
  Vue.swal({
  icon: response.data.alertstatus.icon,
  title: response.data.title,
  text: response.data.alertstatus.text,
  toast: true,
  timer: 2000,
  timerProgressBar: true,
 
  
});





 })

//-------------->
    
  }
})

 }
,readdcanclepd(index){
 
   Vue.swal({
  title: 'ยืนยันเพิ่มสินค้าที่ถูกยกเลิก?',
  text: "คุณต้องการเพิ่มสินค้าที่ถูกยกเลิก "+this.cancelproducts[index].productscode+" เข้าสู่รายการ"+this.doctypename+"นี้ใช่หรือไม่",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ใช่ เพิ่มได้เลย',
  cancelButtonText: 'ไม่ต้องการเพิ่ม'
}).then((result) => {
  if (result.value) {
//<--------------

axios.post(this.baseurl+'/api/readdcancleproducttoorder',{
    productid : this.cancelproducts[index].pdid,
    orderid :this.orderid,
    orderproductid : this.cancelproducts[index].pdorderid,  
    addqty : 0, 
    diffqty :this.cancelproducts[index].orderqty,  
    productscode : this.cancelproducts[index].productscode,
    doctype : this.orderdt.doctype,
    orderdetails : this.orderdt,
    userfullname:this.userfullname,
    userid:this.userid,
  })
 .then((response)=>{
  this.alertstatus=response.data.alertstatus; 
  this.productlistinorder=response.data.productlistinorder; 
 this.showproductsinoreder();
this.showcancelproducts();
this.checkstock();
  Vue.swal({
  icon: response.data.alertstatus.icon,
  title: response.data.title,
  text: response.data.alertstatus.text,
  toast: true,
  timer: 2000,
  timerProgressBar: true,
 
  
});





 })

//-------------->
    
  }
})

 }


  }, watch: {

editqtynew: function() {
let index =  this.editqtyorderdetail.indexorder
let oldqty =  this.productlistinorder[index].orderqty
this.newtracking_qty=this.editqtynew -oldqty
} ,productlistinorder: function(){

    let sum = 0;
      for(let i = 0; i < this.productlistinorder.length; i++){
        sum += (parseFloat(this.productlistinorder[i].orderqty));
      }
//console.log(sum);
     this.totalorderqty = sum;
 
     },productshow : function() {
this.checkstock();
this.diffstockadd = '';
     }
  }
    }
</script>

<template>

<div>
<button v-if=" (role_id==6) " @click="editblock" class="btn btn-warning  mb-1" >{{ texteditbutton }}</button>


<div  v-if="showedit===1" >
<div v-if="(orderdtall.orderdt.order_status=='13' || orderdtall.orderdt.order_status=='23') && (role_id==6) " class="row">

  <div class="col-md-7">
<h3>Order List</h3>
<div class="table-responsive">
 <table   id="orderlist" class="table table-bordered">

<thead><tr>
<th>ที่</th>
<th>{{ langtranslate.Image }}</th>
<th>รายละเอียดสินค้า</th>
<th>Stock</th>
<th>ราคา</th>
<th>จำนวน</th>
<th>รวม</th>
<th>ทำ SO.แล้ว</th>
<th>ทำ SO.</th>
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
 <td class=" text-center">

 
<order-product-stock @eventsendstockvalue="addstockdata" :indexparent="index" :sosumstock="1" :baseurl="baseurl" :productcode="productorder.productscode" :orderqty="productorder.orderqty" :canclepd="productorder.canclepd"  ></order-product-stock>

   </td>
<td   class="text-right">{{productorder.orderprice| numeral('0,0.00') }} </td>
<td   class="text-right">{{productorder.orderqty | numeral('0,0') }}

<!-- <i style="font-size:90%" data-toggle="modal" data-target="#editqty" class="fas fa-pencil-alt" @click="editqtyorder(index)"></i> -->

       </td>
<td   class="text-right">{{productorder.amount| numeral('0,0.00') }} </td>
<td   class="text-right">{{productorder.qtyso | numeral('0,0') }}</td>

<td>
  <div v-if="addqtysso[index]>0">
<input v-model="addqtysso[index]" style="width:80px"  :min="0" :max="addqtyssomax[index]" class="text-right" type="number">
<br>
<input type="checkbox"   v-model="addqtyssocheck[index]"> เพิ่มใน SO.
<br>
  </div>
  <div v-else>
  ทำ SO ครบแล้ว
</div>
</td>


     </tr>
     <tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td class="text-right"><strong>รวม</strong></td>
<td class="text-right">{{ totalorderqty | numeral('0,0')  }}</td>
<td class="text-right">{{ ordertotalamount | numeral('0,0.00')  }}</td>
<td class="text-right">{{ totalorderqtysonow }}</td>
<td class="text-right">{{ totalorderqtyso }}</td>
     </tr>
   </tbody>
</table>

</div>


</div>
  <div class="col-md-5">
  
 <div class="row">
      <div class="col-md-12"><h2>รายการ SO.</h2></div> 
   <div v-if="soinorder.sofullname" class="col-md-6 mb-1 text-center" v-for="(soinorder,index) in soinorderlist" >
<button  class="btn btn-info"> {{soinorder.sofullname }}</button>   
    </div>
   </div>
<div v-if="totalorderqtyso>0">
<h3>Add to Sale Order</h3>
<div class="table-responsive">
<table   id="solist" class="table table-bordered">

<thead><tr>
<th>ที่</th>

<th>รายละเอียดสินค้า</th>

<th>ราคา</th>
<th>จำนวน</th>
<th>ส่วนลด</th>
<th>รวม</th>
</tr></thead>

   <tbody>
     <tr v-if="addqtysso[index]>0 && addqtyssocheck[index]==true" v-for="(productorder,index) in productlistinorder" >
       <td>{{sorownumber[index]}}


       </td>

       <td @click="showProductinorderdt(index)">   <strong >{{productorder.productscode}}</strong>
         <br>
         {{productorder.name}}
       </td>

<td   class="text-right">{{productorder.orderprice| numeral('0,0.00') }} </td>
<td   class="text-right">{{addqtysso[index] }}       </td>
<td   class="text-right">  <input v-model="sorowdiscount[index]" style="width:80px" min="0" value="0"   class="text-right" type="number">     </td>
<td   class="text-right">{{addqtysoamount[index]| numeral('0,0.00') }} </td>




     </tr>
     <tr>
<td></td>
<td></td>
<td class="text-right"><strong>รวม</strong></td>
<td class="text-right">{{ totalorderqtyso }}</td>
<td class="text-right">{{ totalorderqtyso }}</td>
<td class="text-right">{{ totalsoamount | numeral('0,0.00')  }}</td>


     </tr>
   </tbody>
</table>
<div class="row">
<div class="col-md-4">{{ langtranslate.Discount }}</div>
<div class="col-md-3"><input v-model="sodiscount" style="width:80px" min="0"  max="100"   class="text-right" type="number"> % </div>
<div class="col-md-5 text-right">{{ sodiscountvalue | numeral('0,0.00')  }}</div>

</div>
<div class="row">
<div class="col-md-7">{{ langtranslate.Total_amount_after_discount }}</div>
<div class="col-md-5 text-right">{{ soamount_after_discount | numeral('0,0.00')  }}</div>

</div>

<div class="row">
<div class="col-md-7">{{ langtranslate.Vat_7 }}</div>
<div class="col-md-5 text-right">{{ sovat7 | numeral('0,0.00')  }}</div>

</div>

<div class="row">
<div class="col-md-7">{{ langtranslate.Total_amount }}</div>
<div class="col-md-5 text-right">{{ sototal_amount | numeral('0,0.00')  }}</div>

</div>





<strong>{{ langtranslate.Remark }}</strong>
<textarea class="form-control"  v-model="so_remark"></textarea>
<div class="text-center pb-2 pt-1">
<button @click="addcreate" class="btn btn-warning">{{ langtranslate.Createso }}</button>

</div>
  </div>
  </div>
  </div>
</div>

<div v-else class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                  <p class="text-center">
{{ langtranslate.Receive_Order_First }}

                  </p>
         
                </div>
                </div>
<div  id="orderdt" v-show="showedit===2" v-html="orderview"></div>


<!-- Modal -->
 <!-- <div class="modal fade" id="editqty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div> -->




</div>
</template>

<script>
import Vue from 'vue';
import Buefy from 'buefy'
Vue.use(Buefy)
import VueSweetalert2 from 'vue-sweetalert2';
    export default {
                  props: ['orderurl','orderid','baseurl','userid','userfullname','role_id'],
        mounted() {
this.loadorderdt();
this.orderdtget();
this.addproductpricecode();
this.langget();
this.checksonumber();

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
 stockforsso:[],
 addqtysso:[],
 addqtysoamount:[],
 totalorderqty:0,
 addqtyssomax:[],
 addqtyssocheck:[],
 totalorderqtyso:0,
 totalorderqtysonow:0,
 totalsoamount:0,
 sorownumber:[],
 sorowdiscount:[],
 sodiscount:0,
 sodiscountvalue:0,
 soamount_after_discount :0,
 sovat7 :0,
 sototal_amount:0,
 so_remark:'',
 so_listadd:[],
 soinorderlist:[],
 }
  },
           methods: {
 checksonumber: function() {  //ฟังก์ชั่น
  axios.get(this.baseurl+'/api/checksoinorder/'+this.orderid)
  .then((response)=>{
    this.soinorderlist=response.data;  
 })
 }
 , addstockdata(value) {
      //   console.log(value.rowindex)
      //  console.log(value.ssostock)
       this.productlistinorder[value.rowindex].ssostock = value.ssostock
      },
                      langget: function() {  //ฟังก์ชั่น
  axios.get(this.baseurl+'/api/LanguageTraslate')
  .then((response)=>{
this.langtranslate = response.data ;
 this.texteditbutton=this.langtranslate.Create_So
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
   this.texteditbutton=this.langtranslate.Create_So

    }
},   loadorderdt: function() {  //ฟังก์ชั่น
  axios.get(this.orderurl+'?include=1')
  .then((response)=>{
              this.orderview=response.data; 
 })
 
     }

//      ,showproductsinoreder(){
//   axios.get(this.baseurl+'/api/showproductinorder/'+this.orderid)
//   .then((response)=>{
//   this.productlistinorder=response.data; 

//   let len =response.data.length();
//   console.log(response.data);
//   for(let i=0;i<len;i++){
// console.log(this.productlistinorder[i]);
//   }
   
//  })
//  }
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
// ,editqtysumit(){

//   if(this.newtracking_qty===0){
//       Vue.swal({
//   icon: "error",
//   title: "ไม่มีการเปลี่ยนแปลง",
//   text: "กรูณาเปลี่ยนจำนวนก่อนการบันทึก",
//   toast: true,
//   timer: 2000,
//   timerProgressBar: true,
  
// });
//   }else{

// ///////แก้ไขจำนวน


//   axios.post(this.baseurl+'/api/editqtyproducttoorder',{
//     orderproductid : this.editqtyorderdetail.pdorderid,
//     productid : this.editqtyorderdetail.pdid,
//     orderid :this.orderid,
//     addqty :this.editqtynew,
//     diffqty :this.newtracking_qty,
//     productscode : this.editqtyorderdetail.productscode,
//     doctype : this.orderdt.doctype,
//     orderdetails : this.orderdt,
//     stocknow:this.editqtyorderdetail.stocknow,
//     userfullname:this.userfullname,
//     userid:this.userid,
//     price:this.productshow.orderprice ,
//      memonumber:this.productprice.memonumber,
//     once_time:this.productprice.once_time,
//   }
//   )
//   .then((response)=>{
//   this.alertstatus=response.data.alertstatus; 
//   this.productlistinorder=response.data.productlistinorder; 

 
//   Vue.swal({
//   icon: response.data.alertstatus.icon,
//   title: response.data.title,
//   text: response.data.alertstatus.text,
//   toast: true,
//   timer: 2000,
//   timerProgressBar: true,

// });

//   $('#editqty').modal('hide')
// this.checkstock();   
//  this.showproductsinoreder();
//             this.loadorderdt();

//  })


// /////////





   
// }
//      }

//         
  ,   showProductinorderdt(index){
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
// changrelatekey(productname){
// this.relatekey1 = productname.substring (0,7); //lo w
// this.relatekey1arr = this.relatekey1.split(" ");
// this.relatekey = this.relatekey1arr[0]
// this.relatekey2arr = productname.split("สี");
// if(this.relatekey2arr[1]!==null){
//   this.relatekey2 =  this.relatekey2arr[1].substring (0,5).split(" ");
// this.relatekey =this.relatekey+' '+this.relatekey2[0]
// }

// },
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
 
 },calqtysso : function() {
let sumqtyso=0
let totalsoamountcal=0
let number=1
  for(let i = 0; i < this.productlistinorder.length; i++){
if(!this.sorowdiscount[i]){
this.sorowdiscount[i]=0
}
  this.addqtysoamount[i]=(parseFloat(this.addqtysso[i])*parseFloat(this.productlistinorder[i].orderprice)) - parseFloat(this.sorowdiscount[i])
if(this.addqtyssocheck[i]==true){
sumqtyso+= (parseFloat(this.addqtysso[i]));
totalsoamountcal+= this.addqtysoamount[i];

this.sorownumber[i]=number;


this.so_listadd[number-1] = {}
this.so_listadd[number-1].pdorderid = this.productlistinorder[i].pdorderid
this.so_listadd[number-1].productcode = this.productlistinorder[i].productscode
this.so_listadd[number-1].productname = this.productlistinorder[i].product_details
this.so_listadd[number-1].productid= this.productlistinorder[i].pdid
this.so_listadd[number-1].price= this.productlistinorder[i].orderprice
this.so_listadd[number-1].qty = this.addqtysso[i]
this.so_listadd[number-1].rowdiscount = this.sorowdiscount[i]
this.so_listadd[number-1].rowamount = this.addqtysoamount[i]


number=number+1;
}else{
   this.sorownumber[i]=0;
}

 }
 this.totalorderqtyso= sumqtyso
  this.totalsoamount=totalsoamountcal
  this.sodiscountvalue = ((+this.sodiscount)/100)*(+this.totalsoamount)
  this.soamount_after_discount = (+this.totalsoamount)-(+this.sodiscountvalue)
  this.sovat7 =(7/100)*(+this.soamount_after_discount)
  this.sototal_amount = (+this.soamount_after_discount)+(+this.sovat7)
     }

,addcreate(){

  Vue.swal({
  title: 'ยืนยันการจัดทำ SO.',
  text: "กรุณาตรวจสอบข้อมูลให้ถูกต้องก่อนทำรายการ",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ยืนยัน',
  cancelButtonText: 'ยกเลิก'
}).then((result) => {
  if (result.value) {


axios.post(this.baseurl+'/api/createso',{
order_id:this.orderid,
ordertype:this.orderdtall.orderdt.ordertype,
ordernumberfull:this.orderdtall.orderdt.ordernumberfull,
bookingnumber:this.orderdtall.orderdt.bookingnumber,
customer_id:this.orderdtall.customer.id,
customer_code:this.orderdtall.customer.customercode,
customer_name:this.orderdtall.customer.name,
customer_adress:this.orderdtall.customer.address,
customer_tel:this.orderdtall.customer.phone_number,
customer_fax:'',
order_date:this.orderdtall.orderdt.created_at,
order_deliverydate:this.orderdtall.orderdt.deliverydate,
credit_day:'',
credit_condition:'',
so_amount:this.totalsoamount,
so_disper:this.sodiscount,
so_discount:this.sodiscountvalue,
so_amountafterdis:this.soamount_after_discount,
so_vat7:this.sovat7,
so_toatalamount:this.sototal_amount,
so_remark:this.so_remark,
so_listadd:this.so_listadd,
userid : this.userid,
userfullname : this.userfullname,

  })
 .then((response)=>{
   this.showproductsinoreder();
this.checksonumber();

  this.alertstatus=response.data.alertstatus; 

  Vue.swal({
  icon: response.data.alertstatus.icon,
  title: response.data.title,
  text: response.data.alertstatus.text,
  toast: true,
  timer: 2000,
  timerProgressBar: true,
});

});
}
});


}

  }, watch: {

// editqtynew: function() {
// let index =  this.editqtyorderdetail.indexorder
// let oldqty =  this.productlistinorder[index].orderqty
// this.newtracking_qty=this.editqtynew -oldqty
// } ,
productlistinorder: function(){

    let sum = 0;
    let sumqtysonow = 0;
      for(let i = 0; i < this.productlistinorder.length; i++){


        sum += (parseFloat(this.productlistinorder[i].orderqty));
        sumqtysonow += (parseFloat(this.productlistinorder[i].qtyso));
    
  this.addqtysso[i] =  (parseFloat(this.productlistinorder[i].orderqty))-(parseFloat(this.productlistinorder[i].qtyso));
  this.addqtyssomax[i] =(parseFloat(this.productlistinorder[i].orderqty))-(parseFloat(this.productlistinorder[i].qtyso));
  this.addqtyssocheck[i]=true;
if(this.productlistinorder[i].ssostock){
  if(this.productlistinorder[i].ssostock<0){
  this.addqtysso[i] = 0;
  this.addqtyssomax[i] =0;

  }else if(this.productlistinorder[i].ssostock<this.addqtysso[i]){
this.addqtysso[i] = this.productlistinorder[i].ssostock;
this.addqtyssomax[i] =this.productlistinorder[i].ssostock;


  }

}

if(!this.sorowdiscount[i]){
this.sorowdiscount[i] =0
}
  

      }
//console.log(sum);
     this.totalorderqty = sum;
     this.totalorderqtysonow = sumqtysonow;
 this.calqtysso();
 
     },addqtysso : function() {
this.calqtysso();
  },addqtyssocheck: function() {
this.calqtysso();
  }
  ,sorowdiscount: function() {
this.calqtysso();
  }
  ,sodiscount: function() {

this.calqtysso();
  }
  }
    }
</script>

<template>

<div>

<button @click="editblock" class="btn btn-warning btn-lg mb-1" >{{ texteditbutton }}</button>
 <!-- <div v-if="showedit===2" class="table-responsive" id="orderdt"></div> -->


 <table  v-if="showedit===1"  id="orderlist" class="table table-bordered">
<thead><tr>
<th>ที่</th>
<th>Image</th>
<th>รายละเอียดสินค้า</th>
<th>STOCK</th>
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
       <td>{{ stocklist[productorder.code] }}</td>
       <td   class="text-right">{{productorder.orderqty | numeral('0,0') }}

<i style="font-size:90%" data-toggle="modal" data-target="#editqty" class="fas fa-pencil-alt" @click="editqtyorder(index)"></i>

       </td>
    
<td @mouseover="showProductinorderdt(index)" ><i  class="fas fa-backspace  text-danger" @click="removepd(index)"></i></td>


     </tr>
     <tr>
<td></td>
<td></td>
<td></td>
<td class="text-right"><strong>รวม</strong></td>
<td class="text-right">{{ totalorderqty | numeral('0,0')  }}</td>
<td></td>
     </tr>
   </tbody>
</table>



<div  id="orderdt" v-show="showedit===2" v-html="orderview"></div>



</div>
</template>

<script>
    export default {
                  props: ['orderurl','orderid','baseurl'],
        mounted() {
            this.loadorderdt()
      
        },
      
    data(){
    return{
  showedit :2,
 orderview:null,
 productlistinorder:[],
 texteditbutton:'Edit',
 stocklist:[]
 }
  },
           methods: {
editblock(){
    if(this.showedit===2){
this.showedit =1
 this.showproductsinoreder();
    this.texteditbutton='View'
    }else{
  this.showedit =2     
   this.texteditbutton='Edit'

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
//  },watch: {
//      productlistinorder :function() { 
// foreach(this.productlistinorder as productlist){
// console.log(productlist);
// }
//      }

  }
    }
</script>

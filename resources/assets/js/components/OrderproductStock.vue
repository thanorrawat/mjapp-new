<template>
    <div >

<div v-if="sosumstock==1"  @mouseover="toggleInfo1" @mouseleave="toggleInfo2" >
{{ stockforsso }}
  
        <table class="tablehover" v-if="displayInfo">
            <thead><th>Stock</th>
            <th>ราคาล่าสุด</th>
            </thead>
            <tr>
                <td>  เพื่อขาย = {{ stocklist.sumstock1 }} <br> Order = {{ stocklist.sumstock2 }}<br> จอง = {{ stocklist.sumstock3 }}</td>
                <td>

<div v-if="lastpricedata.pricetop1">{{ lastpricedata.pricetop1 }}</div>
<div v-if="lastpricedata.pricetop2">{{ lastpricedata.pricetop2 }}</div>
<div v-if="lastpricedata.pricetop3">{{ lastpricedata.pricetop3 }}</div>


                </td>
            </tr>
        </table>

</div>

<div v-else class=" text-left">
        <table >
            <thead><th>Stock</th>
            <th>ราคาล่าสุด</th>
            </thead>
            <tr>
                <td>  เพื่อขาย = {{ stocklist.sumstock1 }} <br> Order = {{ stocklist.sumstock2 }}<br> จอง = {{ stocklist.sumstock3 }}</td>
                <td>

<div v-if="lastpricedata.pricetop1">{{ lastpricedata.pricetop1 }}</div>
<div v-if="lastpricedata.pricetop2">{{ lastpricedata.pricetop2 }}</div>
<div v-if="lastpricedata.pricetop3">{{ lastpricedata.pricetop3 }}</div>


                </td>
            </tr>
        </table>

</div>
        
  


    </div>
</template>

<script>

    export default {
          props: ['baseurl','productcode','orderqty','canclepd','sosumstock','indexparent'],
        mounted() {
this.checkstock();
this.lastprice();

        }
 ,data(){
    return{
 stocklist:[],
 lastpricedata:[], 
 displayInfo: false,
 stockforsso:0,
    }}
,methods: {

   
checkstock: function() {  //ฟังก์ชั่น
  axios.get(this.baseurl+'/api/checkstock/'+this.productcode)
  .then((response)=>{
this.stocklist=response.data.stocklist; 
this.stockforsso=(+response.data.stocklist.sumstock1)+(+response.data.stocklist.sumstock2); 

this.$emit('eventsendstockvalue', {
  rowindex: this.indexparent,
  ssostock: this.stockforsso
})

})

},
lastprice: function() {  //ฟังก์ชั่น
  axios.get(this.baseurl+'/api/checklastprice/'+this.productcode)
  .then((response)=>{
this.lastpricedata=response.data; 
})

},
   toggleInfo1 () {
       this.displayInfo = true
      }
      ,  toggleInfo2 () {
       this.displayInfo = false
      }
}
,watch:{
    orderqty(){
   this.checkstock();     
    },
       canclepd(){
   this.checkstock();     
    }
}

    }
</script>
<style>
.tablehover{
position: absolute;
width: 200px!important;
padding: 10px;
background:rgba(251, 252, 199, 0.9);
border: solid 1px #333;
border-radius: 5px;
font-size: 80%;

}
</style>

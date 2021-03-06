>
<template>
        <div>

            <div v-show="showpayment" class="ordine">
                <ul  v-for="dish in dishes" :key="dish.message">

                        <img :src="dish.img" alt="" height="100">
                        <li>
                            [{{dish.id}}]
                        </li>
                        <li>
                            {{dish.name}}
                        </li>
                        <li>
                            {{dish.price}}
                        </li>
                        <li>
                            {{dish.availability}}
                        </li>

                        <button @click="AddPrice(dish.price,dish.name,dish.id)">+</button>
                </ul>

                <div class="cart" v-show="dishesOrdered.length>0">
                    <h1>Sono il tuo carrello</h1>
                    <ul v-for='(dishOrdered,i) in dishesOrdered' :key='dishOrdered.message'>
                        <li>
                            {{i}}
                        </li>
                        <li>
                            {{dishOrdered.id}}
                        </li>
                        <li>
                            {{dishOrdered.name}}
                        </li>
                        <li>
                            {{dishOrdered.price}}
                        </li>
                        <li>
                            <button  v-if='totPrice>0' @click='DeletePrice(dishOrdered.price,i)'>-</button>

                        </li>
                    </ul>
                    <h2>
                        prezzo totale :{{totPrice}}
                    </h2>
                    <button @click="GoToCheckout(totPrice)">
                        Checkout
                    </button>

                </div>

            </div>

            <div v-show="!showpayment" class="pagamento">
                <h1>sono il pagamento</h1>
            </div>



        </div>


</template>


<script>

export default {

    data() {
        return {
            count:0,
            dishes:[],
            dishesOrdered:[],
            totPrice:0,

            showpayment:true,
        }
    },

    mounted(){

        axios.get('/dishes/'+ this.id)
            .then(res=>{
                this.dishes=res.data
            })
    },

    methods:{

        DeletePrice(price,i){
            if(this.totPrice-price>=0){
                console.log(i);
                this.totPrice-=price;
                this.dishesOrdered.splice(i,1);
            }
            console.log('prezzo totale',this.totPrice);
        },

        AddPrice(price,name,id){

            console.log(name);
            this.totPrice += price;
            this.dishesOrdered.push({
                name:name,
                price:price
            })
            console.log(this.dishesOrdered);
            console.log('prezzo totale',this.totPrice);
        },

        GoToCheckout(){

            this.showpayment=false;
            // const data=this.dishesOrdered

            // let formdata = new FormData();
            // formdata.append('data',JSON.stringify(data));

            //  axios.post('/checkout',formdata)
            //     .then(res=>{
            //         // location.replace('/checkout')
            //         console.log(res);
            //         //  console.log(res);
            //      })
        }
    },


    props:{
        id:Number,
    }
}
</script>


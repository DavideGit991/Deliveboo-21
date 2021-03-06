>
<template>
        <div>
            <ul v-if="availability=1">


                    <img :src="img" alt="" height="100">
                    <li>
                        {{id}}
                    </li>
                    <li>
                        {{name}}
                    </li>
                    <li>
                        {{price}}
                    </li>
                    <li>
                        {{availability}}
                    </li>

                    <div>{{count}}</div>
                    <button @click="count++">+</button>
                    <button v-if="count>0" @click='count--'>-</button>
                    <button v-if="count>0" @click='addCart(id,count,price,name)' :value="id">Add</button>
            </ul>




         <cart-component :selectedOption="selectedOption">

        </cart-component>
        </div>


</template>


<script>

export default {
    components:{
        'cart-component':require('./CartComponent.vue'),
    },



    data() {
        return {
            count:0,

          selectedOption: 'ciao'


        }
    },

    methods:{
        addCart(id,count,price,name){

            let totPrice=count*price;

            console.log(totPrice);

        }
    },

    props:{

        availability:Number,
        img:String,
        id:Number,
        name:String,
        price:Number,
    }
}
</script>


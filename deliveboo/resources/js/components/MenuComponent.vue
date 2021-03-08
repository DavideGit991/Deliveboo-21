
<template>
    <div id="menu">

        <!-- piatti per ristorante selezionato -->
        <div class="ordine">

            <div v-show="showpayment" >
                <div id="dish-card-container">
                    <ul class="dish-card" v-for="dish in dishes" :key="dish.message">
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
                </div>
            </div>

            <!-- Carrello -->
            <div v-show="dishesOrdered.length>0"  id="cart-container">
                <div>
                    <h3>
                        Carrello
                    </h3>
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="cart">
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
                            <button  v-show='deleteDish' v-if='totPrice>0' @click='DeletePrice(dishOrdered.price,i)'>-</button>
                        </li>

                    </ul>
                </div>

                <div>
                    <h2>
                        Totale: {{totPrice}}&#8364;
                    </h2>
                    <button @click="GoToCheckout(totPrice)" v-show="dishesOrdered.length>0 && checkout">
                        Checkout
                    </button>
                    <i class="fas fa-arrow-left" v-show="showdishes" @click='goBack()'> </i>
                </div>
            </div>
        </div>

        <!-- pagamento -->
        <div v-show="!showpayment" class="pagamento">
            <h1>sono il pagamento</h1>

            <div class="carta di credito">

            <!-- Sezione pagamento -->
                <div id="dropin-container"></div>
     </div>

           <!-- sezione form-->
            <form @submit.prevent="submit" v-show="!showform">
                <div>

                    <label for="name">Nome:</label>
                    <input type="text" name="name" required v-model="name">
                </div>
                <div>

                    <label for="lastname">Cognome</label>
                    <input type="text" name="lastname" required v-model="lastname">
                </div>
                <div>

                    <label for="address">Indirizzo</label>
                    <input type="text" name="address" required v-model="address">
                </div>
                <div>

                    <label for="phone">N° telefono</label>
                    <input type="tel" name="phone" required v-model="phone" >
                </div>


                <button  id="submit-button" type="submit" disabled>Paga</button>

            </form>
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

            showform:false,
            checkout:true,
            deleteDish:true,
            showdishes:false,
            showpayment:true,

            name:'',
            lastname:'',
            address:'',
            phone:'',


        }
    },

    mounted(){

        axios.get('/dishes/'+ this.id)
            .then(res=>{
                this.dishes=res.data
            });

            var submitButton = document.querySelector('#submit-button');
            braintree.dropin.create({
                 authorization: 'sandbox_38hnk6mp_bwgnshmvsxrqb88w',
                 container: '#dropin-container',
             }, function (err, dropinInstance) {
                 if (err) {
                 // Handle any errors that might've occurred when creating Drop-in
                 console.error(err);
                 return;
                 }
                 submitButton.addEventListener('click', function () {
                 dropinInstance.requestPaymentMethod(function (err, payload) {
                     if (err) {
                     // Handle errors in requesting payment method
                     }
                     // Send payload.nonce to your server
                 });
                 });
             });
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
            this.deleteDish=false;
            this.showdishes=true
            this.showpayment=false;
            this.checkout=false;

        },
        goBack(){
            this.deleteDish=true;
            this.showdishes=false;
            this.showpayment=true;
            this.checkout=true;
        },


            submit() {
                this.errors = {};
                let data = new Date();
                let mese= data.getMonth() + 1 ;

                 const fields= {
                    tot_price: this.totPrice,
                    status:1,
                    name:this.name,
                    month:mese,
                    lastname:this.lastname,
                    address:this.address,
                    phone:this.phone,

            }
                    console.log(fields);
                   axios.post('/payment', fields).then(response => {



                   })

                      .catch(error => {
                     if (error.response.status === 422) {
                       this.errors = error.response.data.errors || {};
                  }
           });
        }

    },


    props:{
        id:Number,
    }
}
</script>

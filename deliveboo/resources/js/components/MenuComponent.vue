
<template>
    <div id="menu">

        <div v-show="showpage">

            <!-- piatti per ristorante selezionato -->
            <div class="ordine">

                <div v-show="showpayment" >
                    <h2 class="title">Menu Ristorante</h2>
                    <div id="dish-card-container">
                        <div class="dish-card" v-for="dish in dishes" :key="dish.message">
                            <div class="img-container">
                                <img :src="dish.img" alt="" >
                            </div>

                            <h4>
                                {{dish.name}}
                            </h4>
                            <p>
                                {{dish.price}} &euro;
                            </p>

                            <div v-if="dish.availability== 1">
                                <i class="fas fa-plus-circle" @click="AddPrice(dish.price,dish.name,dish.id)"></i>
                            </div>

                            <div v-if="dish.availability== 0">
                                 <p>Non Disponibile.</p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Carrello -->
                <div>
                    <div id="cart-container">
                        <div class="cart-header">
                            <h3>
                                Carrello
                            </h3>
                            <i class="fas fa-shopping-cart"></i>
                            <span v-show="dishesOrdered.length==0"> 0</span>
                            
                        </div>
                        <div class="cart" v-show="dishesOrdered.length>0">
                            <div>
                                <div class="cart-element" v-for='(dishOrdered,i) in dishesOrdered' :key='dishOrdered.message'>
                                    <div>
                                        <span>
                                            {{i + 1}}. {{dishOrdered.name}}
                                        </span>  
                                        <p>
                                            {{dishOrdered.price}}&euro;
                                        </p>
                                    </div>
                                    <div>
                                        <i class="fas fa-minus-circle" v-show='deleteDish' v-if='totPrice>0' @click='DeletePrice(dishOrdered.price,i)'></i>
                                    </div>
                                </div>
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
                </div>

                <!-- pagamento -->
                <div v-show="!showpayment" class="pagamento">

                    <div class="carta-di-credito" >

                    <!-- Sezione pagamento -->
                    <div id="dropin-container"></div>
                        <button  id="submit-button" >Avanti</button>
                    </div>

                    <!-- sezione form-->
                    <form id='form' hidden @submit.prevent="submit">
                        <h2>Inserisci i tuoi dati</h2>
                        <div class="form-container">
                            <div>
                                <label for="name">Nome:</label>
                                <input type="text" name="name" required v-model="name">
                            </div>
                            <div>
                                <label for="lastname">Cognome:</label>
                                <input type="text" name="lastname" required v-model="lastname">
                            </div>
                            <div>
                                <label for="address">Indirizzo:</label>
                                <input type="text" name="address" required v-model="address">
                            </div>
                            <div>
                                <label for="phone">N° Telefono</label>
                                <input type="tel" name="phone" required v-model="phone" >
                            </div>
                        </div>

                        <button type="submit">Completa Pagamento</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- messaggio pagamento completato -->
        <div class="message" v-show="showmessage">
            <h1>
                grazie!! il tuo ordine e' in lavorazione
            </h1>
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
            showpage:true,
            showmessage:false,

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
             let form=document.getElementById('form');
             let button=document.getElementById('submit-button');

             braintree.dropin.create({

                  authorization: 'sandbox_38hnk6mp_bwgnshmvsxrqb88w',
                  container: '#dropin-container',
              },

              function (err, dropinInstance,) {
                button.style.visibility='visible';
                 submitButton.addEventListener('click', function () {
                 dropinInstance.requestPaymentMethod(function (err,) {
                      if (!err) {
                         form.removeAttribute('hidden');
                      }

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
            // console.log('prezzo totale',this.totPrice);
        },

        AddPrice(price,name,id){

            console.log(name);
            this.totPrice += price;
            this.dishesOrdered.push({
                name:name,
                price:price
            })
            // console.log(this.dishesOrdered);
            // console.log('prezzo totale',this.totPrice);
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

                   axios.post('/payment', fields)
                    .then(res => {
                       console.log(res);
                        this.showpage=false;
                        this.showmessage=true;
                        this.redirectTo();

                   })

                      .catch(error => {
                     if (error.response.status === 422) {
                       this.errors = error.response.data.errors || {};
                  }
           });
        },

        redirectTo() {
            setTimeout(function(){ location.replace("/") }, 2000);
        },

    },


    props:{
        id:Number,
    }
}
</script>

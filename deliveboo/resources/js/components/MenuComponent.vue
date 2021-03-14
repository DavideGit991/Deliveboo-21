
<template>
    <div id="menu">

        <div v-show="showpage">

            <!-- piatti per ristorante selezionato -->
            <div class="ordine">

                <div v-show="showpayment" >
                    <div class="title">
                        <h2>Menu Ristorante</h2>
                        <div class="line"></div>
                    </div>
                    <div id="dish-card-container" class="dish-card-container">
                        <div class="dish-card" v-for="dish in dishes" :key="dish.message">
                            <div class="img-container">
                                 <img v-if="dish.img == null" :src="'/img/food.jpg'"  alt="immagine piatto">
                                 <img v-else :src="'/storage/dish/' + dish.img" alt="immagine piatto">
                            </div>

                            <div class="food-body">
                                <div>
                                    <h3>
                                        {{dish.name}}
                                    </h3>
                                    <span>
                                        {{dish.price}} &euro;
                                    </span>
                                </div>

                                <div class="plus" v-if="dish.availability== 1">
                                    <i class="fas fa-plus-circle" @click="AddPrice(dish.price,dish.name,dish.id)"></i>
                                </div>
                                <div class="plus" v-if="dish.availability== 0">
                                    <p>Non Disponibile.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carrello -->
                <div>
                    <div class="cart-container">
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
                                    Totale: {{totPrice.toFixed(2)}}&#8364;
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
                    <form id='form' hidden @submit.prevent="submit" >
                        <div>
                            <h2>Inserisci i tuoi dati</h2>
                            <div class="form-container">
                                <div>
                                    <label for="name">Nome:</label> <br>
                                    <input type="text" name="name" v-model="name" required  minlength="2" maxlength="60">
                                </div>
                                <div>
                                    <label for="lastname">Cognome:</label> <br>
                                    <input type="text" name="lastname"  v-model="lastname" required  minlength="2" maxlength="60">
                                </div>
                                <div>
                                    <label for="address">Indirizzo:</label> <br>
                                    <input type="text" name="address"  v-model="address" required  minlength="5" maxlength="60">
                                </div>
                                <div>
                                    <label for="phone">N° Telefono</label> <br>
                                    <input type="tel" name="phone" v-model="phone" required  minlength="10" maxlength="15">
                                </div>
                                <div>
                                    <label for="mail">Email:</label> <br>
                                    <input type="tex" name="mail" v-model="mail" required>
                                </div>
                            </div>

                            <button type="submit">Completa Pagamento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- messaggio pagamento completato -->
        <div class="description-overlay" v-show="showmessage">
            <div class="card">

                    <h1>Grazie!</h1>
                    <h2>Il tuo ordine è in lavorazione <i class="fas fa-paper-plane"></i></h2>

            </div>
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
            iddishes:[],
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
            mail:'',

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
                // console.log(i);
                this.totPrice-= price;
                // this.totPrice.toFixed(1);
                this.dishesOrdered.splice(i,1);
                // this.iddishes.splice(id);
                Vue.delete(this.iddishes,i);
            }
            // console.log('prezzo totale',this.totPrice);
            // console.log('alla rimozione',this.iddishes);
        },

        AddPrice(price,name,id){

            // console.log(name);
            this.totPrice += price;
            // this.totPrice.toFixed(1);
            this.dishesOrdered.push({
                name:name,
                price:price
            });

            this.iddishes.push(id);
            // console.log(this.dishesOrdered);
            // console.log('prezzo totale',this.totPrice);
            // console.log('all aggiunta',this.iddishes);

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
                    tot_price: this.totPrice.toFixed(2),
                    status:1,
                    name:this.name,
                    month:mese,
                    lastname:this.lastname,
                    address:this.address,
                    phone:this.phone,
                    mail:this.mail,

                    id:this.iddishes
                }
                console.log(fields);


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

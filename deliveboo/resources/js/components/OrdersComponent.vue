<template>
    <div>
        <div class="card-header">
            Ordini
        </div>
        <div>
            <div class="resto-name">
                <button @click='getLastOrder()'>
                    Visualizza la tua comanda
                </button>
            </div>
            
            <div class="orders-container" v-show="dropdown">

                <!-- comanda ultimo ordine -->
                <div class="ultimoOrdine">
                    <div v-for="(item,i) in lastOrder " :key="item.message" ::key="i.message">
                        <div v-if="i<1">
                            <div class="utente">
                                <h4>Nome:</h4> {{item.uname}} {{item.lastname}}
                            </div>
                            <div class="utente">
                                <h4>Indirizzo:</h4> {{item.address}}
                            </div>
                            <div class="utente">
                                <h4>Telefono:</h4> {{item.phone}}
                            </div>
                        </div>
                    </div>
                        
                    <div class="ordine">
                        <h4>Ordine:</h4>
                        <ol>
                            <li v-for="(item,i) in lastOrder " :key="item.message" ::key="i.message">{{item.name}}</li>    
                        </ol>
                    </div>
                </div>

                <!-- ultimi 5-1 ordini -->
                
                <div class="ordini" v-for="(item,i) in ultimi5ordini " :key="item.message" ::key="i.message">
                    <div v-for="(item,a) in ultimi5ordini[i]" :key='item.message' ::key='a.message'> 
                        <div v-if="a<1">
                            <div class="utente">
                                <h4>Nome:</h4> {{item.uname}} {{item.lastname}}
                            </div>
                            <div class="utente">
                                <h4>Indirizzo:</h4> {{item.address}}
                            </div>
                            <div class="utente">
                                <h4>Telefono:</h4> {{item.phone}}
                            </div>
                        </div>
                    </div>
                          
                    <div class="ordine">
                        <h4>Ordine:</h4>
                        <ol>
                            <li v-for="(item,a) in ultimi5ordini[i]" :key='item.message' ::key='a.message'>{{item.name}}</li>    
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        id:Number,
    },

    data() {
        return {
            orders:[],
            lastOrder:[],

            dropdown:false,

            ultimi5ordini:[],


        }
    },

    mounted(){

        axios.get('orders/'+ this.id)
             .then(res=>{

                this.orders = res.data;
                // console.log(this.orders);

        });

    },
    methods:{
        getLastOrder(){


                this.dropdown=!this.dropdown;

                if (this.dropdown==true) {
                        // comanda ultimo ordine
                    let comanda=this.orders[0].ordine;

                    this.orders.forEach((element) => {

                        if (element.ordine==comanda) {
                            this.lastOrder.push(element);
                        }

                    });



                    //ultimi 5 ordini
                    let uOrdine=[];
                    let count=0;
                    this.orders.forEach((element,i) => {

                        if (!uOrdine.includes(element.ordine) && count<=4 ) {
                            count++;
                            uOrdine.push(element.ordine)

                        }

                    });


                    for (let index = 1; index < uOrdine.length; index++) {

                        let idOrdine=uOrdine[index];

                        let arr=[];

                        this.orders.forEach((element) => {
                            if (element.ordine==idOrdine) {
                                arr.push(element);
                            }

                        });

                        this.ultimi5ordini.push(arr);

                    }


                }else{
                    this.ultimi5ordini=[];
                    this.lastOrder=[];

                }

        }
    }



}
</script>

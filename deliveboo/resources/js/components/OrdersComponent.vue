<template>
    <div>
        <div class="card-header">
            Ordini
        </div>
        <div class="card-body">
            <div>

            </div>
            <button @click='getLastOrder()'>
                Visualizza la tua comanda
            </button>



            <!-- comanda ultimo ordine -->
            <div class="ultimoOrdine">
                <div v-for="(item,i) in lastOrder " :key="item.message" ::key="i.message">
                    <div class="cliente">

                        <div v-if="i<1">
                            {{item.uname}}

                            {{item.lastname}}
                            <br>
                            {{item.address}}
                            <br>
                            {{item.phone}}
                        </div>

                    </div>

                    <div class="ordine">

                        {{item.name}}

                    </div>


                </div>
            </div>
            <br><br>

            <!-- ultimi 5-1 ordini -->
            <div class="ordini">
                <div v-for="(item,i) in ultimi5ordini " :key="item.message" ::key="i.message">
                    <div v-for="(item,a) in ultimi5ordini[i]" :key='item.message' ::key='a.message'>

                        <div class="cliente" >

                            <div v-if="a<1">
                                {{item.uname}}

                                {{item.lastname}}
                                <br>
                                {{item.address}}
                                <br>
                                {{item.phone}}
                            </div>

                        </div>

                        <div class="ordine">

                            {{item.name}}

                        </div>

                    </div>
                    <br><br>

                </div>
            </div>

            <br><br>
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

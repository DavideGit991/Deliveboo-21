<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-3">
                    <h1>Nome: {{ name }}</h1>
                    <div>Descrizione: {{description}}</div>
                    <div>price: {{price}}</div>
                </div>    
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                name:this.name,
                description:this.description,
                price:this.price,
                availability:this.availability,
                img:this.img,
                id:this.id,
            };
            
        },

        methods:{

        },

        mounted() {
            console.log('Component mounted.')
        },



        props:{
            name:String,
            description:String,
            price:Number,
            availability:Number,
            img:String,
            id:Number,
        }
    }
</script>

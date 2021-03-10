<template>
    <div>
        <div class="card-header">
            Ordini
        </div>
        <div class="card-body">
            {{id}}
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

        }
    },

    mounted(){
        console.log(this.id);

         axios.get('/orders/'+this.id)
             .then(res=>{
                 console.log(res);
             })
    },



}
</script>

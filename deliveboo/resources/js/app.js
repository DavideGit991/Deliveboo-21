
require('./bootstrap');

window.Vue = require('vue');


const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

function init(){

     
     
    const app = new Vue({
    el: '#app',

    data: {
        typologies: [
            {
                "color": "#FF7F50",
                "name": "Sushi",
            },
            {
                "color": "#660066",
                "name": "Pizza",
            },
            {
                "color": "skyblue",
                "name": "Hamburger",
            },
            {
                "color": "#ffcc33",
                "name": "Messicana",
            },
            {
                "color": "#6b9023",
                "name": "Italiana",
            },
            {
                "color": "salmon",
                "name": "Cinese",
            },
            {
                "color": "darkcyan",
                "name": "Dessert",
            },
            {
                "color": "#FF7F50",
                "name": "Spesa",
            },
            {
                "color": "#660066",
                "name": "Americana",
            },
            {
                "color": "skyblue",
                "name": "Sandwich",
            },
            {
                "color": "#ffcc33",
                "name": "Kebab",
            },
            {
                "color": "#6b9023",
                "name": "Gelato",
            },
            {
                "color": "salmon",
                "name": "Healthy",
            },
            {
                "color": "darkcyan",
                "name": "Poke",
            }           
        ],

        cities:[],
        citta:''
    },
    mounted(){
        axios.get('/cities/').then(res=>{
            this.cities=res.data;
            console.log(this.cities);
            console.log(this.citta);
        })
    },
    methods: {

        ciao: function() {
            console.log('ciao');
        },

        getTyplogy: function(){
            axios.get('/typologies/').then(res=>{
                console.log(res);
            })
        },
        selectCity: function(event){
            this.citta=event.target.options[event.target.options.selectedIndex].text;
            console.log(this.citta);
            const cittaSelezionata={
                city:this.citta,
            };
            console.log(cittaSelezionata);
            axios.post('/restaurantCity', cittaSelezionata).then(res=>{
                console.log(res);
            })
        }
    }
});


};


document.addEventListener('DOMContentLoaded',init);


require('./bootstrap');

window.Vue = require('vue');


const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

function init(){

    const app = new Vue({
        el: '#app',

        data: {
            //dati della homepage
            showTypologies:false,
            showBest:true,
            showRestaurantCity:false,
            showName:true,
            showRestaurantSelected:false,
            showAlert: false,
            showDetail:false,
            showSearchResult:false,

            inputName:'',

            cities:[],
            citta:'',
            restaurants:[],
            restaurantsVotes:[],
            typologiesCity:[],
            restaurantsSelected:[],

            selectedTypology:'',
            selectedIndex:'',

            searchResults: [],

            menu: false,
            openMenu: true,

            // dati del carrello



            // quadratini colorati
            typologyColors: [
                "coral",
                "#660066",
                "skyblue",
                "#ffcc33",
                "#6b9023",
                "salmon",
                "darkCyan",
                "#660066",
                "#ffcc33",
                "salmon",
            ],

            randomAvatars: [
                "ateneo-zozzerie.jpg",
                "pizza.jpg",
                "birreria.jpg",
                "panini.jpg",
                "sushi2.jpg",
                "fragola.jpg",
                "bbq.jpg"
            ]
        },
        mounted(){
            //richiamo le citta' dove e' presente un ristorante
            axios.get('/cities')
                .then(res=>{

                    this.cities=res.data;

                    //Rendo prima lettera maiuscola
                    for(var i = 0 ; i < this.cities.length ; i++){
                        this.cities[i].city = this.capitalizeFirstLetter(this.cities[i].city);
                    }
                });

            //chiamata per sapere i risto piu votati
            axios.get('/votes')
                .then(res=>{
                    this.restaurantsVotes=res.data;

                    for(var i = 0 ; i < this.restaurantsVotes.length ; i++){
                        this.restaurantsVotes[i].name = this.capitalizeFirstLetter(this.restaurantsVotes[i].name );
                    }
                })
        },

        methods: {

            //variazione option select
            selectCity: function(event){
                this.citta=event.target.options[event.target.options.selectedIndex].text;

                // console.log(this.citta);

                const cittaSelezionata={
                    city:this.citta,
                };

                if (this.citta=='Seleziona Città'){
                    this.showRestaurantSelected=false;
                    this.showBest=true;
                    this.showRestaurantCity=false;
                    this.showTypologies=false;
                    this.showName=true;
                    this.showSearchResult=false;
                    this.inputName='';
                }else{
                    this.showRestaurantSelected=false;
                    this.showBest=false;
                    this.showRestaurantCity=true;
                    this.showName=false;
                    this.showSearchResult=false;

                    console.log(cittaSelezionata);

                    //chiamata restituzione tipologie per città selezionata
                    axios.post('/typologiesCity',cittaSelezionata)
                        .then(res=>{
                        this.showTypologies=true;
                        this.typologiesCity=res.data;
                    })

                    //chiamata per i ristoranti della città selezionata
                    axios.post('/restaurantCity', cittaSelezionata)
                        .then(res=>{
                            this.restaurants=res.data;

                            for(var i = 0 ; i < this.restaurants.length ; i++){
                                this.restaurants[i].name = this.capitalizeFirstLetter(this.restaurants[i].name );
                            }
                        })

                    // prenderle la tipologia dal bottone e la città selezionata
                    // vado dillà e faccio una query che ritorna i ristoranti con citta selezionata e tipologia selezionata
                };
            },

            // funzione per passare pagina menu dai piu' votati
            GoToMenu:function (id) {
                const param={
                    id:id
                };

                axios.get('/show/restaurant/menu/'+id,param)
                    .then(res=>{
                        location.replace("/show/restaurant/menu/"+id)
                    })
            },

            selectTypology:function(name){
                this.selectedTypology=name;

                const data={
                    city:this.citta,
                    name:this.selectedTypology
                }
                axios.post('/selectedTypology',data)
                    .then(res=>{

                        this.showRestaurantCity=false;
                        this.showRestaurantSelected=true;

                        this.restaurantsSelected=res.data;
                        console.log(this.restaurantsSelected);

                        for(var i = 0 ; i < this.restaurantsSelected.length ; i++){
                            this.restaurantsSelected[i].name = this.capitalizeFirstLetter(this.restaurantsSelected[i].name );
                        }
                    })
            },

            //Ricerca ristoranti per nome
            searchRestaurantName(){
                // this.inputName=this.capitalizeFirstLetter(this.inputName);

                const data={
                    name:this.inputName
                }
                axios.post('/search',data)
                .then(res=>{

                    this.searchResults=res.data;

                    if(this.inputName !== '') {
                        
                        this.showSearchResult=true;
                    }else {
                        this.showSearchResult=false;
                    }

                    for(var i = 0 ; i < this.searchResults.length ; i++){
                        this.searchResults[i].name = this.capitalizeFirstLetter(this.searchResults[i].name );
                    }
                })
            },

            //funzione per far apparire alert
            alert(){
            this.showAlert=true;
            },

            //funzione per vedere dettagli ristoratore
            showDetails(){
            const element = document.getElementById("box-det");
            const icon = document.getElementById('icon');
            if (icon.classList.contains('fa-sort-down')) {
                this.showDetail=true;
                icon.classList.remove('fa-sort-down');
                icon.classList.add('fa-sort-up');
            } else {
                this.showDetail=false;
                icon.classList.remove('fa-sort-up');
                icon.classList.add('fa-sort-down');
            }
            },

            //Rende la prima lettera maiuscola in stringa
            capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            },

            //Burger menu
            shMenu: function () {
                this.openMenu===true?this.openMenu=false:this.openMenu=true;
                this.menu = !this.openMenu;
                // this.showName = !this.menu
            },

        }

    });
};


document.addEventListener('DOMContentLoaded',init);

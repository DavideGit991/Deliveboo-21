
require('./bootstrap');

window.Vue = require('vue');


const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

function init(){



    const app = new Vue({
    el: '#app',

    data: {
        showTypologies:false,
        showBest:true,
        showRestaurantCity:false,
        showName:true,
        showRestaurantSelected:false,
        showAlert: false,
        showDetail:false,

        inputName:'',

        cities:[],
        citta:'',
        restaurants:[],
        restaurantsVotes:[],
        typologiesCity:[],
        restaurantsSelected:[],

        selectedTypology:'',

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
        ]
    },
    mounted(){
        //richiamo le citta' dove e' presente un ristorante
        axios.get('/cities')
             .then(res=>{
                // console.log(res.data);

                this.cities=res.data;

                // console.log(this.cities);

            });
            // console.log(this.cities);
            // console.log(this.citta);

        //chiamata per sapere i risto piu votati
        axios.get('/votes')
             .then(res=>{
                 this.restaurantsVotes=res.data;
                //  console.log('vote',this.restaurantsVotes);
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
            }else{
                this.showRestaurantSelected=false;
                this.showBest=false;
                this.showRestaurantCity=true;
                this.showName=false;

                console.log(cittaSelezionata);

                //chiamata restituzione tipologie per città selezionata
                        axios.post('/typologiesCity',cittaSelezionata)
                            .then(res=>{
                            this.showTypologies=true;
                            this.typologiesCity=res.data;
                            // console.log(this.typologiesCity);
                        })

                //chiamata per i ristoranti della città selezionata
                axios.post('/restaurantCity', cittaSelezionata)
                     .then(res=>{
                        this.restaurants=res.data;
                        // console.log(this.restaurants);
                    })

                // prenderle la tipologia dal bottone e la città selezionata
                // vado dillà e faccio una query che ritorna i ristoranti con citta selezionata e tipologia selezionata



            };

        },

        selectTypology:function(name){
            this.selectedTypology=name;
            // console.log(this.selectedTypology);
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
                })
        },

        searchRestaurantName(){
            const data={
                name:this.inputName
            }
            axios.post('/search',data)
            .then(res=>{
              console.log(res);
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

    }

});


};


document.addEventListener('DOMContentLoaded',init);

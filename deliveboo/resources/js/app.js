
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
        ]
    },

    methods: {

        ciao: function() {
            console.log('ciao');
        }
    }
});


};


document.addEventListener('DOMContentLoaded',init);

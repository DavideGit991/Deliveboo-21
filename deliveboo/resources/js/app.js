
require('./bootstrap');

window.Vue = require('vue');


// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


function init(){
//     function show(){
//         console.log('sono la tua show');
// }

     console.log('ciao');
     new Vue({
         el: '#app',
         data:{
                showRestaurant:false,
         },

     });
};


document.addEventListener('DOMContentLoaded',init);

<script>

import { Bar } from 'vue-chartjs'

export default {
    extends: Bar,
  data: () => ({

      chartdata: {
          labels: ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
      datasets: [
          {
              label: 'Ordini per mese',
          backgroundColor: '#f87979',
          data: []
        }
      ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    },
  }),

  mounted () {

    
    let arr = [];
    let arrayCopia=[];
  
    for (let index = 1; index <= 12; index++) {
      let cont=0;
      this.stats.forEach(item => {
        if (index==item.month) {
          cont++;
        }
      });
      if(cont>0){
        arrayCopia.push({
          month:index,
          ordineMese:cont
        });
      }else{
        arrayCopia.push({
          month:index,
          ordineMese:0
        });
      }
    }


    // for (let index = 1; index <= 12; index++) {
    //    let trovato=false;
    //   this.stats.forEach(item => {
    //     if (index==item.month && trovato==false) {
    //       arrayCopia.push(item);
    //       trovato=true;
    //     }
    //   });
    //   if(trovato==false){
    //       arrayCopia.push({
    //         month:index,
    //         ordineMese:0
    //       });
    //     }
    // }
    
    console.log('copia',arrayCopia);


    // inserisce ordine mesi nell'array di chart.js
    arrayCopia.forEach((element,i) => {
      arr.push(element['ordineMese']);
    });
    this.chartdata.datasets[0].data = arr;
    this.renderChart(this.chartdata, this.options)
    
    
    
    

  },
    props:{
      stats:Array,
  }

}

</script>

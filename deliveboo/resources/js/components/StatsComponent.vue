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
    }
  }),

  mounted () {

    let arr = [];
    for (let index = 0; index <= 11; index++) {
        console.log(this.stats[index].month);
        if (this.stats[index].month!=index+1) {
            this.stats.splice(index,0,{
                 month:index,
                 ordineMese:0
            })
         }
    }

    // inserisce ordine mesi nell'array di chart.js
    this.stats.forEach((element,i) => {
       arr.push(element['ordineMese']);
    });
    this.chartdata.datasets[0].data = arr;
    this.renderChart(this.chartdata, this.options)

  },
    props:{
      stats:Array
  }

}

</script>

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
      console.log(this.stats);
    let arr = [];
    // let mesi=[];

    // for (let index = 1; index <=12; index++) {
    //     mesi.push(index);
    // }

    // mesi.forEach((element,i) => {

    //     this.stats.forEach(item => {

    //        if (!mesi.includes(item.month)) {
    //             this.stats.push({
    //                month:i,
    //                ordineMese:0
    //           })
    //         }
    //    });
    // });

      for (let index = 0; index <= 11; index++) {
          if (this.stats[index].month!=index+1) {
              this.stats.splice(index,0,{
                   month:index,
                   ordineMese:0
              })
           }
      }

    console.log('aggiornamento',this.stats);

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

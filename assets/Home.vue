<template>
  <div class="table-responsive-sm">
    <table class="table table-bordered table-dark">
      <thead>
        <tr>
          <th scope="col">Nom</th>
          <th scope="col">Symbole</th>
          <th scope="col">Prix</th>
          <th scope="col">Market cap</th>
          <th scope="col">Volume</th>
          <th scope="col">%1h</th>
          <th scope="col">%24h</th>
          <th scope="col">%7j</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="crypto in cryptos" v-bind:key="crypto[1].id">
          <td><a v-bind:href="'/crypto/' + crypto[1].symbol + '_' + currency">{{ crypto[1].name }}</a></td>
          <td>{{ crypto[1].symbol }}</td>
          <td>{{ crypto[1].quote[1].price.toPrecision(5) | formatFR }} {{ currencySymbol }}</td>
          <td>{{ crypto[1].quote[1].market_cap.toPrecision(12) | formatFR }} {{ currencySymbol }}</td>
          <td>{{ crypto[1].quote[1].volume_24h.toPrecision(12) | formatFR }} {{ currencySymbol }}</td>
          <td v-bind:class="negativeOrPositive(crypto[1].quote[1].percent_change_1h)">{{ crypto[1].quote[1].percent_change_1h.toPrecision(3) | formatFR }} %</td>
          <td v-bind:class="negativeOrPositive(crypto[1].quote[1].percent_change_24h)">{{ crypto[1].quote[1].percent_change_24h.toPrecision(3) | formatFR }} %</td>
          <td v-bind:class="negativeOrPositive(crypto[1].quote[1].percent_change_7d)">{{ crypto[1].quote[1].percent_change_7d.toPrecision(3) | formatFR }} %</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "Home",
  props: ["currency", "currencySymbol"],
  data() {
    return {
    positiveNumber :'positive',
    negativeNumber :'negative',
    message: "un message",
      cryptos: [],
      crypto: {
        id: "",
        name: "",
        symbol: "",
      },
    };
  },
  methods: {
    negativeOrPositive(x){
      if (x >=0) {
        return this.positiveNumber
      }
      else{
        return this.negativeNumber
      }
    },
    fetchCryptos() {
      fetch("/" + this.currency + "_json")
        .then((res) => res.json())
        .then((res) => {
          console.log(res.data);
          this.cryptosArray = res.data;
          let monObjet = this.cryptosArray;
          let monTableau = Object.keys(monObjet).map(function(cle) {
            return [String(cle), monObjet[cle]]
          });
          this.cryptos = monTableau;

          for(let i=0; i < monTableau.length; i++ ) {
            let monObjet2 = monTableau[i][1].quote;
            let monTableau2 = Object.keys(monObjet2).map(function(cle) {
              return [String(cle), monObjet2[cle]]
            });
           this.cryptos[i][1].quote = monTableau2[0];
           console.log(this.cryptos[i][1].quote[1].price)
          }
        }
      );
    },
  },
  created() {
    this.fetchCryptos();
  },
  mounted(){
    this.negativeOrPositive();
  }
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap");
th {
  font-family: "Montserrat", sans-serif;
}
td {
  font-family: "Montserrat", sans-serif;
}

tr{
  transition: 0.3s;
}
tr:hover{
  box-shadow: 0px 0px 5px 5px royalblue;
}
.positive{
  color: rgb(20, 230, 20) !important;
}
.negative{
  color: rgb(221, 25, 25) !important;
}

body {
  background-color: rgb(50, 50, 50) !important;
}
</style>

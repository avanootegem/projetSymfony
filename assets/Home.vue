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

    <tbody v-if="currency == 'EUR'">
      <tr v-for="crypto in cryptos" v-bind:key="crypto.id">
        <td><a v-bind:href="'/crypto/' + crypto.name + '_' + currency">{{ crypto.name }}</a></td>
        <td>{{ crypto.symbol }}</td>
        <td>{{ crypto.quote.EUR.price.toPrecision(5) | formatFR }} €</td>
        <td>{{ crypto.quote.EUR.market_cap.toPrecision(12) | formatFR }} €</td>
        <td>{{ crypto.quote.EUR.volume_24h.toPrecision(12) | formatFR }} €</td>
        <td v-bind:class="negativeOrPositive(crypto.quote.EUR.percent_change_1h)">{{ crypto.quote.EUR.percent_change_1h.toPrecision(3) | formatFR }} %</td>
        <td v-bind:class="negativeOrPositive(crypto.quote.EUR.percent_change_24h)">{{ crypto.quote.EUR.percent_change_24h.toPrecision(3) | formatFR }} %</td>
        <td v-bind:class="negativeOrPositive(crypto.quote.EUR.percent_change_7d)">{{ crypto.quote.EUR.percent_change_7d.toPrecision(3) | formatFR }} %</td>
      </tr>
    </tbody>

    <tbody v-else-if="currency == 'GBP'">
      <tr v-for="crypto in cryptos" v-bind:key="crypto.id">
        <td><a v-bind:href="'/crypto/' + crypto.name + '_' + currency">{{ crypto.name }}</a></td>
        <td>{{ crypto.symbol }} </td>
        <td>{{ crypto.quote.GBP.price.toPrecision(5) | formatUS }} £</td>
        <td>{{ crypto.quote.GBP.market_cap.toPrecision(12) | formatUS }} £</td>
        <td>{{ crypto.quote.GBP.volume_24h.toPrecision(12) | formatUS }} £</td>
        <td v-bind:class="negativeOrPositive(crypto.quote.GBP.percent_change_1h)">{{ crypto.quote.GBP.percent_change_1h.toPrecision(3) | formatUS }} %</td>
        <td v-bind:class="negativeOrPositive(crypto.quote.GBP.percent_change_24h)">{{ crypto.quote.GBP.percent_change_24h.toPrecision(3) | formatUS }} %</td>
        <td v-bind:class="negativeOrPositive(crypto.quote.GBP.percent_change_7d)">{{ crypto.quote.GBP.percent_change_7d.toPrecision(3) | formatUS }} %</td>
      </tr>
    </tbody>

    <tbody v-else>
      <tr v-for="crypto in cryptos" v-bind:key="crypto.id">
        <td><a v-bind:href="'/crypto/' + crypto.name + '_' + currency">{{ crypto.name }}</a></td>
        <td>{{ crypto.symbol }}</td>
        <td>{{ crypto.quote.USD.price.toPrecision(5) | formatUS }} $</td>
        <td>{{ crypto.quote.USD.market_cap.toPrecision(12) | formatUS }} $</td>
        <td>{{ crypto.quote.USD.volume_24h.toPrecision(12) | formatUS }} $</td>
        <td v-bind:class="negativeOrPositive(crypto.quote.USD.percent_change_1h)">{{ crypto.quote.USD.percent_change_1h.toPrecision(3) | formatUS }} %</td>
        <td v-bind:class="negativeOrPositive(crypto.quote.USD.percent_change_24h)">{{ crypto.quote.USD.percent_change_24h.toPrecision(3) | formatUS }} %</td>
        <td v-bind:class="negativeOrPositive(crypto.quote.USD.percent_change_7d)">{{ crypto.quote.USD.percent_change_7d.toPrecision(3) | formatUS }} %</td>
      </tr>
    </tbody>
  </table>
  </div>
</template>

<script>
export default {
  name: "Home",
  props: ["currency"],
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
          this.cryptos = res.data;
        });
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
  box-shadow: 0px 0px 10px 10px royalblue;
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

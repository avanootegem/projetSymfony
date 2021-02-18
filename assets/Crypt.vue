<template>
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

    <tbody v-if=" currency == 'EUR'">
      <tr v-for="crypto in cryptos" v-bind:key="crypto.id">
        <td>{{ crypto.name }}</td>
        <td>{{ crypto.symbol }}</td>
        <td>{{ crypto.quote.EUR.price.toPrecision(5) | formatFR }} €</td>
        <td>{{ crypto.quote.EUR.market_cap.toPrecision(12) | formatFR }}</td>
        <td>{{ crypto.quote.EUR.volume_24h.toPrecision(12) | formatFR }}</td>
        <td>{{ crypto.quote.EUR.percent_change_1h.toPrecision(3) | formatFR }}</td>
        <td>{{ crypto.quote.EUR.percent_change_24h.toPrecision(3) | formatFR }}</td>
        <td>{{ crypto.quote.EUR.percent_change_7d.toPrecision(3) | formatFR }}</td>
      </tr>
    </tbody>

    <tbody v-else-if=" currency == 'GBP'">
      <tr v-for="crypto in cryptos" v-bind:key="crypto.id">
        <td>{{ crypto.name }}</td>
        <td>{{ crypto.symbol }}</td>
        <td>{{ crypto.quote.GBP.price.toPrecision(5) | formatUS }} £</td>
        <td>{{ crypto.quote.GBP.market_cap.toPrecision(12) | formatUS }}</td>
        <td>{{ crypto.quote.GBP.volume_24h.toPrecision(12) | formatFR }}</td>
        <td>{{ crypto.quote.GBP.percent_change_1h.toPrecision(3) | formatUS }}</td>
        <td>{{ crypto.quote.GBP.percent_change_24h.toPrecision(3) | formatUS }}</td>
        <td>{{ crypto.quote.GBP.percent_change_7d.toPrecision(3) | formatUS }}</td>
      </tr>
    </tbody>
    
    <tbody v-else>
      <tr v-for="crypto in cryptos" v-bind:key="crypto.id">
        <td>{{ crypto.name }}</td>
        <td>{{ crypto.symbol }}</td>
        <td>{{ crypto.quote.USD.price.toPrecision(5) | formatUS }} $</td>
        <td>{{ crypto.quote.USD.market_cap.toPrecision(12) | formatUS }}</td>
        <td>{{ crypto.quote.USD.volume_24h.toPrecision(12) | formatFR }}</td>
        <td>{{ crypto.quote.USD.percent_change_1h.toPrecision(3) | formatUS }}</td>
        <td>{{ crypto.quote.USD.percent_change_24h.toPrecision(3) | formatUS }}</td>
        <td>{{ crypto.quote.USD.percent_change_7d.toPrecision(3) | formatUS }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: "Crypt",
  props: ["currency", "symbol"],
  data() {
    return {
      message: "un message",
      cryptos: [],
    };
  },
  methods: {
    fetchCryptos() {
      fetch("/crypto/" + this.symbol + "_" + this.currency + "_json")
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
};
</script>

<style>
body {
  background-color: rgb(50, 50, 50) !important;
}
</style>
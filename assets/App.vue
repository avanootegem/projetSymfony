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
      <tbody>
        <tr v-for="crypto in cryptos" v-bind:key="crypto.id">
          <td>{{ crypto.name }}</td>
          <td>{{ crypto.symbol }}</td>
          <td>{{ crypto.quote.EUR.price }}€</td>
          <td>{{ crypto.quote.EUR.market_cap }}</td>
          <td>{{ crypto.quote.EUR.volume_24h }}</td>
          <td>{{ crypto.quote.EUR.percent_change_1h }}</td>
          <td>{{ crypto.quote.EUR.percent_change_24h }}</td>
          <td>{{ crypto.quote.EUR.percent_change_7d }}</td>
        </tr>
      </tbody>
    </table>

</template>

<script>
export default {
  name: "App",
  data() {
    return {
      message: "un message",
      cryptos: [],
      crypto: {
        id: "",
        name: "",
        symbol: "",
      },
      crypto_id: "",
    };
  },
  methods: {
    test() {
      console.log("test");
      this.crypto = "test";
    },
    fetchCryptos() {
      fetch("/EUR_json")
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
  mounted() {
    this.test();
  },
};
</script>

<style>
body{
    background-color: rgb(50, 50, 50) !important;
    }
</style>
<template>
  <div>
    <div class="text-center">
      <p class="green">Nom : {{ crypto.name }}</p>
      <p class="green">Symbol : {{ crypto.symbol }}</p>
      <p class="green">
        Prix : {{ quoteValue.price.toPrecision(5) | formatFR }} {{currencySymbol}}
      </p>
      <p class="green">
        Market cap :
        {{ quoteValue.market_cap.toPrecision(12) | formatFR }} {{currencySymbol}}
      </p>
      <p class="green">
        Volume 24h :
        {{ quoteValue.volume_24h.toPrecision(12) | formatFR }} {{currencySymbol}}
      </p>
      <p class="green" v-bind:class="negativeOrPositive(quoteValue.percent_change_1h)">
        1h :
        {{ quoteValue.percent_change_1h.toPrecision(3) | formatFR }} %
      </p>
      <p class="green" v-bind:class="negativeOrPositive(quoteValue.percent_change_24h)">
        24h :
        {{ quoteValue.percent_change_24h.toPrecision(3) | formatFR }} %
      </p>
      <p class="green" v-bind:class="negativeOrPositive(quoteValue.percent_change_7d)">
        7d :
        {{ quoteValue.percent_change_7d.toPrecision(3) | formatFR }} %
      </p>
    </div>

    <h2 class="mt-1 fs-h2">A propos :</h2>
    <p>
      {{ description.description }}
    </p>
    <h3>Liens utiles</h3>
    <ul>
      <li>
        <a :href="description.urls.website[0]">{{
          description.urls.website[0]
        }}</a>
      </li>
      <li>
        <a :href="description.urls.twitter[0]">{{
          description.urls.twitter[0]
        }}</a>
      </li>
      <li>
        <a :href="description.urls.reddit[0]">{{
          description.urls.reddit[0]
        }}</a>
      </li>
      <li>
        <a :href="description.urls.technical_doc[0]">{{
          description.urls.technical_doc[0]
        }}</a>
      </li>
      <li>
        <a :href="description.urls.source_code[0]">{{
          description.urls.source_code[0]
        }}</a>
      </li>
      <li>
        <a :href="description.urls.chat[0]">{{ description.urls.chat[0] }}</a>
      </li>
    </ul>
    <ul >
      <li v-for="explorer in description.urls.explorer" v-bind:key="explorer.id">
        <a :href="explorer">{{ explorer }}</a>
      </li>
    </ul>
    <h3>Tags</h3>
    <ul >
      <li class="tags" v-for="tag in tags" :key="tag.id"> {{ tag}} </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "Crypt",
  props: ["currency", "currencySymbol", "symbol"],
  data() {
    return {
      negativeNumber :'negative',
      description: "",
      cryptos: "",
      crypto: "",
    };
  },
  methods: {
    negativeOrPositive(x){
      if (x < 0) {
        return this.negativeNumber
      }
    },
    fetchCryptoName() {
      fetch("/crypto/" + this.symbol + "_" + this.currency + "_json")
        .then((res) => res.json())
        .then((res) => {
          console.log(res.data);
          this.cryptos = res.data;
          let monObjet = this.cryptos;
          let monTableau = Object.keys(monObjet).map(function (cle) {
            return [String(cle), monObjet[cle]];
          });
          this.crypto = monTableau[0][1];

          let monObjet2 = this.crypto.quote;
          let monTableau2 = Object.keys(monObjet2).map(function (cle) {
            return [String(cle), monObjet2[cle]];
          });
          this.quoteValue = monTableau2[0][1];
        });
    },

    fetchCryptoDescription() {
      fetch("/description/" + this.symbol + "_json")
        .then((res) => res.json())
        .then((res) => {
          console.log(res.data);
          this.description = res.data;
          let monObjet = this.description;
          let monTableau = Object.keys(monObjet).map(function (cle) {
            return [String(cle), monObjet[cle]];
          });
          this.description = monTableau[0][1];
          console.log(this.description);

          let monObjet2 = this.description;
          let monTableau2 = Object.keys(monObjet2).map(function (cle) {
            return [String(cle), monObjet2[cle]];
          });
          this.tags = monTableau2[10][1];
        });
    },
  },
  created() {
    this.fetchCryptoName();
    this.fetchCryptoDescription();
  },
  mounted() {
    this.negativeOrPositive();
  }
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap");

body {
  background-color: rgb(50, 50, 50) !important;
}

.green {
  color: rgb(9, 255, 173);
  font-size: calc(25px + (40 - 25) * ((100vw - 300px) / (1600 - 300)));
  font-family: "Montserrat", sans-serif;
}

.fs-h2 {
  font-family: "haetten", sans-serif;
  font-size: calc(45px + (75 - 45) * ((100vw - 300px) / (1600 - 300)));
}

h2 {
  color: white;
}
h3 {
  font-family: "haetten", sans-serif;
  font-size: calc(30px + (50 - 30) * ((100vw - 300px) / (1600 - 300)));
  color: white;
}
p {
  text-justify: auto;
  color: white;
  font-size: calc(12px + (20 - 12) * ((100vw - 300px) / (1600 - 300)));
  font-family: "Montserrat", sans-serif;
}
li {
  font-family: "Montserrat", sans-serif;
  font-size: calc(12px + (20 - 12) * ((100vw - 300px) / (1600 - 300)));
  color: white;
  list-style: none;
}
li.tags {
  list-style: circle inside;
}
</style>

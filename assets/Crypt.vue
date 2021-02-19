<template>
	<div>
		<div class="text-center">
			<p class="green" v-if="currency == 'EUR'">Nom : {{ crypto.name }}</p>
			<p class="green" v-if="currency == 'EUR'">Symbol : {{ crypto.symbol }}</p>
			<p class="green" v-if="currency == 'EUR'">
				Prix : {{ crypto.quote.EUR.price.toPrecision(5) | formatFR }} €
			</p>
			<p class="green" v-if="currency == 'EUR'">
				Market cap :
				{{ crypto.quote.EUR.market_cap.toPrecision(12) | formatFR }} €
			</p>
			<p class="green" v-if="currency == 'EUR'">
				Volume 24h :
				{{ crypto.quote.EUR.volume_24h.toPrecision(12) | formatFR }} €
			</p>
			<p class="green" v-if="currency == 'EUR'">
				1h :
				{{ crypto.quote.EUR.percent_change_1h.toPrecision(3) | formatFR }} %
			</p>
			<p class="green" v-if="currency == 'EUR'">
				24h :
				{{ crypto.quote.EUR.percent_change_24h.toPrecision(3) | formatFR }} %
			</p>
			<p class="green" v-if="currency == 'EUR'">
				7d :
				{{ crypto.quote.EUR.percent_change_7d.toPrecision(3) | formatFR }} %
			</p>
		</div>

		<h2 class="mt-1 fs-h2">A propos :</h2>
		<p>
			{{description.description}}
		</p>
	</div>

	<!-- <table class="table table-bordered table-dark">
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
  </table> -->
</template>

<script>
export default {
	name: 'Crypt',
	props: ['currency', 'symbol'],
	data() {
		return {
			description: '',
			cryptos: '',
			crypto: '',
		};
	},
	methods: {
		fetchCryptoName() {
			fetch('/crypto/' + this.symbol + '_' + this.currency + '_json')
				.then((res) => res.json())
				.then((res) => {
					console.log(res.data);
					this.cryptos = res.data;
					let monObjet = this.cryptos;
					let monTableau = Object.keys(monObjet).map(function(cle) {
						return [String(cle), monObjet[cle]];
					});
					this.crypto = monTableau[0][1];
				});
		},
		fetchCryptoDescription() {
			fetch('/description/' + this.symbol + '_json')
				.then((res) => res.json())
				.then((res) => {
					console.log(res.data);
					this.description = res.data;
					let monObjet = this.description;
					let monTableau = Object.keys(monObjet).map(function(cle) {
						return [String(cle), monObjet[cle]];
					});
          this.description= monTableau[0][1];
          console.log(this.description)
				});
		},
	},
	created() {
		this.fetchCryptoName();
		this.fetchCryptoDescription();
	},
};
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap');

body {
	background-color: rgb(50, 50, 50) !important;
}

.green {
	color: rgb(9, 255, 173);
	font-size: calc(25px + (40 - 25) * ((100vw - 300px) / (1600 - 300)));
	font-family: 'Montserrat', sans-serif;
}

.fs-h2 {
	font-family: 'haetten', sans-serif;
	font-size: calc(45px + (75 - 45) * ((100vw - 300px) / (1600 - 300)));
}

h2 {
	color: white;
}

p {
	text-justify: auto;
	color: white;
	font-size: calc(12px + (20 - 12) * ((100vw - 300px) / (1600 - 300)));
	font-family: 'Montserrat', sans-serif;
}
</style>

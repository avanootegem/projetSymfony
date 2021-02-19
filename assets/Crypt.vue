<template>
	<div>
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
			1h : {{ crypto.quote.EUR.percent_change_1h.toPrecision(3) | formatFR }} %
		</p>
		<p class="green" v-if="currency == 'EUR'">
			24h :
			{{ crypto.quote.EUR.percent_change_24h.toPrecision(3) | formatFR }} %
		</p>
		<p class="green" v-if="currency == 'EUR'">
			7d : {{ crypto.quote.EUR.percent_change_7d.toPrecision(3) | formatFR }} %
		</p>

		<h2 class="mt-1 fs-h2">A propos :</h2>
		<p>
			What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and
			typesetting industry. Lorem Ipsum has been the industry's standard dummy
			text ever since the 1500s, when an unknown printer took a galley of type
			and scrambled it to make a type specimen book. It has survived not only
			five centuries, but also the leap into electronic typesetting, remaining
			essentially unchanged. It was popularised in the 1960s with the release of
			Letraset sheets containing Lorem Ipsum passages, and more recently with
			desktop publishing software like Aldus PageMaker including versions of
			Lorem Ipsum.
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
			message: 'un message',
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
					var monObjet = this.cryptos;
					var monTableau = Object.keys(monObjet).map(function(cle) {
						return [String(cle), monObjet[cle]];
					});
					this.crypto = monTableau[0][1];
				});
		},
	},
	created() {
		this.fetchCryptoName();
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
  
}
</style>

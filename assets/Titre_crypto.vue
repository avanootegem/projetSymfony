<template>
	<h2 class="text-center fs-crypto">{{ symbol }}</h2>
</template>
<script>
export default {
	name: 'Titre_crypto',
	props: ['symbol','currency'],
	data() {
		return {
			message: 'un message',
			cryptos: [],
		};
	},
	methods: {
		fetchCryptos() {
			fetch('/crypto/' + this.symbol + '_' + this.currency + '_json')
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
@font-face {
	font-family: 'haetten';
	src: url(fonts/haetten.ttf);
}
h2 {
	color: white;
	font-family: 'haetten', sans-serif;
}

.text-center {
	text-align: center;
}

.fs-crypto {
	font-size: 6vh;
}
</style>

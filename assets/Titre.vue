<template>
	<div>
		<a href="/" class="title"> <h1 class="text-center fs-title">Top 100 cryptos</h1> </a>
		<ul class="text-center">
			<a href="/EUR" class="title"> <li class="lienCurrency"> EUR </li> </a>
			<a href="/USD" class="title"> <li class="lienCurrency"> USD </li> </a>
			<a href="/GBP" class="title"> <li class="lienCurrency"> GBP </li> </a>
		</ul>
	</div>
</template>

<script>
export default {
	name: 'Titre',
};
</script>
<style>
@font-face {
	font-family: 'haetten';
	src: url(fonts/haetten.ttf);
}
h1 {
	color: white;
	font-family: 'haetten', sans-serif;
}

a.title:hover {
	text-decoration: none;
}

.lienCurrency {
	display: inline;
}

.text-center {
	text-align: center;
}

.fs-title {
	font-size: calc(50px + (100 - 50) * ((100vw - 400px) / (1600 - 400)));
}
</style>

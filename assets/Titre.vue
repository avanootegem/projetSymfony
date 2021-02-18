<template>
	<h1 class="text-center fs-title">Top 100 cryptos</h1>
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

.text-center {
	text-align: center;
}

.fs-title {
	font-size: calc(50px + (100 - 50) * ((100vw - 400px) / (1600 - 400)));
}
</style>

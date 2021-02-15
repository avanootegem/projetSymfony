<template>
<p> {{crypto}} </p>
</template>

<script>
export default {
    name: "App",
    data() {
        return { 
            message: "un message",
            crypto: []
        }
    },
    methods: {
        test() {
            console.log("test");
            this.crypto = "test"
        }
    },
    mounted() {
        this.test()
    }
}
</script>

<style>
</style>
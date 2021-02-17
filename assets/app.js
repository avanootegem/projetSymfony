/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import Vue from 'vue'
import Home from "./Home.vue"
import Crypt from "./Crypt.vue"

new Vue({
    render(h) {
        return h(Home, {
            props: {
                currency: this.$el.getAttribute('currency'),
            },
        })
    },
    template: "<Home/>"
}).$mount('#home')

new Vue({
    render(h) {
        return h(Crypt, {
            props: {
                currency: this.$el.getAttribute('currency'),
                symbol: this.$el.getAttribute('symbol'),
            },
        })
    },
    template: "<Crypt/>"
}).$mount('#crypt')

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
import Titre from './Titre.vue'

Vue.filter('formatFR', function (euro) {
    return new Intl.NumberFormat('fr-FR').format(euro);
})
Vue.filter('formatUS', function (us) {
    return new Intl.NumberFormat('us-US').format(us);
})
new Vue({
    el: '#titre',
    components:
    {
        Titre
    },
    template: "<Titre/>"
})

new Vue({
    render(h) {
        return h(Home, {
            props: {
                currency: this.$el.getAttribute('currency'),
                currencySymbol : this.$el.getAttribute('currencySymbol')
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
                currencySymbol : this.$el.getAttribute('currencySymbol'),
                symbol: this.$el.getAttribute('symbol'),
            },
        })
    },
    template: "<Crypt/>"
}).$mount('#crypt')


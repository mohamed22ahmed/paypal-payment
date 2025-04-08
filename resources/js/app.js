import Vue from 'vue';
import Vuex from 'vuex';
import router from './routes'
import storeData from './store/store.js'
import "vue-select/dist/vue-select.css";
import App from './components/App.vue';
import VueGoodTablePlugin from 'vue-good-table';

// import the styles
import 'vue-good-table/dist/vue-good-table.css'
Vue.use(VueGoodTablePlugin);


require('./bootstrap');

window.Vue = require('vue');

Vue.use(Vuex);

const store = new Vuex.Store(storeData);

//Vuelidate
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)


//vueselect
import vSelect from "vue-select";
Vue.component("v-select", vSelect);

window.Fire = new Vue();

import swal from 'sweetalert2'

window.swal = swal

import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
})

import VueCompositionAPI from '@vue/composition-api'

Vue.use(VueCompositionAPI)

Vue.component('ExampleComponent', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    store,
    router,
    render: h => h(App),
});

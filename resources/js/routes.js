import VueRoute from 'vue-router'
import Vue from 'vue'
import Form from 'vform'
import {  HasError, AlertError } from 'vform/components/bootstrap5'


import paypal_payment from './components/paypal_payment.vue'
import show_transactions from './components/show_transactions.vue'


export const routes = [
    {  path: '/', component: paypal_payment , name:'paypal_payment' },
    {  path: '/show_transactions', component: show_transactions , name:'show_transactions' },

];


window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.use(VueRoute);

const router = new VueRoute({
    routes,
    mode:'history'
});

export default router

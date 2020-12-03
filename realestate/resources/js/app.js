require('./bootstrap');
import Vue from 'vue';
import App from "./App.vue";
import VueRouter from "vue-router";
import { routes } from './routes';
import store from "./store";
Vue.use(VueRouter);
const router = new VueRouter({
   mode : 'history',
   routes : routes
});

const app = new Vue({
    el : '#app',
    components : { App },
    render : h => h( App ),
    router : router,
    store : store,
});

require('./bootstrap');
import Vue from 'vue';
import App from "./App.vue";
import VueRouter from "vue-router";
import { routes } from './routes';
import store from "./store";
import {Datetime} from "vue-datetime";
import 'vue-datetime/dist/vue-datetime.css';
import VueGeolocation from 'vue-browser-geolocation';
import * as VueGoogleMaps from 'vue2-google-maps';

Vue.config.productionTip = true;

Vue.use(VueGeolocation);

Vue.use(VueGoogleMaps, {
    load : {
        key : "AIzaSyAt8RMPg30TxSbHLwKPSOQqXa9LQpds9bM",
    }
});


Vue.use(Datetime);

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

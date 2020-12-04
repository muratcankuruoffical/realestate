require('./bootstrap');
import Vue from 'vue';
import App from "./App.vue";
import store from "./store";
import {router} from './router';
const app = new Vue({
    el : '#app',
    components : { App },
    render : h => h( App ),
    router : router,
    store : store,
});

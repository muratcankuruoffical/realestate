import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import {routes} from "./routes";

Vue.use(Vuex);

const store = new Vuex.Store({
    state : {
        token : "",

    },
    mutations : {
        setToken(state, token){
            state.token = token;
        },
        clearToken(state){
            state.token = ""
        }
    },
    actions : {
        initAuth({commit, dispatch}){
            let token = localStorage.getItem("token");
            if (token) {
                commit("setToken", token)
            }else {
                return false
            }
        },
        login({commit, dispatch, state}, data){
            return axios.post("http://127.0.0.1:8000/api/auth/login", data)
                .then(response => {
                    commit('setToken', response.data.access_token)
                    localStorage.setItem("token", response.data.access_token)
                })
        },
        register({commit, dispatch, state}, data){
            return axios.post("http://127.0.0.1:8000/api/auth/register", data)
                .then(response => {
                    commit('setToken', response.data.access_token)
                    localStorage.setItem("token", response.data.access_token)
                })
        },
        logout({commit, dispatch, state}){
            axios.get("http://127.0.0.1:8000/api/auth/logout",{
                headers : { 'Content-Type' : 'application/json', Authorization : 'Bearer ' + state.token}
            }).then(response => {
                console.log(response.data)
                routes.push("/")
            })
            commit('clearToken')
            localStorage.removeItem("token")
        }
    },
    getters : {
        isAuth(state){
            return state.token !== ""
        }
    },
})

export default store;

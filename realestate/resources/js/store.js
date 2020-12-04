import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import {router} from "./router";
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
                let expirationDate = localStorage.getItem('expirationDate');
                let time = new Date().getTime();
                if (time >= +expirationDate) {
                    console.log("token süresi geçti")
                    dispatch("logout")
                }else {
                    console.log(+expirationDate - time)
                    commit("setToken", token)
                    dispatch("setExprired", +expirationDate - time)
                }

            }else {
                return false
            }
        },
        login({commit, dispatch, state}, data){
            return axios.post("http://127.0.0.1:8000/api/auth/login", data)
                .then(response => {
                    commit('setToken', response.data.access_token)
                    localStorage.setItem("token", response.data.access_token)
                    //* 1000
                    localStorage.setItem('expirationDate', new Date().getTime() + response.data.expires_in * 1000)
                    dispatch("setExprired", +response.data.expires_in * 1000)
                })
        },
        register({commit, dispatch, state}, data){
            return axios.post("http://127.0.0.1:8000/api/auth/register", data)
                .then(response => {
                    commit('setToken', response.data.access_token)
                    localStorage.setItem("token", response.data.access_token)
                })
        },
        refresh({commit, dispatch, state}){
            axios.get("http://127.0.0.1:8000/api/auth/refresh", {
                headers : { 'Content-Type' : 'application/json', Authorization : 'Bearer ' + state.token}
            }).then(response => {
                commit('setToken', response.data.access_token)
                localStorage.setItem("token", response.data.access_token)
                console.log(response.data)
            });
        },
        logout({commit, dispatch, state}){
            axios.get("http://127.0.0.1:8000/api/auth/logout",{
                headers : { 'Content-Type' : 'application/json', Authorization : 'Bearer ' + state.token}
            }).then(response => {
                router.push("/")
            })
            commit('clearToken')
            localStorage.removeItem("token")
            localStorage.removeItem('expirationDate')
        },
        setExprired({dispatch}, expiresIn){
            setTimeout(function () {
                dispatch("logout")
            }, expiresIn)
        }
    },
    getters : {
        isAuth(state){
            return state.token !== ""
        }
    },
})

export default store;

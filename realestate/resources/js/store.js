import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

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
            console.log(data)
            return axios.post("http://127.0.0.1:8000/api/login", data)
                .then(response => {
                    commit('setToken', response.data.token)
                    localStorage.setItem("token", response.data.token)
                    console.log(response.data)
                })
        },
        logout({commit, dispatch, state}){
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

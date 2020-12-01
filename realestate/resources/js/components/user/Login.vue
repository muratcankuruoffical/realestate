<template>
    <div>
        <Header></Header>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-4 offset-4 border">
                    <form v-on:submit.prevent="setData">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" v-model="user.email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" v-model="user.password">
                        </div>
                        <div class="text-center mb-2">
                            <button class="btn btn-primary">Giriş Yap</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from "../Header";
import axios from 'axios';
export default {
    name: "Login",
    components : {
        Header
    },
    data() {
        return {
            user : {}
        }
    },
    methods : {
        setData() {
            axios.post("http://127.0.0.1:8000/api/login", this.user)
            .then(response => {
                if (response.data.token) {
                    this.$router.push({ name : 'home' })
                }
                //this.$router.push({ name : 'home' })
                console.log(response.data)
            })
        }
    }

}
</script>

<style scoped>

</style>

<template>
    <div>
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
            user : {},
            message : {}
        }
    },
    methods : {
        setData() {
            this.$store.dispatch("login", this.user)
            .then(response => {
                this.$router.push({ name : 'home' })
            })
        }
    }

}
</script>

<style scoped>

</style>

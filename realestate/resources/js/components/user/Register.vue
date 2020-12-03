<template>
    <div>
        <div class="row">
            <div class="col-md-4 offset-4 border">
                <form v-on:submit.prevent="setData">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" v-model="user.name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" v-model="user.email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" v-model="user.password">
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirmation">Password Confirmation</label>
                        <input type="text" class="form-control" id="passwordConfirmation" v-model="user.password_confirmation">
                    </div>
                    <div class="text-center mb-2">
                        <button class="btn btn-primary">Kayıt Ol</button>
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
    name: "Register",
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
            axios.post("http://127.0.0.1:8000/api/auth/register", this.user)
            .then(response => (
                console.log(response.data)
            ))
        }
    }
}
</script>

<style scoped>

</style>

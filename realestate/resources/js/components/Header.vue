<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="" class="nav-link">TEST</a>
                    </li>
                </ul>
                <div class="text-right" v-if="$store.getters.isAuth">
                    <button class="btn btn-primary" @click="logout">Çıkış Yap</button>
                </div>
                <div class="text-right" v-else>
                    <router-link :to="{ name : 'login' }" class="btn btn-primary">Login</router-link>
                    <router-link :to="{ name : 'register' }" class="btn btn-primary">Register</router-link>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: "Header",
    methods : {
        logout() {
             this.$store.dispatch('logout');
        }
    }
}
</script>

<style scoped>

</style>

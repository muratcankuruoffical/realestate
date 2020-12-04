<template>
    <div class="container">
        <Header></Header>
        <div class="row mt-4">
            <div class="col-md-10">
                <router-view></router-view>
            </div>
            <div class="col-md-2 border" style="height: 300px;">
                <div class="text-center">
                    <h2 class="text-muted">Sidebar</h2>
                </div>
                <hr>
                <Sidebar></Sidebar>
            </div>
        </div>
    </div>
</template>

<script>
import Header from "./components/Header";
import Sidebar from "./Sidebar";
export default{
    name: "App",
    created() {
        this.$store.dispatch('initAuth')
    },
    components : {
        Header,
        Sidebar
    },
}
</script>

<style scoped>

</style>

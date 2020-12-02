<template>
    <div class="mb-4">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <router-link :to="{ name : 'home' }" class="nav-link">Anasayfa</router-link>
            </li>
            <div v-if="$store.getters.isAuth">
                <li class="nav-item">
                    <router-link :to="{ name : 'randevu_list' }" class="nav-link">Randevular</router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name : 'randevu_add' }" class="nav-link">Randevu Oluştur</router-link>
                </li>
            </div>
        </ul>
    </div>
</template>

<script>
export default {
    name: "Sidebar"
}
</script>

<style scoped>

</style>

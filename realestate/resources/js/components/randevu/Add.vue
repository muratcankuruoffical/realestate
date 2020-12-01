<template>
    <div>
        <Header></Header>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6 offset-3 border">
                    <form>
                        <div class="form-group">
                            <label for="randevuadresi">Randevu Adresi</label>
                            <input type="text" class="form-control" id="randevuadresi">
                        </div>
                        <div class="form-group">
                            <label for="tarih">Tarih</label>
                            <Datetime v-model="date" id="tarih"></Datetime>
                        </div>
                        <div class="text-center">
                            <h2 class="text-muted">Müşteri Bilgileri</h2>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="isimsoyisim">İsim Soyisim</label>
                            <input type="text" class="form-control" id="isimsoyisim">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="telefon">Telefon</label>
                            <input type="text" class="form-control" id="telefon">
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from "../Header";
import { Datetime } from 'vue-datetime';

import 'vue-datetime/dist/vue-datetime.css';
export default {
    name: "add",
    data() {
      return {
          date : ""
      }
    },
    components : {
        Header,
        Datetime
    }
}
</script>

<style scoped>

</style>

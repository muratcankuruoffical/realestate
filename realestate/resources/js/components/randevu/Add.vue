<template>
    <div>
        <div class="row">
            <div class="col-md-6 border">
                <form v-on:submit.prevent="">
                    <div class="form-group">
                        <label for="randevuadresi">Randevu Adresi</label>
                        <input type="text" class="form-control" id="randevuadresi" v-model:value="address">
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
                    <p>{{ this.myCordinates }}</p>
                </form>
                <button @click="test">Clickle</button>
            </div>
            <div class="col-md-3">
                <div id="map" style="width:350px; height: 350px;"></div>
            </div>
        </div>
    </div>
</template>
<script>
import Header from "../Header";
import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css';
import { gmapApi } from 'vue2-google-maps';
import axios from 'axios';
export default {
    name: "add",

    data() {
      return {
          map : null,
          date : "",
          postcode : "",
          address : "",
          myCordinates : {},
          cordinates : {lat: 51.729157, lng: 0.478027},
          cordinates2 : {lat: 51.748834, lng: 0.482306}
      }
    },
    components : {
        Header,
        Datetime
    },
    methods : {
        test() {
            this.cordinates2 = {lat: 51.748834, lng: 0.482306}
        },
        getOffice() {
            axios.get("https://api.postcodes.io/postcodes/" + this.postcode)
            .then((response) => {
                this.cordinates2 = {lat: response.data.result.latitude,lng: response.data.result.longitude}
                console.log(this.myCordinates)
            });
        },
        initMap: function () {
            this.map = new google.maps.Map(document.querySelector("#map"), {
                center: this.cordinates,
                zoom: 12,

            })
            this.setMarker(this.cordinates, "A")
            google.maps.event.addListener(this.map, 'click', function (e) {
                this.setMarker(e.latLng, "B")
                this.getAddress(e.latLng)
                console.log(e.latLng)

            }.bind(this));

        },
        setMarker: function (Position,Label){
            const markers = new google.maps.Marker({
                position: Position,
                map:this.map,
                draggable: true,
                label:{
                    text:Label,
                    color:"#FFF"
                }
            })
            /*
            google.maps.event.addListener(this.map, 'click', function (e) {
                markers.position = e.latLng;
                console.log(markers.position)
            })
            */
        },
        getAddress(Position) {
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({ location : this.cordinates }, (results, status) => {
                if  (status == "OK") {
                    this.address = results[0].formatted_address;
                    console.log(results[0].formatted_address);
                }
            })
        }
    },

    mounted() {
        this.initMap();
        //this.setMarker(this.cordinates2, "B")
    },
    computed : {
    }

}
</script>

<style scoped>

</style>

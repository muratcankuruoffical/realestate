<template>
    <div>
        <div class="row">
            <div class="col-md-6 border">
                <form v-on:submit.prevent="addAppointment">
                    <div class="form-group">
                        <label for="randevuadresi">Randevu Adresi</label>
                        <input type="text" class="form-control" id="randevuadresi" v-model:value="appointment.appointmentAddress" v-model="appointment.appointmentAddress">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" v-model="date">
                        <input type="time" class="form-control" v-model="time">
                    </div>
                    <div class="text-center">
                        <h2 class="text-muted">Müşteri Bilgileri</h2>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="isimsoyisim">İsim Soyisim</label>
                        <input type="text" class="form-control" id="isimsoyisim" v-model="appointment.customerFullName">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" v-model="appointment.customerEmail">
                    </div>
                    <div class="form-group">
                        <label for="telefon">Telefon</label>
                        <input type="number" class="form-control" id="telefon" v-model="appointment.customerPhoneNumber">
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
                <p>{{ this.appointment }}</p>
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
          time : "",
          postcode : "",
          address : "",
          myCordinates : {},
          cordinates : {lat: 51.729157, lng: 0.478027},
          cordinates2 : {lat: 51.748834, lng: 0.482306},
          appointment : {
              appointmentAddress : "",
              appointmentDate : "",
              appointmentAddressDistance : "",
              customerFullName : "",
              customerEmail : "",
              customerPhoneNumber : null,
              estimatedTimeOfArrival : ""
          },
      }
    },
    components : {
        Header,
        Datetime
    },
    methods : {
        addAppointment() {
            this.appointment.appointmentDate = new Date(this.date +' '+ this.time).toLocaleString();
            console.log(this.appointment)
            axios.post("http://127.0.0.1:8000/api/auth/appointment/add", this.appointment, {
                headers : { 'Content-Type' : 'application/json', Authorization : 'Bearer ' + this.$store.state.token}
            })
            .then(response => {
                this.$router.push({ name : 'randevu_list' })
                console.log(response.data)
            })
        },
        /*
        getOffice() {
            axios.get("https://api.postcodes.io/postcodes/" + this.postcode)
            .then((response) => {
                this.cordinates2 = {lat: response.data.result.latitude,lng: response.data.result.longitude}
                console.log(this.myCordinates)
            });
        },
        */
        initMap: function () {
            this.map = new google.maps.Map(document.querySelector("#map"), {
                center: this.cordinates,
                zoom: 12,
            })
            this.setMarker(this.cordinates, "A")
            google.maps.event.addListener(this.map, 'click', function (e) {
                this.setMarker(e.latLng, "B")
                this.getAddress(e.latLng)
                this.getDistance(e.latLng)
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
        },
        getAddress(position) {
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({ location : position }, (results, status) => {
                if  (status == "OK") {
                    this.appointment.appointmentAddress = results[0].formatted_address;
                    console.log(results[0].formatted_address);
                }
            })
        },
        getDistance(position){
            const service = new google.maps.DistanceMatrixService();
            service.getDistanceMatrix({
                origins: [this.cordinates],
                destinations: [position],
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC,
                avoidHighways: false,
                avoidTolls: false

            }, function (response, status) {
                console.log(response)
                this.appointment.appointmentAddressDistance = response.rows[0].elements[0].distance.text
                this.appointment.estimatedTimeOfArrival = response.rows[0].elements[0].duration.text
            }.bind(this));
        }
    },

    mounted() {
        this.initMap();
    },
    computed : {
    }

}
</script>

<style scoped>

</style>

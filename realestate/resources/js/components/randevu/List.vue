<template>
    <div>
        <table class="table table-bordered table-sm" v-if="appointments.length > 0">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Address</th>
                    <th>Distance</th>
                    <th>Estimated Time Of Arrival</th>
                    <th>Date</th>
                    <th>Customer Full Name</th>
                    <th>Customer Email</th>
                    <th>Customer Phone Number</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="appointment of appointments">
                    <td>{{ appointment.id }}</td>
                    <td>{{ appointment.appointmentAddress }}</td>
                    <td>{{ appointment.appointmentAddressDistance }}</td>
                    <td>{{ appointment.estimatedTimeOfArrival }}</td>
                    <td>{{ appointment.appointmentDate }}</td>
                    <td>{{ appointment.customerFullName }}</td>
                    <td>{{ appointment.customerEmail }}</td>
                    <td>{{ appointment.customerPhoneNumber }}</td>
                    <td v-if="testDate() > appointment.appointmentDate">
                        <span class="badge badge-danger">expired</span>
                    </td>
                    <td v-else>
                        <span class="badge badge-success">not expired</span>
                    </td>
                    <td>
                        <router-link :to="{ name : 'randevu_edit', params : { id : appointment.id, appointment : appointment} }" class="btn btn-primary">Edit</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-center alert alert-warning" role="alert" v-else>
            Data not found!
        </div>
    </div>
</template>

<script>
import Header from "../Header";
import axios from 'axios';
export default {
    name: "list",
    components : {
        Header
    },
    created() {
      this.getAppoitments();
      this.testDate();
    },
    data() {
        return {
            appointments : {}
        }
    },
    methods : {
        getAppoitments() {
            axios.get("http://127.0.0.1:8000/api/auth/appointment/list",{
                headers : { 'Content-Type' : 'application/json', Authorization : 'Bearer ' + this.$store.state.token}
            }).then(response => {
                this.appointments = response.data.appointments
                console.log(response.data)
                console.log(this.appointments)
            })
        },
        testDate(){
            let now = new Date();
            let fulldate = now.toLocaleString(); //year+"-"+month+"-"+date+" "+hours+":"+minutes+":"+seconds
            return fulldate
        }
    }
}
</script>

<style scoped>

</style>

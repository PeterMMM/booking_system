<template>
    <div class="row">
        <div class="col-12 mb-2 text-end mt-2" v-if="user.type == 0">
            <router-link :to='{name:"Create Booking"}' class="btn btn-primary">Book Now</router-link>
            <button class="btn btn-info ml-2 text-white" @click="getBookings()">Refresh</button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Bookings</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Driver</th>
                                    <th>Status</th>
                                    <th v-if="user.type == 1" >Action</th>
                                </tr>
                            </thead>
                            <tbody v-if="bookings.length > 0">
                                <tr v-for="(booking,key) in bookings" :key="key">
                                    <td>{{ booking.id }}</td>
                                    <td>{{ booking.start_time }}</td>
                                    <td>{{ booking.end_time }}</td>
                                    <td>{{ booking.driver_name }}</td>
                                    <td>
                                        <span class="alert-info" v-if="booking.accepted == 0">Pending</span>
                                        <span class="alert-success" v-if="booking.accepted == 1">Accepted</span>
                                        <span class="alert-danger"  v-if="booking.accepted == 2">Rejected</span>
                                    </td>
                                    <td v-if="user.type == 1"  >
                                        <button  type="button" @click="acceptBooking(booking.id)" class="btn btn-sm m-1 btn-success">Accept</button>
                                        <button type="button" @click="rejectBooking(booking.id)" class="btn btn-sm m-1 btn-danger">Reject</button>
                                        <!-- <button v-if="user.type == 0 && booking.id != 2" type="button" @click="cancelBooking(booking.id)" class="btn btn-sm m-1 btn-warning">Cancel</button> -->
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td :colspan="user.type === 0 ? 5 : user.type === 1 ? 6 : 1" align="center">No Bookings Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name:"Booking List",
    data(){
        return {
            bookings:[],
            user: JSON.parse(localStorage.getItem('user')),
        }
    },
    mounted(){
        this.getBookings()
    },
    methods:{
        async getBookings() {
            // Declare the variables before the if block
            let user_field = '';
            let user_id = '';

            // Check Login
            if (localStorage.getItem('user') !== null) {
                console.log('User Login key exists');
                const user = JSON.parse(localStorage.getItem('user'));
                const type = user.type;
                user_id = user.id;
                console.log(user);

                // Use the ternary conditional operator to set the value of user_field
                user_field = type === 0 ? 'customer_id' : 'driver_id';
            } else {
                console.log('User NOT Login');
                window.location.href = "/login";
                return; // Add a return statement here to exit the method early if the user is not logged in
            }

            try {
                // Use the user_field and user_id variables in the API request URL
                const axios = require('axios');

                let config = {
                method: 'get',
                maxBodyLength: Infinity,
                url: `http://127.0.0.1:8000/api/bookings?${user_field}=${user_id}`,
                };

                axios.request(config)
                .then((response) => {
                    console.log(JSON.stringify(response.data));
                    this.bookings = response.data.bookings;
                    console.log('bookings ' + JSON.stringify(this.bookings));
                })
                .catch((error) => {
                 console.log(error);
                });
            } catch (error) {
                console.log(error);
            }
        },
        acceptBooking(id){
            if(confirm("Are you sure to accept this booking ?")){
                const axios = require('axios');
                let config = {
                method: 'put',
                maxBodyLength: Infinity,
                url: `http://127.0.0.1:8000/api/bookings/${id}/accept`,
                headers: { 
                    'Cookie': 'XSRF-TOKEN=eyJpdiI6IlFuWXhLa1o2Y1A1eEtpd2d4Q1RlOEE9PSIsInZhbHVlIjoiMzEyRURodXl1c2FkQ1hqM2VUWnJsYlZCTVc5bjd0OCtQci9XT2JlalF0b3JFN05uS2ZCclNlRDUvV1AwR1ZQZllxTHVMUVhFQWhyNjVZeWFFYlJtYUJZcWNQLzlINS9aWFhjTWt1akJXYkJHNUxxSEs5UDdHTlZ0bmE1T09GbzciLCJtYWMiOiJjYTlkMGVlZmZlNjY5YTQ4MjM1NTk3YzdhN2E0ZDQ4OTA1Mjk0MzIzNTgzMjdmOWYzOTk0YzZkMjA2Nzc5ODJjIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImJMQlgrTFA1dnVsR3BwYjR3bzRMdGc9PSIsInZhbHVlIjoiWFltQkw4N0tHbTRGVTVBc1VGd2dhVStvbUJuNUpmejE0NzBuNUtoeThqZWp0dk1HRnJaaEdKWXllcDhVblJjcVU0ZWthclpsV2d2aGZZRjJMMUpsSU1SeENWUVJOdlFHMmFrOEVNTDkwRHpXODBDQmQ1OE9MQU80MDExSVYwcGgiLCJtYWMiOiIxYzNhYTNlOGE3Y2M5NWM3ZTU5YjNhMTAxOTM2Yzc2ZDg1NzEwZTZiMTViNTUxNTk0NzQ1ZmZlNzAxM2QzNmNmIiwidGFnIjoiIn0%3D'
                }
                };

                axios.request(config)
                .then((response) => {
                console.log(JSON.stringify(response.data));
                this.getBookings();
                })
                .catch((error) => {
                console.log(error);
                });

            }
        },
        rejectBooking(id){
            if(confirm("Are you sure to reject this booking ?")){
                const axios = require('axios');
                let config = {
                method: 'put',
                maxBodyLength: Infinity,
                url: `http://127.0.0.1:8000/api/bookings/${id}/reject`,
                headers: { 
                    'Cookie': 'XSRF-TOKEN=eyJpdiI6IlFuWXhLa1o2Y1A1eEtpd2d4Q1RlOEE9PSIsInZhbHVlIjoiMzEyRURodXl1c2FkQ1hqM2VUWnJsYlZCTVc5bjd0OCtQci9XT2JlalF0b3JFN05uS2ZCclNlRDUvV1AwR1ZQZllxTHVMUVhFQWhyNjVZeWFFYlJtYUJZcWNQLzlINS9aWFhjTWt1akJXYkJHNUxxSEs5UDdHTlZ0bmE1T09GbzciLCJtYWMiOiJjYTlkMGVlZmZlNjY5YTQ4MjM1NTk3YzdhN2E0ZDQ4OTA1Mjk0MzIzNTgzMjdmOWYzOTk0YzZkMjA2Nzc5ODJjIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImJMQlgrTFA1dnVsR3BwYjR3bzRMdGc9PSIsInZhbHVlIjoiWFltQkw4N0tHbTRGVTVBc1VGd2dhVStvbUJuNUpmejE0NzBuNUtoeThqZWp0dk1HRnJaaEdKWXllcDhVblJjcVU0ZWthclpsV2d2aGZZRjJMMUpsSU1SeENWUVJOdlFHMmFrOEVNTDkwRHpXODBDQmQ1OE9MQU80MDExSVYwcGgiLCJtYWMiOiIxYzNhYTNlOGE3Y2M5NWM3ZTU5YjNhMTAxOTM2Yzc2ZDg1NzEwZTZiMTViNTUxNTk0NzQ1ZmZlNzAxM2QzNmNmIiwidGFnIjoiIn0%3D'
                }
                };

                axios.request(config)
                .then((response) => {
                console.log(JSON.stringify(response.data));
                this.getBookings();
                })
                .catch((error) => {
                console.log(error);
                });
            }
        }
    }
}
</script>
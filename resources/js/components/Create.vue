<template>
    <div>
      <h2>Create Booking</h2>
      <form @submit.prevent="createBooking">
        <div class="form-group">
          <label for="driver">Driver:</label>
          <select v-model="selectedDriver" class="form-control">
            <option v-for="driver in drivers" :key="driver.id" :value="driver.id">{{ driver.username }}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="startTime">Start Time:</label>
          <input v-model="startTime" type="datetime-local" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="endTime">End Time:</label>
          <input v-model="endTime" type="datetime-local" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Booking</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        selectedDriver: null,
        drivers: [],
        startTime: '',
        endTime: '',
        user: JSON.parse(localStorage.getItem('user')),
      };
    },
    created() {
      this.fetchDrivers();
    },
    methods: {
      async fetchDrivers() {
        try {
            const axios = require('axios');
            let config = {
            method: 'get',
            maxBodyLength: Infinity,
            url: 'http://127.0.0.1:8000/api/drivers',
            headers: { }
            };

            axios.request(config)
            .then((response) => {
                this.drivers = response.data.drivers;
                // console.log(JSON.stringify(response.data));
            })
            .catch((error) => {
            console.log(error);
            });
        } catch (error) {
          // Handle error, e.g., show an error message
          console.error('Error fetching drivers:', error);
        }
      },
      async createBooking() {
        try {
            const axios = require('axios');
            const customer_id = this.user.id;
            const driver_id = this.selectedDriver;
            const start_time = this.startTime;
            const end_time = this.endTime;
            let config = {
            method: 'post',
            maxBodyLength: Infinity,
            url: `http://127.0.0.1:8000/api/bookings?customer_id=${customer_id}&driver_id=${driver_id}&start_time=${start_time}&end_time=${end_time}`,
            headers: { 
                'Cookie': 'XSRF-TOKEN=eyJpdiI6IlFuWXhLa1o2Y1A1eEtpd2d4Q1RlOEE9PSIsInZhbHVlIjoiMzEyRURodXl1c2FkQ1hqM2VUWnJsYlZCTVc5bjd0OCtQci9XT2JlalF0b3JFN05uS2ZCclNlRDUvV1AwR1ZQZllxTHVMUVhFQWhyNjVZeWFFYlJtYUJZcWNQLzlINS9aWFhjTWt1akJXYkJHNUxxSEs5UDdHTlZ0bmE1T09GbzciLCJtYWMiOiJjYTlkMGVlZmZlNjY5YTQ4MjM1NTk3YzdhN2E0ZDQ4OTA1Mjk0MzIzNTgzMjdmOWYzOTk0YzZkMjA2Nzc5ODJjIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImJMQlgrTFA1dnVsR3BwYjR3bzRMdGc9PSIsInZhbHVlIjoiWFltQkw4N0tHbTRGVTVBc1VGd2dhVStvbUJuNUpmejE0NzBuNUtoeThqZWp0dk1HRnJaaEdKWXllcDhVblJjcVU0ZWthclpsV2d2aGZZRjJMMUpsSU1SeENWUVJOdlFHMmFrOEVNTDkwRHpXODBDQmQ1OE9MQU80MDExSVYwcGgiLCJtYWMiOiIxYzNhYTNlOGE3Y2M5NWM3ZTU5YjNhMTAxOTM2Yzc2ZDg1NzEwZTZiMTViNTUxNTk0NzQ1ZmZlNzAxM2QzNmNmIiwidGFnIjoiIn0%3D'
            }
            };

            axios.request(config)
                .then((response) => {
                console.log(JSON.stringify(response.data));
                alert(response.data.message);
            })
            .catch((error) => {
            console.log(error);
            });

          // Handle the response, e.g., show a success message
          console.log('Booking created:', response.data.booking);
        } catch (error) {
          // Handle the error, e.g., show an error message
          console.error('Error creating booking:', error.response.data);
        }
      },
    },
  };
  </script>
  
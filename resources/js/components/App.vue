<template>
    <div>
      <h1>Booking List</h1>
      <ul v-if="bookings.length > 0">
        <li v-for="booking in bookings" :key="booking.id">
          <!-- Display booking details here -->
        </li>
      </ul>
      <p v-else>No bookings found.</p>
  
      <!-- Include the BookingForm component -->
      <booking-form v-if="isCustomer" />
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import BookingForm from '../components/BookingForm.vue';
  
  export default {
    data() {
      return {
        bookings: [],
        isCustomer: false, // Assuming this value is set based on customer type (replace with your own implementation)
      };
    },
    created() {
      // Fetch bookings based on user type (customer or driver)
      this.fetchBookings();
    },
    methods: {
      async fetchBookings() {
        try {
          const userType = 0; // Set the user type here based on login status (0 for customer, 1 for driver)
  
          const response = await axios.get(`/api/bookings?type=${userType}`);
  
          this.bookings = response.data.bookings;
        } catch (error) {
          // Handle error, e.g., show an error message or redirect to login page
        }
      },
    },
    components: {
      BookingForm,
    },
  };
  </script>
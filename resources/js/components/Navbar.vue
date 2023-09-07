<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <router-link to="/" class="navbar-brand">Book Driver</router-link>
        <div class="collapse navbar-collapse">
          <div class="navbar-nav">
            <router-link
              exact-active-class="active"
              to="/"
              class="nav-item nav-link"
            >Home</router-link>
            <router-link v-if="!user" exact-active-class="active" to="/login" class="nav-item nav-link">Login</router-link>
            <router-link v-if="!user" exact-active-class="active" to="/register" class="nav-item nav-link">Signup</router-link>      
            <router-link  v-else exact-active-class="active" to="/bookings" class="nav-item nav-link">Bookings</router-link>
            <a  v-if="user"  @click="logout" class="nav-item nav-link" style="cursor: pointer">Logout</a>
          </div>
        </div>
      </div>
    </nav>
  </template>
  
  <script>
  export default {
    data() {
        return {
        user: JSON.parse(localStorage.getItem('user')), 
        };
    },
    moounted(){
    },
    methods: {
      logout() {
        localStorage.removeItem('user');
        this.user = null;
        this.$router.push('/login');
      },
    },
  };
  </script>
  
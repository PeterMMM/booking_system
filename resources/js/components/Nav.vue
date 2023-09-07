<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <router-link to="/" class="navbar-brand" href="#"> </router-link>
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link exact-active-class="active" to="/" class="nav-item nav-link">Home</router-link>
                    <router-link exact-active-class="active" to="/login" class="nav-item nav-link">Login</router-link>
                    <router-link exact-active-class="active" to="/bookings" class="nav-item nav-link">Bookings</router-link>
                    <router-link exact-active-class="active"  to="#" class="nav-item nav-link" @click="logout">Logout</router-link>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
export default {
  methods: {
    logout() {
        if (localStorage.getItem('user') !== null) {
            console.log('User Login key exists');
        } else {
            console.log('User NOT Login');
        }
      // Remove the "user" data from localStorage
      localStorage.removeItem('user');

      // Redirect the user to the login page
      this.$router.push('/login');
    },
  },
};
</script>
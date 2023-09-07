require('./bootstrap');

import { createApp } from 'vue'
import Login from './components/Login.vue'
import Register from './components/Register.vue'
import Welcome from './components/Welcome.vue'
import Bookings from './components/Bookings.vue'
import CreateBooking from './components/Create.vue'
import * as VueRouter from 'vue-router';
import Navbar from './components/Navbar.vue';
export const routes = [
    {
        path:'/register',
        name:'register',
        component:Register
    },
    {
        path:'/login',
        name:'login',
        component:Login
    },
    {
        path:'/bookings',
        name:'Bookings',
        component:Bookings
    },
    {
        path:'/bookings/create',
        name:'Create Booking',
        component:CreateBooking
    },
    { 
        path:'/',
        name:'welcome',
        component:Welcome
    },

];

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory('/a-pj/public/'),
    routes,
})
const app = createApp({})

app.use(router)

app.component('welcome', Welcome)
app.component('navbar', Navbar)


app.mount('#app')
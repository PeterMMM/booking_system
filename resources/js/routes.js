import Login from './components/Login.vue'
import Register from './components/Register.vue'
import Welcome from './components/Welcome.vue'

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
        path:'/',
        name:'welcome',
        component:Welcome
    },

];
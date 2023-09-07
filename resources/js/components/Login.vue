<template>
    <div class=" container">
    <h3 class="text-center">Login</h3>
    <div class="row">
        <div class="col">
            <form @submit.prevent="login">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" v-model="form.email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" v-model="form.password">
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <select class="form-select" aria-label="Default select example"  v-model="form.type">
                        <option selected>Select User Type</option>
                        <option value="0">Customer</option>
                        <option value="1">Driver</option>
                      </select>                
                </div>
                <button type="submit" class="btn btn-primary mt-2">Login</button>
            </form>
        </div>
    </div>
</div>
</template>
<script>
export default {
    data(){
        return {
            form:{}
        }
    },
    mounted(){
        this.checkLogin();
    },
    methods:{
        checkLogin(){
            if (localStorage.getItem('user') !== null) {
                console.log('User Login key exists');
                const user = JSON.parse(localStorage.getItem('user'));

                console.log(localStorage.getItem('user'));
                window.location.href = "/bookings";
            } else {
                console.log('User NOT Login');
            }
        },
        login(){
            const axios = require('axios');

            let config = {
            method: 'post',
            maxBodyLength: Infinity,
            url: 'http://127.0.0.1:8000/api/signin?email=kin@gmail.com&password=pwero12423&type=1',
            data: this.form
            };

            axios.request(config)
            .then((response) => {
                console.log('User NOT Login',JSON.stringify(response.data.user));
                localStorage.setItem('user', JSON.stringify(response.data.user));
                console.log(JSON.stringify(response.data.user));
                this.checkLogin();
            })
            .catch((error) => {
            console.log(error);
            });

        }
    }
}
</script>
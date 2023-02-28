<template>
    <div class="login-page">

        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <form>
            <div class="signup">signup</div>
            <h3>Login</h3>

            <label for="username">Username</label>
            <input type="text" class="login-signup" placeholder="Email or Phone" id="username" v-model="login.email">

            <label for="password">Password</label>
            <input type="password" class="login-signup" placeholder="Password" id="password" v-model="login.password">

            <button class="login-btn" @click="userlogin">Log In</button>

            <div class="forget-password" @click.stop="forgetPassword">Forget Password?</div>

        </form>
    </div>
</template>
    
<script>
import {loginInfoStore} from '../stores/loginInfo';
import {mapState,mapActions} from 'pinia'
import "./Login.css";
export default {
    data: function () {
        return {
            login: {
                email: "",
                password: ""
            },
            loginDetail:{}
        };
    },
    computed: {
    ...mapState(loginInfoStore, ['getLoginInfo','isAuthenticate']),
  },
    methods: {
        ...mapActions(loginInfoStore, ['setLoginInfo','setAuthenticate']),
        forgetPassword() {
            this.show('hello show toaster');
            // this.$router.push('/forget-password');
        },

       async userlogin(e) {
            e.preventDefault();
            let postResponse={};
            let urlText = 'auth/login';
            let formData = {};
            formData['email'] = this.login.email;
            formData['password'] = this.login.password;
            postResponse = await this.post(urlText,formData);
            this.loginDetail = postResponse!=null?postResponse.data:'';
            localStorage.setItem("token", postResponse.data.access_token);
            this.setLoginInfo(this.loginDetail)
            this.setAuthenticate(true)
            if (this.getLoginInfo.user.role=='student') {
                this.$router.push('/teacher')
            }else if(this.getLoginInfo.user.role=='teacher') {
                this.$router.push('/student')
            }else if(this.getLoginInfo.user.role=='parent') {
                this.$router.push('/student')
            }else{
                this.$router.push('/student')
            }
        }
    } 
};
</script>
    
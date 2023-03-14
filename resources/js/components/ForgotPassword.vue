<template>
    <div class="login-page">
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <form>
            <h3>Forget Password</h3>
            <label for="username">Email</label>
            <input
                type="text"
                placeholder="Email or Phone"
                id="username"
                class="login-signup"
                v-model="userEmail"
            />
            <div class="forget-password">
                Enter the email address associated with your account.
            </div>
            <button class="login-btn" @click.stop="sendMail">SEND</button>
            <div class="return-login" @click.stop="$root.changeRoute('/')">Go Back To <span class="highlight-yellow hand">LOGIN {{ '  ' }}</span>&nbsp; Page</div>
        </form>
        
    </div>
</template>

<script>
import "./forgetPassword.css";

export default {
    data: function () {
        return {
            userEmail: ""
        };
    },

    methods: {
        sendMail(e) {
            let that = this;
            e.preventDefault();
            let formData = {};
            formData["userEmail"] = that.userEmail;
            if (that.userEmail == "") {
                that.errorAlert("Email is empty");
            } else {
                that.saveAlert('please wait ....');
                axios
                    .post("/api/forgot-password", formData)
                    .then((response) => {
                        if (response.data.status == "Email not registered") {
                            that.errorAlert(response.data.status);
                        } else {
                            that.saveAlert('check your email and reset password');
                        }
                        that.userEmail = "";
                    })
                    .catch(function (error) {
                        that.errorAlert(error.message);
                    });
            }
        },
    },
};
</script>

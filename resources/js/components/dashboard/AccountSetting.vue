<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div
                            class="card-body profile-card pt-4 d-flex flex-column align-items-center"
                        >
                            <img
                                src="../../../../public/dashboard_css/assets/img/profile-img.jpg"
                                alt="Profile"
                                class="rounded-circle"
                            />
                            <h2>
                                {{ getLoginInfo.user.name }}
                            </h2>
                            <h1 style="font-size: 14px">
                                {{ getLoginInfo.user.role }}
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <b-overlay
                        id="overlay-background"
                        :show="show"
                        rounded="sm"
                        class="col-lg-12"
                        spinner-type="grow"
                    >
                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">
                                    <li class="nav-item">
                                        <button
                                            class="nav-link active"
                                            data-bs-toggle="tab"
                                            data-bs-target="#profile-overview"
                                        >
                                            Change Password
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2">
                                    <div
                                        class="tab-pane fade show active profile-overview mt-5"
                                        id="profile-overview"
                                    >
                                        <div class="row">
                                            <!-- Change Password Form -->
                                            <form>
                                                <div class="row mb-3">
                                                    <label
                                                        for="newPassword"
                                                        class="col-md-4 col-lg-3 col-form-label"
                                                        >New Password</label
                                                    >
                                                    <div
                                                        class="col-md-8 col-lg-9"
                                                    >
                                                        <input
                                                            v-model="
                                                                new_password
                                                            "
                                                            name="newpassword"
                                                            type="password"
                                                            class="form-control"
                                                            id="newPassword"
                                                        />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label
                                                        for="renewPassword"
                                                        class="col-md-4 col-lg-3 col-form-label"
                                                        >Re-enter New
                                                        Password</label
                                                    >
                                                    <div
                                                        class="col-md-8 col-lg-9"
                                                    >
                                                        <input
                                                            v-model="
                                                                confirm_password
                                                            "
                                                            name="renewpassword"
                                                            type="password"
                                                            class="form-control"
                                                            id="renewPassword"
                                                        />
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <button
                                                        type="submit"
                                                        class="btn btn-primary"
                                                        @click.stop="
                                                            changePassword
                                                        "
                                                    >
                                                        Change Password
                                                    </button>
                                                </div>
                                            </form>
                                            <!-- End Change Password Form -->
                                        </div>
                                    </div>
                                </div>
                                <!-- End Bordered Tabs -->
                            </div>
                        </div>
                    </b-overlay>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { loginInfoStore } from "../../stores/loginInfo";
import { mapState } from "pinia";
export default {
    data() {
        return {
            confirm_password: "",
            new_password: "",
        };
    },
    computed: {
        ...mapState(loginInfoStore, ["getLoginInfo"]),
    },
    mounted() {
        this.profileOverview();
    },
    methods: {
        async changePassword(e) {
            e.preventDefault();

            if (this.new_password==''||this.confirm_password=='') {
                this.errorAlert("password is empty");
            }else if (this.new_password != this.confirm_password) {
                this.errorAlert("password not match");
            } else {
                let id = this.getLoginInfo.user.id;
                let formData = {};
                formData['password'] = this.new_password;
                let  urlText ="user/" + id + "/changePassword";

                let putResponse = await this.put(urlText, formData);
                this.saveAlert('password change succesfully');

                // this.logOut();
            }
        },
    },
};
</script>

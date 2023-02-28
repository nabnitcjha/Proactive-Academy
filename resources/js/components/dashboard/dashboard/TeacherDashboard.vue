<template>
    <div class="row">
        <!-- Right side columns -->
        <div class="col-12">
            <!-- Recent Activity -->
            <div class="card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"
                        ><i class="bi bi-three-dots"></i
                    ></a>
                    <ul
                        class="dropdown-menu dropdown-menu-end dropdown-menu-arrow"
                    >
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li>
                            <a class="dropdown-item" href="#">Yesterday</a>
                        </li>
                        <li><a class="dropdown-item" href="#">Tomorrow</a></li>
                    </ul>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Classes <span>| Today</span></h5>
                    <div class="row">
                        <!-- Sales Card -->
                        <div
                            class="col-xxl-4 col-md-6"
                            v-for="(tcls, index) in totalClass"
                            :key="index"
                        >
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ 'Start Time' }}
                                        <span
                                            >|
                                            {{
                                                timeFormater(tcls.start_date)
                                            }}</span
                                        >
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        >
                                            <i class="bi bi-book"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ tcls.topic }}</h6>
                                            <span
                                                class="text-success small pt-1 fw-bold"
                                                >{{ tcls.subject.name }}</span
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Sales Card -->
                    </div>
                </div>
            </div>
            <!-- End Recent Activity -->
        </div>
        <!-- End Right side columns -->
    </div>
</template>
<script>
import { loginInfoStore } from "../../../stores/loginInfo";
import { mapState } from "pinia";

export default {
    data: function () {
        return {
            totalClass: [],
        };
    },
    computed: {
        ...mapState(loginInfoStore, ["getLoginInfo"]),
    },
    mounted() {
        this.totalClasses();
    },
    methods: {
        async totalClasses() {
            let urlText =
                "teacher/" + this.getLoginInfo.teacher_info.id + "/sortedClass";
            let getResponse = await this.get(urlText, 1, false);
            this.totalClass = getResponse.data.data;
        },
    },
};
</script>

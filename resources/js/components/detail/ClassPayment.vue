<template>
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-around">
            <div
                class="card"
                style="width: 18rem"
                v-for="(class_info, index) in sorted_class"
                :key="index"
            >
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center">
                        {{ class_info.topic }}
                    </h5>
                    <ul class="list-group">
                        
                        
                        <li class="list-group-item d-flex justify-content-center">
                            <b
                                >{{ index==0?'$20':'$40'}}</b
                            >
                        </li>
                    </ul>
                    <a
                        class="btn btn-success d-flex justify-content-center mt-5"
                        >PAY</a
                    >
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
            sorted_class: [],
        };
    },
    computed: {
        ...mapState(loginInfoStore, ["getLoginInfo"]),
    },
    mounted() {
        this.getClasses();
    },
    methods: {
        async getClasses() {
            
            let urlText = '';
            if (this.getLoginInfo.user.role=='student') {
                urlText =
                "student/" + this.getLoginInfo.student_info.id + "/sortedClass";
            }else{
                urlText =
                "student/" + 1 + "/sortedClass";
            }

           let getResponse = await this.get(urlText, 1, false);
            this.sorted_class = getResponse.data.data;
        },
    },
};
</script>

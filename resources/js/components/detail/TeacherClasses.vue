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
                        <li class="list-group-item d-flex justify-content-around">
                            <span
                                class="badge rounded-pill text-bg-warning mr-2"
                                v-for="(
                                    cls_selected_day, index
                                ) in class_info.selected_day"
                                :key="index"
                                >{{ findDay(cls_selected_day) }}</span
                            >
                        </li>
                        <li class="list-group-item d-flex justify-content-center">
                            {{ class_info.duration }}
                        </li>
                        <li class="list-group-item d-flex justify-content-center">
                            <b
                                >{{ timeFormater(class_info.start_date)}}{{ " - "}}{{ timeFormater(class_info.end_date) }}</b
                            >
                        </li>
                    </ul>
                    <a
                        class="btn btn-success d-flex justify-content-center mt-5"
                        @click.stop= "$root.changeRoute('/class-schedule/'+class_info.class_unique_id)"
                        >Go TO Class</a
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
            let urlText =
                "teacher/" + this.getLoginInfo.teacher_info.id + "/sortedClass";

           let getResponse = await this.get(urlText, 1, false);
            this.sorted_class = getResponse.data.data;
        },
        findDay(day) {
            switch (day) {
                case "0":
                    return "Sun";
                case "1":
                    return "Mon";
                case "2":
                    return "Tues";
                case "3":
                    return "Wed";
                case "4":
                    return "Thurs";
                case "5":
                    return "Fri";
                case "6":
                    return "Sat";
            }
        },
    },
};
</script>

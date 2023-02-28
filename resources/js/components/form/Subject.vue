<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" v-if="mode == 'fetch-subjects'">
                <div class="card-body">
                    <div class="add-item">
                        <h5 class="card-title">Subject List</h5>
                        <button
                            type="button"
                            class="btn btn-add"
                            @click.stop="$root.changeRoute('/add-subject')"
                        >
                            <i class="bi bi-plus"></i> ADD SUBJECT
                        </button>
                    </div>
                    <hr class="hr-color" />
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created</th>
                                <th scope="col">Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(sub, index) in subjects" :key="index">
                                <th scope="row">{{ index + 1}}</th>
                                <td>{{ sub.name }}</td>
                                <td>{{ sub.created_at }}</td>
                                <td>{{ sub.updated_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card" v-else>
                <div class="card-body">
                    <div class="add-item">
                        <h5 class="card-title">Subject Info</h5>
                        <button
                            type="button"
                            class="btn btn-back"
                            @click.stop="$router.go(-1)"
                        >
                            BACK
                        </button>
                    </div>
                    <hr class="hr-color" />
                    <form class="row g-3 needs-validation" novalidate>
                        <div class="col-md-4">
                            <label for="subject_first_name" class="form-label"
                                ><img :src="icons.First_name" />&nbsp;First
                                name</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="subject_first_name"
                                required
                                v-model="subject.name"
                            />
                            <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                            <div class="invalid-feedback">
                                Please choose a fist name.
                            </div>
                        </div>

                        <div class="col-12">
                            <button
                                class="btn btn-success"
                                @click.stop="addSubject"
                            >
                                Save
                            </button>
                        </div>
                    </form>
                    <!-- End Custom Styled Validation -->
                </div>
            </div>
        </div>
    </div>
</template>

<style>
body {
    padding: 1rem;
}
</style>

<script>

import { First_name } from "../../Assets/formIcons/index";
export default {
    data() {
        return {
            icons: {
                First_name: First_name,
            },
            subject: {
                name: "",
            },
            subjects: [],
        };
    },
    props: {
        mode: String,
    },
    mounted(){
        this.getSubjects();
    },
    methods: {
        callBack() {
            this.save();
        },
        addSubject() {
            this.checkValidation(this.callBack);
        },
        async save() {
            let formData = new FormData();

            formData.append("subject_info[name]", this.subject.name);
            let postResponse = {};
            let urlText = "addSubject";

            postResponse = await this.post(urlText, formData);
            this.subject = { name: "" };
            this.$router.push({ name: "subject" });
        },
        async getSubjects() {
            let urlText = "getSubjects/false";
            let getResponse = await this.get(urlText,1,true);
            this.subjects = getResponse.data.data;
        },
    },
};
</script>

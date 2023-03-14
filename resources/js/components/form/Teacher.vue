<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" v-if="dispaly_mode == 'fetch-teachers'">
                <div class="card-body">
                    <div class="add-item">
                        <h5 class="card-title">Teacher List</h5>
                        <button
                            type="button"
                            class="btn btn-add"
                            @click.stop="$root.changeRoute('/add-teacher')"
                            v-if="getLoginInfo.user.role == 'admin'"
                        >
                            <i class="bi bi-plus"></i> ADD TEACHER
                        </button>
                    </div>
                    <hr class="hr-color" />
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Subject</th>
                                <th
                                    scope="col"
                                    v-if="getLoginInfo.user.role == 'admin'"
                                >
                                    Student
                                </th>
                                <th scope="col" v-if="getLoginInfo.user.role=='admin'">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(tech, index) in teachers"
                                :key="index"
                                class="hand"
                            >
                                <th scope="row">{{ index + 1 }}</th>
                                <td
                                    @click.stop="
                                        $root.changeRoute(
                                            '/teacher/' + tech.id + '/detail'
                                        )
                                    "
                                >
                                    {{ tech.full_name }}
                                </td>
                                <td
                                    @click.stop="
                                        $root.changeRoute(
                                            '/teacher/' + tech.id + '/detail'
                                        )
                                    "
                                >
                                    {{ tech.email }}
                                </td>
                                <td
                                    @click.stop="
                                        $root.changeRoute(
                                            '/teacher/' + tech.id + '/detail'
                                        )
                                    "
                                >
                                    {{ tech.phone }}
                                </td>
                                <td
                                    @click.stop="
                                        $root.changeRoute(
                                            '/teacher/' + tech.id + '/detail'
                                        )
                                    "
                                >
                                    <b-list-group>
                                        <b-list-group-item
                                            v-for="sb in tech.subject"
                                            :key="sb.id"
                                            >{{ sb.name }}</b-list-group-item
                                        >
                                    </b-list-group>
                                </td>
                                <td
                                    @click.stop="
                                        $root.changeRoute(
                                            '/teacher/' + tech.id + '/detail'
                                        )
                                    "
                                    v-if="getLoginInfo.user.role == 'admin'"
                                >
                                    <b-list-group>
                                        <b-list-group-item
                                            v-for="stu in tech.student"
                                            :key="stu.id"
                                            >{{
                                                stu.full_name
                                            }}</b-list-group-item
                                        >
                                    </b-list-group>
                                </td>
                                <td class="align-middle" v-if="getLoginInfo.user.role=='admin'">
                                    <i
                                        class="bi bi-pencil hand"
                                        @click.stop="editTeacher(tech)"
                                    ></i>
                                    <i
                                        class="bi bi-trash hand ml-2"
                                        @click.stop="deleteTeacher(tech)"
                                    ></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card" v-else>
                <div class="card-body">
                    <div class="add-item">
                        <h5 class="card-title">teacher Info</h5>
                        <button
                            type="button"
                            class="btn btn-back"
                            @click.stop="$router.go(-1)"
                            v-if="$route.name == 'addTeacher'"
                        >
                            BACK
                        </button>
                    </div>
                    <hr class="hr-color" />
                    <form class="row g-3 needs-validation" novalidate>
                        <div class="col-md-4">
                            <label for="teacher_first_name" class="form-label"
                                ><img :src="icons.First_name" />&nbsp;First
                                name</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="teacher_first_name"
                                required
                                v-model="teacher.First_name"
                            />
                            <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                            <div class="invalid-feedback">
                                Please choose a fist name.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="teacher_last_name" class="form-label"
                                ><img :src="icons.Last_name" />&nbsp;Last
                                name</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="teacher_last_name"
                                required
                                v-model="teacher.Last_name"
                            />
                            <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                            <div class="invalid-feedback">
                                Please choose a last name.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="teacher_phone" class="form-label"
                                ><img :src="icons.Phone" />&nbsp;Phone</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="teacher_phone"
                                required
                                v-model="teacher.Phone"
                            />
                            <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                            <div class="invalid-feedback">
                                Please choose a phone.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="teacher_email" class="form-label"
                                ><img :src="icons.Email" />&nbsp;Email</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="teacher_email"
                                required
                                v-model="teacher.Email"
                            />
                            <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                            <div class="invalid-feedback">
                                Please choose a email.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="teacher_dob" class="form-label"
                                ><img :src="icons.Dob" />&nbsp;DOB</label
                            >
                            <input
                                type="date"
                                class="form-control"
                                id="teacher_dob"
                                required
                                v-model="teacher.Dob"
                            />
                            <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                            <div class="invalid-feedback">
                                Please choose a date of birth.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="teacher_country" class="form-label"
                                ><img
                                    :src="icons.Address"
                                />&nbsp;Country</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="teacher_country"
                                required
                                v-model="teacher.Country"
                            />
                            <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                            <div class="invalid-feedback">
                                Please choose a country.
                            </div>
                        </div>

                        <div class="col-12">
                            <button
                                class="btn btn-success"
                                @click.stop="addTeacher"
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
import {
    First_name,
    Last_name,
    Phone,
    Email,
    Dob,
    Address,
    Country,
    State,
} from "../../Assets/formIcons/index";
import { loginInfoStore } from "../../stores/loginInfo";
import { mapState } from "pinia";
export default {
    data() {
        return {
            current_teacher_id: "",
            current_user_id: "",
            dispaly_mode: "",
            teachers: [],
            icons: {
                First_name: First_name,
                Last_name: Last_name,
                Phone: Phone,
                Email: Email,
                Dob: Dob,
                Address: Address,
                Country: Country,
                State: State,
            },
            teacher: {
                First_name: "",
                Last_name: "",
                Phone: "",
                Email: "",
                Dob: "",
                Country: "",
            },
        };
    },
    props: {
        mode: String,
    },
    computed: {
        ...mapState(loginInfoStore, ["getLoginInfo"]),
    },
    methods: {
        editTeacher(tec) {
            this.current_teacher_id = tec.id;
            this.current_user_id = tec.user_id;
            this.dispaly_mode = "edit-teacher";
            this.teacher = {
                First_name: tec.first_name,
                Last_name: tec.last_name,
                Phone: tec.phone,
                Email: tec.email,
                Dob: this.dateFormater(tec.dob),
                Country: tec.country,
            };
        },
        deleteTeacher(teacher) {
            this.current_teacher_id = teacher.id;
            this.deleteAlert(this.current_teacher_id, "teacher");
        },
        async confirmDeleteTeacher(teacher_id) {
            let urlText = "teacher/" + teacher_id + "/delete";
            let deleteResponse = await this.delete(urlText);
            this.getTeachers();
        },
        callBack() {
            this.save();
        },
        addTeacher() {
            this.checkValidation(this.callBack);
        },
        async save() {
            let formData = new FormData();
            formData.append("user_info[first_name]", this.teacher.First_name);
            formData.append("user_info[last_name]", this.teacher.Last_name);
            formData.append("user_info[role]", "teacher");
            formData.append("user_info[password]", "1234");
            formData.append("user_info[email]", this.teacher.Email);

            formData.append("teacher_info[phone]", this.teacher.Phone);
            formData.append("teacher_info[dob]", this.teacher.Dob);
            formData.append(
                "teacher_info[full_name]",
                this.teacher.First_name + " " + this.teacher.Last_name
            );
            formData.append("teacher_info[country]", this.teacher.Country);
            if (this.dispaly_mode == "edit-teacher") {
                formData.append("user_extra_info[mode]", "edit");
                formData.append(
                    "user_extra_info[current_user_id]",
                    this.current_user_id
                );
                formData.append(
                    "user_extra_info[current_teacher_id]",
                    this.current_teacher_id
                );
            } else {
                formData.append("user_extra_info[mode]", "new-record");
            }

            let postResponse = {};
            let urlText = "addTeacher";

            postResponse = await this.post(urlText, formData);
            this.teacher = {
                First_name: "",
                Last_name: "",
                Phone: "",
                Email: "",
                Dob: "",
                Country: "",
            };
            if (this.dispaly_mode == "edit-teacher") {
                this.getTeachers();
            } else {
                this.$router.push({ name: "teacher" });
            }
        },
        async getTeachers() {
            let urlText = "";
            let getResponse = [];

            if (this.getLoginInfo.user.role == "student") {
                urlText =
                    "student/" + this.getLoginInfo.student_info.id + "/teacher";
                getResponse = await this.get(urlText, 1, false);
            } else {
                urlText = "getTeachers";
                getResponse = await this.get(urlText, 0, false);
            }

            this.teachers = getResponse.data.data;

            if (this.dispaly_mode == "edit-teacher") {
                this.dispaly_mode = "fetch-teachers";
            }
        },
    },
    mounted() {
        this.dispaly_mode = this.mode;
        this.getTeachers();
    },
};
</script>

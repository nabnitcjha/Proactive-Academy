<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" v-if="mode == 'fetch-students'">
                <div class="card-body">
                    <div class="add-item">
                        <h5 class="card-title">Student List</h5>
                        <button
                            type="button"
                            class="btn btn-add"
                            @click.stop="$root.changeRoute('/add-student')"
                            v-if="getLoginInfo.user.role == 'admin'"
                        >
                            <i class="bi bi-plus"></i> ADD STUDENT
                        </button>
                    </div>
                    <hr class="hr-color" />
                    <table class="table table-hover user-list">
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
                                    Teacher
                                </th>
                                <th scope="col">Parent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(std, index) in students" :key="index">
                                <th scope="row">{{ index + 1 }}</th>
                                <td
                                    @click.stop="
                                        $root.changeRoute(
                                            '/student/' + std.id + '/detail'
                                        )
                                    "
                                >
                                    {{ std.full_name }}
                                </td>
                                <td
                                    @click.stop="
                                        $root.changeRoute(
                                            '/student/' + std.id + '/detail'
                                        )
                                    "
                                >
                                    {{ std.email }}
                                </td>
                                <td
                                    @click.stop="
                                        $root.changeRoute(
                                            '/student/' + std.id + '/detail'
                                        )
                                    "
                                >
                                    {{ std.phone }}
                                </td>
                                <td
                                    @click.stop="
                                        $root.changeRoute(
                                            '/student/' + std.id + '/detail'
                                        )
                                    "
                                >
                                    <b-list-group>
                                        <b-list-group-item
                                            v-for="sb in std.subject"
                                            :key="sb.id"
                                            v-if="checkSubject(sb)"
                                            >{{ sb.name }}</b-list-group-item
                                        >
                                    </b-list-group>
                                </td>
                                <td
                                    @click.stop="
                                        $root.changeRoute(
                                            '/student/' + std.id + '/detail'
                                        )
                                    "
                                    v-if="getLoginInfo.user.role == 'admin'"
                                >
                                    <b-list-group>
                                        <b-list-group-item
                                            v-for="tec in std.teacher"
                                            :key="tec.id"
                                            >{{
                                                tec.full_name
                                            }}</b-list-group-item
                                        >
                                    </b-list-group>
                                </td>
                                <td
                                    @click.stop="
                                        $root.changeRoute(
                                            '/student/' + std.id + '/detail'
                                        )
                                    "
                                >
                                    <b-list-group>
                                        <b-list-group-item
                                            v-for="gu in std.guardian"
                                            :key="gu.id"
                                            >{{
                                                gu.full_name
                                            }}</b-list-group-item
                                        >
                                    </b-list-group>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card" v-else>
                <div class="card-body">
                    <div class="add-item">
                        <h5 class="card-title">Student Info</h5>
                        <button
                            type="button"
                            class="btn btn-back"
                            @click.stop="$router.go(-1)"
                            v-if="$route.name == 'addStudent'"
                        >
                            BACK
                        </button>
                    </div>
                    <hr class="hr-color" />
                    <form class="row g-3 needs-validation" novalidate>
                        <div class="col-md-4">
                            <label for="student_first_name" class="form-label"
                                ><img :src="icons.First_name" />&nbsp;First
                                name</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="student_first_name"
                                required
                                v-model="student.First_name"
                            />
                            <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                            <div class="invalid-feedback">
                                Please choose a fist name.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="student_last_name" class="form-label"
                                ><img :src="icons.Last_name" />&nbsp;Last
                                name</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="student_last_name"
                                required
                                v-model="student.Last_name"
                            />
                            <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                            <div class="invalid-feedback">
                                Please choose a last name.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="student_phone" class="form-label"
                                ><img :src="icons.Phone" />&nbsp;Phone</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="student_phone"
                                required
                                v-model="student.Phone"
                            />
                            <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                            <div class="invalid-feedback">
                                Please choose a phone.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="student_email" class="form-label"
                                ><img :src="icons.Email" />&nbsp;Email</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="student_email"
                                required
                                v-model="student.Email"
                            />
                            <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                            <div class="invalid-feedback">
                                Please choose a email.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="Student_dob" class="form-label"
                                ><img :src="icons.Dob" />&nbsp;DOB</label
                            >
                            <input
                                type="date"
                                class="form-control"
                                id="Student_dob"
                                required
                                v-model="student.Dob"
                            />
                            <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                            <div class="invalid-feedback">
                                Please choose a date of birth.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="student_country" class="form-label"
                                ><img
                                    :src="icons.Address"
                                />&nbsp;Country</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="student_country"
                                required
                                v-model="student.Country"
                            />
                            <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                            <div class="invalid-feedback">
                                Please choose a country.
                            </div>
                        </div>
                        <h5 class="add-parent-title card-title ml-3">
                            Parent Info
                        </h5>
                        <hr class="hr-parent ml-3" />
                        <!-- Parent Info Start -->
                        <div
                            class="parent-info col-12"
                            v-for="(input, index) in dynamicParentList"
                            :key="index"
                        >
                            <div class="col-md-4">
                                <label
                                    for="parent_first_name"
                                    class="form-label"
                                    ><img :src="icons.First_name" />&nbsp;First
                                    name</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="parent_first_name"
                                    required
                                    v-model="input.First_name"
                                    @change="
                                        changeField(
                                            $event,
                                            'first_name',
                                            input.parent_id
                                        )
                                    "
                                />
                                <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                                <div class="invalid-feedback">
                                    Please choose a fist name.
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="parent_last_name" class="form-label"
                                    ><img :src="icons.Last_name" />&nbsp;Last
                                    name</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="parent_last_name"
                                    required
                                    v-model="input.Last_name"
                                    @change="
                                        changeField(
                                            $event,
                                            'last_name',
                                            input.parent_id
                                        )
                                    "
                                />
                                <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                                <div class="invalid-feedback">
                                    Please choose a last name.
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="parent_phone" class="form-label"
                                    ><img
                                        :src="icons.Phone"
                                    />&nbsp;Phone</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="parent_phone"
                                    required
                                    v-model="input.Phone"
                                    @change="
                                        changeField(
                                            $event,
                                            'phone',
                                            input.parent_id
                                        )
                                    "
                                />
                                <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                                <div class="invalid-feedback">
                                    Please choose a phone.
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="parent_email" class="form-label"
                                    ><img
                                        :src="icons.Email"
                                    />&nbsp;Email</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="parent_email"
                                    required
                                    v-model="input.Email"
                                    @change="
                                        changeField(
                                            $event,
                                            'email',
                                            input.parent_id
                                        )
                                    "
                                />
                                <!-- <div class="valid-feedback">
                Looks good!
              </div> -->
                                <div class="invalid-feedback">
                                    Please choose a email.
                                </div>
                            </div>
                            <div
                                class="col-md-4 add-guardian"
                                v-if="index == 0"
                            >
                                Add Guardians &nbsp;
                                <i
                                    class="bi bi-plus-circle add-guardian-icon"
                                    style="color: #8bc34a"
                                    @click.stop="addGuardian"
                                ></i>
                            </div>
                            <div class="col-md-4 remove-guardian" v-else>
                                Remove Guardians &nbsp;
                                <i
                                    class="bi bi-dash-circle remove-guardian-icon"
                                    style="color: red"
                                    @click.stop="removeParent(input.parent_id)"
                                ></i>
                            </div>
                            <div class="col-md-12 mt-4">
                                <hr class="hr-color" />
                            </div>
                        </div>
                        <!-- Parent Info End -->

                        <div class="col-12">
                            <button
                                class="btn btn-success"
                                @click.stop="addStudent"
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
            students: [],
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
            student: {
                First_name: "",
                Last_name: "",
                Phone: "",
                Email: "",
                Dob: "",
                Country: "",
            },
            dynamicParentList: [
                {
                    First_name: "",
                    Last_name: "",
                    Phone: "",
                    Email: "",
                    parent_id: 1,
                },
            ],
        };
    },
    props: {
        mode: String,
    },
    computed: {
        ...mapState(loginInfoStore, ["getLoginInfo"]),
    },
    mounted() {
        this.getStudents();
    },
    methods: {
        checkSubject(val) {
            let results = [];
            if (this.getLoginInfo.user.role == "teacher") {
                results = this.getLoginInfo.teacher_info.subject.filter(
                    (sub) => sub.name === val.name
                );
                if (results.length > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        },
        callBack() {
            this.save();
        },
        addStudent() {
            this.checkValidation(this.callBack);
        },
        async save() {
            let dynamic_parent_list = this.dynamicParentList.map((data) => {
                return {
                    first_name: data.First_name,
                    last_name: data.Last_name,
                    full_name: data.First_name + " " + data.Last_name,
                    role: "parent",
                    phone: data.Phone,
                    email: data.Email,
                    password: "1234",
                };
            });

            let formData = new FormData();
            formData.append("user_info[first_name]", this.student.First_name);
            formData.append("user_info[last_name]", this.student.Last_name);
            formData.append("user_info[role]", "student");
            formData.append("user_info[password]", "1234");
            formData.append("user_info[email]", this.student.Email);

            formData.append("student_info[phone]", this.student.Phone);
            formData.append("student_info[dob]", this.student.Dob);
            formData.append(
                "student_info[full_name]",
                this.student.First_name + " " + this.student.Last_name
            );
            formData.append("student_info[country]", this.student.Country);

            formData.append("parent_info", JSON.stringify(dynamic_parent_list));

            let postResponse = {};
            let urlText = "addStudent";

            postResponse = await this.post(urlText, formData);
            this.student = {};
            this.dynamicParentList = [
                {
                    First_name: "",
                    Last_name: "",
                    Phone: "",
                    Email: "",
                    parent_id: 1,
                },
            ];
            this.$router.push({ name: "student" });
        },
        changeField(event, type, parent) {
            let dynamicParentList = [...this.dynamicParentList];
            let item = dynamicParentList.find(
                (parentItem) => parentItem.parent_id === parent
            );
            let updatedItem = {
                ...item,
                type: event.target.value,
            };

            item = updatedItem;
            this.dynamicParentList = dynamicParentList;
        },
        addGuardian() {
            let dynamicList = [...this.dynamicParentList];
            dynamicList.push({
                parent_id: this.dynamicParentList.length + 1,
                first_name: "",
                last_name: "",
                phone: "",
                email: "",
            });
            this.dynamicParentList = dynamicList;
        },
        removeParent(parent_id) {
            this.dynamicParentList = this.dynamicParentList.filter(
                (parentItem) => parentItem.parent_id !== parent_id
            );
        },
        async getStudents() {
            if (this.getLoginInfo.user.role == "parent") {
                this.students = this.getLoginInfo.student_info;
            } else {
                let urlText = "";

                if (this.getLoginInfo.user.role == "teacher") {
                    urlText =
                        "teacher/" +
                        this.getLoginInfo.teacher_info.id +
                        "/student";
                } else {
                    urlText = "getStudents/false";
                }
                let getResponse = await this.get(urlText, 1, false);
                this.students = getResponse.data.data;
            }
        },
    },
};
</script>

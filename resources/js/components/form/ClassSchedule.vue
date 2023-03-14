<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" v-if="mode == 'fetch-classes'">
                <div class="card-body">
                    <div class="add-item">
                        <h5 class="card-title">Class List</h5>
                        <button
                            type="button"
                            class="btn btn-add"
                            @click.stop="
                                $root.changeRoute('/add/class-schedule')
                            "
                        >
                            <i class="bi bi-plus"></i> ADD CLASS
                        </button>
                    </div>
                    <hr class="hr-color" />
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Topic</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Teacher</th>
                                <th scope="col">Student</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr  v-for="(sort_cls, index) in sorted_class" :key="index">
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ sort_cls.topic }}</td>
                                <td>{{ sort_cls.duration }}</td>
                                <td>{{ sort_cls.subject.name }}</td>
                                <td>{{ sort_cls.teacher.full_name }}</td>
                                <td>
                                    <b-list-group>
                                        <b-list-group-item  v-for="stu in sort_cls.students" :key="stu.id">{{ stu.full_name }}</b-list-group-item>
                                    </b-list-group>
                                </td>
                                <td class="align-middle">
                                    <i
                                        class="bi bi-trash hand ml-2"
                                        @click.stop="deleteClassSchedule(sort_cls)"
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
                        <h5 class="card-title">Class Schedule</h5>
                        <button
                            type="button"
                            class="btn btn-back"
                            @click.stop="$router.go(-1)"
                        >
                            BACK
                        </button>
                    </div>
                    <form class="row g-3 needs-validation" novalidate>
                        <div class="col-md-4">
                            <label for="topic" class="form-label">Topic</label>
                            <input
                                type="text"
                                class="form-control"
                                id="topic"
                                required
                                v-model="topic"
                            />
                        </div>

                        <div class="col-md-4">
                            <label for="subject" class="form-label"
                                >Subject</label
                            >
                            <multiselect
                                v-model="selectedSubject"
                                :options="subjects"
                                :searchable="true"
                                :close-on-select="false"
                                :allow-empty="false"
                                :preselect-first="true"
                                label="name"
                                placeholder="Select Subject"
                                track-by="id"
                            >
                            </multiselect>
                        </div>

                        <div class="col-md-4">
                            <label for="teacher" class="form-label"
                                >Teacher</label
                            >
                            <multiselect
                                v-model="selectedTeacher"
                                :options="teachers"
                                :searchable="true"
                                :close-on-select="false"
                                :allow-empty="false"
                                :preselect-first="true"
                                label="name"
                                placeholder="Select Teacher"
                                track-by="id"
                            ></multiselect>
                        </div>

                        <div class="col-md-4">
                            <label for="student" class="form-label"
                                >Student</label
                            >
                            <multiselect
                                v-model="selectedStudent"
                                :options="students"
                                :searchable="true"
                                :multiple="true"
                                :close-on-select="false"
                                :allow-empty="false"
                                :preselect-first="true"
                                label="name"
                                placeholder="Select Student"
                                track-by="id"
                            ></multiselect>
                        </div>

                        <div class="col-md-4 flex-column">
                            <label for="start_date" class="form-label"
                                >Start Date</label
                            >
                            <date-picker
                                v-model="classStartDate"
                                type="date"
                                placeholder="Select date"
                                format="YYYY-MM-DD"
                                :default-value="new Date()"
                                :disabled-date="disabledBeforeToday"
                            ></date-picker>
                        </div>

                        <div class="col-md-4 flex-column">
                            <label for="start_time" class="form-label"
                                >Start Time</label
                            >
                            <date-picker
                                v-model="classStartTime"
                                type="time"
                                placeholder="start time"
                                format="hh:mm a"
                                :default-value="new Date()"
                                :disabled-date="disabledBeforeToday"
                            ></date-picker>
                        </div>

                        <div class="col-md-4 flex-column">
                            <label for="end_time" class="form-label"
                                >End Time</label
                            >
                            <date-picker
                                v-model="classEndTime"
                                type="time"
                                placeholder="end time"
                                format="hh:mm a"
                                :default-value="new Date()"
                                :disabled-date="disabledBeforeToday"
                            ></date-picker>
                        </div>

                        <div class="col-md-12">
                            <label for="repeat" class="form-label"
                                >Repeat</label
                            >
                            <div style="border: 1px solid #4e4e4e57">
                                <div
                                    class="week-days col-12 d-flex justify-content-between p-5"
                                >
                                    <div
                                        class=""
                                        v-for="(day, index) in weekDays"
                                        :key="index"
                                    >
                                        <input
                                            style="position: inherit"
                                            type="checkbox"
                                            class="custom-control-input"
                                            :id="index"
                                            :checked="
                                                repeatDays.includes(day.id)
                                            "
                                            @click="
                                                selectRepeatDays(
                                                    $event,
                                                    day.id,
                                                    day,
                                                    index
                                                )
                                            "
                                        />
                                        <label
                                            class="custom-control-label"
                                            :for="index"
                                            >{{ day.name }}</label
                                        >
                                    </div>
                                </div>
                                <div class="session-repeat col-4 p-5">
                                    <label for="repeat">Session Repeat</label>
                                    <input
                                        class="input-custom-height col-3"
                                        type="number"
                                        v-model="sessionRepeat"
                                        min="1"
                                        max="100"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <textarea
                                class="form-control"
                                rows="5"
                                id="topicName"
                                placeholder="Description"
                                v-model="event_message"
                            ></textarea>
                        </div>

                        <div class="col-12">
                            <button
                                type="button"
                                class="btn btn-success"
                                @click="addTimeTableRecord"
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

<script>
import moment from "moment";
export default {
    data() {
        return {
            current_unique_id:'',
            sorted_class:[],
            currentTimetableId: "",
            studentCalendarDetail: false,
            allowAddStudent: false,
            allowAddTeacher: false,
            currentTeacherId: "",
            editSessionId: "",
            repeatDays: [],
            sessionRepeat: 1,
            weekDays: [
                { id: 0, name: "Sun" },
                { id: 1, name: "Mon" },
                { id: 2, name: "Tue" },
                { id: 3, name: "Wed" },
                { id: 4, name: "Thu" },
                { id: 5, name: "Fri" },
                { id: 6, name: "Sat" },
            ],

            topic: "",
            subjects: [],
            event_message: "",
            students: [],
            selectedSubject: [],
            grades: [],
            selectedGrade: [],
            teachers: [],
            slotTimes: [],
            selectedTeacher: [],
            selectedStudent: [],
            classStartDate: "",
            classEndDate: "",
            classStartTime: "",
            classEndTime: "",
            repeatLastDate: new Date(),
            disabledDates: {
                to: new Date(Date.now() - 8640000),
            },
        };
    },
    props: {
        mode: String,
    },
    methods: {
        deleteClassSchedule(sort_cls) {
            this.current_unique_id = sort_cls.class_unique_id;
            this.deleteAlert(this.current_unique_id,'class-schedule');
        },
        async confirmDeleteClassSchedul(unique_id){
            let urlText = 'timetable/'+unique_id+'/delete';
            let deleteResponse = await this.delete(urlText);
            this.initialCall();
        },
        disabledBeforeToday(date) {
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            return date < today;
        },

        selectRepeatDays(event, day) {
            if (event.target.checked) {
                let days = [...this.repeatDays];
                days.push(day);
                this.repeatDays = days;
            } else {
                let days = [...this.repeatDays];
                let items = days.filter((dayName) => dayName !== day);
                this.repeatDays = items;
            }
        },

        async getStudents() {
            let urlText = "getStudents";

            let stuRec = await this.get(urlText);
            this.students = stuRec.data.data.map((data) => {
                return {
                    id: data.id,
                    name: data.full_name,
                };
            });
        },

        async getSubjects() {
            let urlText = "getSubjects";

            let subRec = await this.get(urlText);
            this.subjects = subRec.data.data.map((data) => {
                return {
                    id: data.id,
                    name: data.name,
                };
            });
        },

        async getTeachers() {
            let urlText = "getTeachers";

            let tecRec = await this.get(urlText);
            this.teachers = tecRec.data.data.map((data) => {
                return {
                    id: data.id,
                    name: data.full_name,
                };
            });
        },

        async addTimeTableRecord(e) {
            e.preventDefault();

            let slotTimes = [...this.slotTimes];
            let repeatDays = this.sessionRepeat * 7;
            var startDate = new Date();
            var endDate = new Date();
            var startTime = new Date();
            var endTime = new Date();

            startDate = this.dateFormater(this.classStartDate);

            endDate = this.dateFormater(this.classStartDate);

            this.repeatLastDate.setDate(
                this.classStartDate.getDate() + repeatDays
            );

            var class_end_date = this.dateFormater(this.repeatLastDate);
            var duration = startDate + " - " + class_end_date;

            startTime = this.timeFormater(this.classStartTime);
            endTime = this.timeFormater(this.classEndTime);

            startDate = this.timeAndDate(startDate, startTime);
            endDate = this.timeAndDate(endDate, endTime);

            slotTimes.push({
                startDate: startDate,
                endDate: endDate,
                duration: duration.toString(),
            });

            let strtDate = this.classStartDate.setDate(
                this.classStartDate.getDate() + 1
            );
            this.classStartDate = new Date(strtDate);

            this.classEndDate = new Date(strtDate);

            while (this.classStartDate <= this.repeatLastDate) {
                let day = this.classStartDate.getDay();

                if (this.repeatDays.indexOf(day) !== -1) {
                    let startDate = this.dateFormater(this.classStartDate);

                    let endDate = this.dateFormater(this.classEndDate);

                    startDate = this.timeAndDate(startDate, startTime);
                    endDate = this.timeAndDate(endDate, endTime);

                    slotTimes.push({
                        startDate: startDate,
                        endDate: endDate,
                        duration: duration.toString(),
                    });
                }

                let stDate = this.classStartDate.setDate(
                    this.classStartDate.getDate() + 1
                );
                let eDate = this.classEndDate.setDate(
                    this.classEndDate.getDate() + 1
                );
                this.classStartDate = new Date(stDate);
                this.classEndDate = new Date(eDate);
            }

            this.slotTimes = slotTimes;

            let formData = new FormData();
            formData.append(
                "class_schedule_info[subject_id]",
                this.selectedSubject.id
            );
            formData.append(
                "class_schedule_info[teacher_id]",
                this.selectedTeacher.id
            );
            formData.append(
                "class_student_info[students]",
                JSON.stringify(this.selectedStudent)
            );
            formData.append("class_schedule_info[topic]", this.topic);
            formData.append(
                "class_slot_info[slotTimes]",
                JSON.stringify(this.slotTimes)
            );
            formData.append(
                "class_schedule_info[description]",
                this.event_message
            );
            formData.append(
                "class_schedule_info[selected_day]",
                JSON.stringify(this.repeatDays)
            );
            formData.append(
                "class_schedule_info[class_repeat]",
                this.sessionRepeat
            );

            let postResponse = {};
            let urlText = "addTimetable";
            postResponse = await this.post(urlText, formData);
            if (postResponse.data.status=='failed') {
                let msg = postResponse.data.message
                let htmlDate = '<span class="html-date mb-2">'+' <b>Date  : </b>'+' '+'<span class="highlight-green">'+postResponse.data.not_available_date+'</span>'+'</span>';
                let htmlDay = '<span class="html-day mb-2">'+' <b>Day : </b>'+' '+'<span class="highlight-orange">'+postResponse.data.dayName+'</span>'+'</span>';
                let htmlTime = '<span class="html-time">'+' <b>Time : </b>'+' '+'<span class="highlight-yellow">'+postResponse.data.not_available_time+'</span>'+'</span>';
                let htmlMsg = htmlDate +'<br>'+ htmlDay +'<br>'+ htmlTime +'<br>'
                this.classErrorAlert(msg,htmlMsg);
            } else {
                this.saveAlert('class save successfully');
                this.slotTimes = [];
                this.$router.push({ name: "classSchedule" });
            }
            
        },
        async sortedClass() {
            let urlText = "admin/sortedClass";

            let getResponse = await this.get(urlText, 1, false);

            this.sorted_class = getResponse.data.data;
        },
        initialCall() {
            this.getStudents();
            this.getSubjects();
            this.getTeachers();
            this.sortedClass();
        },
    },
    mounted() {
        this.initialCall();
    },
};
</script>
<style>
.timeTable .v-application--wrap {
    min-height: unset !important;
}
</style>

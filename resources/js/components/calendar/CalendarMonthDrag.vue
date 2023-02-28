<template>
    <v-sheet height="600">
        <v-calendar
            ref="monthCalendar"
            v-model="value"
            color="primary"
            type="month"
            :events="events"
            :event-color="getEventColor"
            :event-ripple="false"
            @change="getEvents"
            @click:event="showEvent"
            @click:more="viewDay"
            @click:date="viewDay"
            @mousedown:event="startDrag"
            @mousedown:day="startTime"
            @mousemove:day="mouseMove"
            @mouseup:day="endDrag"
            @mouseleave.native="cancelDrag"
        >
            <template v-slot:event="{ event, timed, eventSummary }">
                <!-- <div class="v-event-draggable">
          <component :is="{ render: eventSummary }"></component>
        </div> -->

                <div
                    v-if="timed"
                    class="v-event-drag-bottom"
                    @mousedown.stop="extendBottom(event)"
                ></div>
                <div class="custom-p">
                    <button
                        type="button"
                        data-bs-toggle="modal"
                        v-bind:data-bs-target="
                            '#' + 'monthDragModal' + current_teacher_id
                        "
                        @click="getSlotInfo(event)"
                    >
                        {{ event.name }}{{ " "
                        }}{{ dateAndTimeFormater(event.start) }}
                    </button>
                </div>
            </template>
        </v-calendar>
        <!-- modal start -->
        <div
            class="modal fade modal-tall slot-modal"
            v-bind:id="'monthDragModal' + current_teacher_id"
            tabindex="-1"
            aria-labelledby="monthDragModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="monthDragModalLabel">
                            Slot Detail
                        </h1>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <!-- start body -->
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between"
                            >
                                <span>Study Resources</span>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item study-resource">
                                    <div
                                        class="col-12 d-flex"
                                        v-if="checkPermission"
                                    >
                                        <label
                                            for="file"
                                            class="input input-file"
                                        >
                                            <div class="button">
                                                <input
                                                    id="study_resource"
                                                    type="file"
                                                    class="form-control form-control-sm"
                                                    name="file"
                                                    @change="handleResourceFile"
                                                />
                                                Browse File
                                            </div>
                                            <input
                                                type="text"
                                                class="form-control form-control-sm"
                                                placeholder="upload study resources"
                                                readonly=""
                                            />
                                        </label>
                                        <button
                                            type="button"
                                            class="btn btn-success cstm-btn"
                                            @click.stop="saveResourceFile"
                                        >
                                            save
                                        </button>
                                    </div>

                                    <div class="rs-file">
                                        {{ resourceFileName }}
                                    </div>
                                </li>

                                <li
                                    class="list-group-item d-flex justify-content-between"
                                    v-for="(rsf, index) in resource_file"
                                    :key="index"
                                    v-if="rsf && rsf.resourceFile != null"
                                    style="padding-bottom: 2rem"
                                >
                                    <span class="rs-file">{{
                                        rsf.resourceFile.original_filename
                                    }}</span>
                                    <div class="d-flex action mr-4">
                                        <i
                                            class="bi bi-download hand"
                                            @click.stop="
                                                downloadFile(
                                                    rsf.resourceFile.id
                                                )
                                            "
                                        ></i>
                                        <i
                                            class="bi bi-trash hand ml-2"
                                            v-if="checkPermission"
                                            @click.stop="
                                                deleteStudyResource(
                                                    rsf.resourceFile.id
                                                )
                                            "
                                        ></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between"
                            >
                                <span>Assignment</span>
                            </div>
                            <div>
                                <li class="list-group-item assignment">
                                    <div
                                        class="col-12 d-flex"
                                        v-if="checkPermission"
                                    >
                                        <label
                                            for="assignment_file"
                                            class="input input-file"
                                        >
                                            <div class="button">
                                                <input
                                                    id="assignment_file"
                                                    type="file"
                                                    class="form-control form-control-sm"
                                                    name="assignment_file"
                                                    @change="
                                                        handleAssignmentFile
                                                    "
                                                />
                                                Browse File
                                            </div>
                                            <input
                                                type="text"
                                                class="form-control form-control-sm"
                                                placeholder="upload assignment"
                                                readonly=""
                                            />
                                        </label>
                                        <button
                                            type="button"
                                            class="btn btn-success cstm-btn"
                                            @click.stop="saveAssignmentFile"
                                        >
                                            Save
                                        </button>
                                    </div>
                                    <span class="rs-file">{{
                                        assignmentFileName
                                    }}</span>
                                </li>
                            </div>
                            <table class="card-table table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Answer</th>
                                        <th scope="col">Assignment Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(rsf, index) in resource_file"
                                        :key="index"
                                        v-if="rsf.resourceFile != null"
                                    >
                                        <td class="td-rs-file">
                                            {{
                                                rsf.resourceFile
                                                    .original_filename
                                            }}
                                        </td>
                                        <td
                                            v-if="
                                                getLoginInfo.user.role ==
                                                'teacher'
                                            "
                                        >
                                            <span
                                                v-if="
                                                    rsf.assignment_answer == ''
                                                "
                                                >{{ "not available" }}</span
                                            >
                                            <i
                                                class="bi bi-download hand"
                                                @click.stop="
                                                    downloadFile(
                                                        rsf.assignment_answer.id
                                                    )
                                                "
                                                v-else
                                            ></i>
                                        </td>
                                        <td v-else>
                                            <i
                                                class="bi bi-upload hand"
                                                @click.stop="
                                                    uploadAssignmentAnswer(
                                                        rsf.resourceFile.id
                                                    )
                                                "
                                                v-if="
                                                    rsf.assignment_answer ==
                                                        '' &&
                                                    getLoginInfo.user.role ==
                                                        'student'
                                                "
                                            ></i>

                                            <span
                                                v-else-if="
                                                    rsf.assignment_answer ==
                                                        '' &&
                                                    getLoginInfo.user.role ==
                                                        'parent'
                                                "
                                                >{{ "not available" }}</span
                                            >
                                            <i
                                                class="bi bi-download hand"
                                                @click.stop="
                                                    downloadFile(
                                                        rsf.assignment_answer.id
                                                    )
                                                "
                                                v-else
                                            ></i>
                                            <label
                                                for="assignment_file_answer"
                                                id="assignment_file_answer-label"
                                            >
                                            </label>
                                            <input
                                                id="assignment_file_answer"
                                                type="file"
                                                class="form-control form-control-sm"
                                                name="assignment_file_answer"
                                                @change="
                                                    handleAssignmentFileAnswer
                                                "
                                                style="visibility: hidden"
                                            />
                                        </td>
                                        <td>
                                            <i
                                                class="bi bi-download hand"
                                                @click.stop="
                                                    downloadFile(
                                                        rsf.resourceFile.id
                                                    )
                                                "
                                            ></i>
                                            <i
                                                class="bi bi-trash hand"
                                                @click.stop="
                                                    deleteStudyResource(
                                                        rsf.resourceFile.id
                                                    )
                                                "
                                                v-if="checkPermission"
                                            ></i>
                                        </td>
                                    </tr>
                                    <tr
                                        v-if="
                                            resource_file &&
                                            resource_file.length < 1
                                        "
                                    >
                                        <span>no record found</span>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between"
                            >
                                <span>Zoom Link</span>
                            </div>
                            <ul
                                class="list-group list-group-flush"
                                v-if="checkPermission"
                            >
                                <div
                                    class="form-group col-sm-12 col-lg-12 d-flex justify-content-between"
                                >
                                    <label
                                        for="file"
                                        class="input input-file zoom-link d-flex"
                                        style="width: inherit"
                                    >
                                        <input
                                            v-model="zoom_link"
                                            type="text"
                                            id="zoom_link"
                                            class="form-control form-control-sm remove-border"
                                            placeholder="add zoom link"
                                            @input="savezoom_link"
                                        />
                                        <i
                                            class="bi bi-clipboard"
                                            @click.stop="copyzoom_link"
                                        ></i>
                                    </label>
                                    <button
                                        type="button"
                                        class="btn btn-success cstm-btn"
                                        @click.stop="openLink"
                                    >
                                        Go
                                    </button>
                                    <!-- <div class="zoom-link col-6">
                                        <input
                                            v-model="zoom_link"
                                            type="text"
                                            class="form-control remove-border"
                                            id="zoom_link"
                                            placeholder="add link"
                                            @input="savezoom_link"
                                        />
                                        <i
                                            class="bi bi-clipboard"
                                            @click.stop="copyzoom_link"
                                        ></i>
                                    </div>
                                    <div class="col-4">
                                        <button
                                            class="btn btn-warning btn-session pointer-hand col-12 mt-2 mx-auto go-to-link cstm-btn"
                                            @click.stop="openLink"
                                        >
                                            Go
                                        </button>
                                    </div> -->
                                </div>
                            </ul>
                            <ul class="list-group list-group-flush" v-else>
                                <div
                                    class="form-group col-sm-12 col-lg-12 d-flex"
                                >
                                    <div class="zoom-link">
                                        <input
                                            v-model="zoom_link"
                                            type="text"
                                            class="form-control remove-border"
                                            id="zoom_link"
                                            placeholder="add link"
                                            readonly
                                        />
                                        <i
                                            class="bi bi-clipboard"
                                            @click.stop="copyzoom_link"
                                        ></i>
                                    </div>
                                    <button
                                        class="btn btn-warning btn-session pointer-hand col-3 mt-2 mx-auto go-to-link cstm-btn"
                                        @click.stop="openLink"
                                    >
                                        Go
                                    </button>
                                </div>
                            </ul>
                        </div>
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between"
                            >
                                <span>Completed Class Video</span>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"></li>
                            </ul>
                        </div>
                        <!-- end body -->
                    </div>

                    <div class="modal-footer invisible">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal end -->
    </v-sheet>
</template>
<script>
import { loginInfoStore } from "../../stores/loginInfo";
import { mapState } from "pinia";
import moment from "moment";
export default {
    data: () => ({
        assessment_file_answer: "",
        checkPermission: true,
        rightSidebar: false,
        userType: "",
        isStudent: false,
        isTeacher: false,
        currentMonthName: "",
        selectedOpen: false,
        selectedEvent: {},
        selectedElement: null,
        dragAttempt: 0,
        type: "month",
        value: "",
        events: [],
        colors: ["#4CAF50", "#FF9800", "#757575"],
        names: [
            "Meeting",
            "Holiday",
            "PTO",
            "Travel",
            "Event",
            "Birthday",
            "Conference",
            "Party",
        ],
        dragEvent: null,
        dragStart: null,
        createEvent: null,
        createStart: null,
        extendOriginal: null,
        assessment_file: "",
        current_timetable_id: "",
        current_slot_unique_id: "",
        currentTeacherId: "",
        resourceFileName: "",
        assignmentFileName: "",
        assignmentAnswerFileName: "",
        resource_file: [],
        resource_id: "",
        selected_assessment_id: "",
        click_on_slot:false
    }),
    props: {
        current_teacher_id: String,
        current_student_id: String,
        calType: String,
        unique_id: String,
    },

    computed: {
        ...mapState(loginInfoStore, ["getLoginInfo"]),
    },

    methods: {
        uploadAssignmentAnswer(id) {
            this.selected_assessment_id = id;
            document.getElementById("assignment_file_answer-label").click();
        },
        getSlotInfo(slot) {
            this.click_on_slot=true;
        },
        deleteSlot() {
            this.$emit("delete-slot");
        },
        calendarTitle() {
            this.$emit("calendar-title", this.$refs.monthCalendar);
        },
        viewDay({ date }) {
            this.$emit("view-day", date);
        },
        startClass() {
            this.$emit("start-class");
        },
        openDetailModel() {
            this.$emit("open-detail-model");
        },
        closeModel() {
            this.$emit("close-model");
        },
        sendEmail() {
            this.$emit("send-email");
        },
        openEdit() {
            this.$emit("open-edit");
        },

        showEvent({ nativeEvent, event }) {
            this.current_slot_unique_id = event.class_unique_id;
            this.current_timetable_id = event.id;
            this.currentTeacherId = event.teacher_id;
            this.zoom_link = event.zoom_link;
            this.getResourceFile();
            this.$emit("current-zoom-link", event);
            const open = () => {
                this.selectedEvent = event;
                this.selectedElement = nativeEvent.target;
                requestAnimationFrame(() =>
                    requestAnimationFrame(() => (this.selectedOpen = true))
                );
            };
            if (this.selectedOpen) {
                this.selectedOpen = false;
                requestAnimationFrame(() =>
                    requestAnimationFrame(() => open())
                );
            } else {
                open();
            }

            nativeEvent.stopPropagation();
        },
        changeType(val) {
            this.$emit("change-type", val);
        },
        startDrag({ event, timed }) {
            if (event && !timed) {
                //console.log("we are in")
                this.dragEvent = event;
                this.dragTime = null;
                this.extendOriginal = null;
            }
            if (this.dragAttempt > 0) {
            }
            if (this.dragAttempt == 0) {
                this.dragAttempt = 1;
            }
        },
        startTime(tms) {
            //  console.log("we are in",tms)
            const mouse = this.toTime(tms);

            if (this.dragEvent) {
                const start = this.dragEvent.start;
                this.dragTime = mouse - start;
            }
        },
        extendBottom(event) {
            this.createEvent = event;
            this.createStart = event.start;
            this.extendOriginal = event.end;
        },
        async mouseMove(tms) {
            const mouse = this.toTime(tms);
            if (this.dragEvent) {
                if (
                    this.getLoginInfo.user.role == "student" ||
                    this.getLoginInfo.user.role == "parent"
                ) {
                    this.errorAlert("Only Teacher / Admin Can Drag");
                } else {
                    const start = this.dragEvent.start;
                    const end = this.dragEvent.end;
                    const duration = end - start;
                    const newStartTime = mouse - this.dragTime;
                    const newStart = this.roundTime(newStartTime);
                    const newEnd = newStart + duration;
                    let todayDate = this.dateFormater(new Date());
                    let targetDate = this.dateFormater(new Date(newStart));

                    if (moment(targetDate).isBefore(todayDate)) {
                        this.isDisable = true;
                    } else {
                        this.isDisable = false;
                        this.dragEvent.start = new Date(newStart);
                        this.dragEvent.end = new Date(newEnd);
                    }
                }
            }
        },

        async endDrag() {
            if (!this.isDisable) {
                this.click_on_slot=false;
                let formData = {};
                let urlText = "timetable/" + this.dragEvent.id + "/drag";

                formData["id"] = this.dragEvent.id;
                formData["student_id"] = this.current_student_id;
                formData["teacher_id"] = this.current_teacher_id;
                formData["callType"] = this.calType;
                formData["unique_id"] = this.unique_id;
                formData["start_date"] = this.dateAndTimeFormater(
                    this.dragEvent.start
                );
                formData["end_date"] = this.dateAndTimeFormater(
                    this.dragEvent.end
                );
                
                if (
                    this.getLoginInfo.user.role == "teacher"
                ) {
                    let postResponse = await this.post(urlText, formData);
                    if (!this.click_on_slot) {
                        let res = this.slotAvailableOrNot(postResponse);
                        if (res=='failed') {
                            this.getSlots();
                        }
                    }
                    
                }

            }

            this.dragTime = null;
            this.dragEvent = null;
            this.createEvent = null;
            this.createStart = null;
            this.extendOriginal = null;
        },
        cancelDrag() {
            if (this.createEvent) {
                if (this.extendOriginal) {
                    this.createEvent.end = this.extendOriginal;
                } else {
                    const i = this.events.indexOf(this.createEvent);
                    if (i !== -1) {
                        this.events.splice(i, 1);
                    }
                }
            }

            this.createEvent = null;
            this.createStart = null;
            this.dragTime = null;
            this.dragEvent = null;
        },
        roundTime(time, down = true) {
            const roundTo = 15; // minutes
            const roundDownTime = roundTo * 60 * 1000;

            return down
                ? time - (time % roundDownTime)
                : time + (roundDownTime - (time % roundDownTime));
        },
        toTime(tms) {
            return new Date(
                tms.year,
                tms.month - 1,
                tms.day,
                tms.hour,
                tms.minute
            ).getTime();
        },
        getEventColor(event) {
            const rgb = parseInt(event.color.substring(1), 16);
            const r = (rgb >> 16) & 0xff;
            const g = (rgb >> 8) & 0xff;
            const b = (rgb >> 0) & 0xff;

            return event === this.dragEvent
                ? `rgba(${r}, ${g}, ${b}, 0.7)`
                : event === this.createEvent
                ? `rgba(${r}, ${g}, ${b}, 0.7)`
                : event.color;
        },
        async getEvents({ start, end }) {
            this.$emit("set-focus", this.value);
            const events = [];
            let getResponse = {};
            let urlText = "";
            if (this.calType == "student_all") {
                //student-detail class tab
                urlText = "student/" + this.current_student_id + "/class";
            } else if (this.calType == "teacher_all") {
                //teacher-detail class tab
                urlText = "teacher/" + this.current_teacher_id + "/class";
            } else if (this.calType == "class_according_unique_id") {
                urlText = "timetable/" + this.unique_id;
            } else {
                //teacher-detail student tab // or //student-detail teacher tab
                urlText =
                    "student/" +
                    this.current_student_id +
                    "/teacher/" +
                    this.current_teacher_id +
                    "/class";
            }
            getResponse = await this.get(urlText, 1, false);
            this.slots = getResponse.data.data;

            // this.slots =await this.slot_info;
            if (
                this.calType == "student_all" ||
                this.calType == "teacher_all"
            ) {
                this.slots.map((data) => {
                    events.push({
                        id: data.id,
                        name: data.topic,
                        color: this.colors[this.rnd(0, this.colors.length - 1)],
                        start: new Date(data.start_date),
                        end: new Date(data.end_date),
                        time: data.duration,
                        description: data.description,
                        zoom_link: data.zoom_link,
                        teacher_id: data.teacher.id,
                        student_id: this.current_student_id,
                        class_unique_id: data.class_unique_id,
                    });
                });
            } else {
                this.slots.map((data) => {
                    events.push({
                        id: data.id,
                        name: data.topic,
                        color: this.colors[this.rnd(0, this.colors.length - 1)],
                        start: new Date(data.start_date),
                        end: new Date(data.end_date),
                        time: data.duration,
                        description: data.description,
                        zoom_link: data.zoom_link,
                        teacher_id: this.current_teacher_id,
                        student_id: this.current_student_id,
                        class_unique_id: data.class_unique_id,
                    });
                });
            }

            this.events = events;
        },
        rnd(a, b) {
            return Math.floor((b - a + 1) * Math.random()) + a;
        },
        rndElement(arr) {
            return arr[this.rnd(0, arr.length - 1)];
        },
        async getSlots(){
            const events = [];
            let getResponse = {};
            let urlText = "";
            if (this.calType == "student_all") {
                //student-detail class tab
                urlText = "student/" + this.current_student_id + "/class";
            } else if (this.calType == "teacher_all") {
                //teacher-detail class tab
                urlText = "teacher/" + this.current_teacher_id + "/class";
            } else if (this.calType == "class_according_unique_id") {
                urlText = "timetable/" + this.unique_id;
            } else {
                //teacher-detail student tab // or //student-detail teacher tab
                urlText =
                    "student/" +
                    this.current_student_id +
                    "/teacher/" +
                    this.current_teacher_id +
                    "/class";
            }
            getResponse = await this.get(urlText, 1, false);
            this.slots = getResponse.data.data;

            // this.slots =await this.slot_info;
            if (
                this.calType == "student_all" ||
                this.calType == "teacher_all"
            ) {
                this.slots.map((data) => {
                    events.push({
                        id: data.id,
                        name: data.topic,
                        color: this.colors[this.rnd(0, this.colors.length - 1)],
                        start: new Date(data.start_date),
                        end: new Date(data.end_date),
                        time: data.duration,
                        description: data.description,
                        zoom_link: data.zoom_link,
                        teacher_id: data.teacher.id,
                        student_id: this.current_student_id,
                        class_unique_id: data.class_unique_id,
                    });
                });
            } else {
                this.slots.map((data) => {
                    events.push({
                        id: data.id,
                        name: data.topic,
                        color: this.colors[this.rnd(0, this.colors.length - 1)],
                        start: new Date(data.start_date),
                        end: new Date(data.end_date),
                        time: data.duration,
                        description: data.description,
                        zoom_link: data.zoom_link,
                        teacher_id: this.current_teacher_id,
                        student_id: this.current_student_id,
                        class_unique_id: data.class_unique_id,
                    });
                });
            }

            this.events = events;
        }
    },
    mounted() {
        this.checkRole();
        this.currentMonthName = this.$refs.monthCalendar.title;
        this.calendarTitle();
    },
};
</script>
<style>
.input-file {
    position: relative;
    display: block;
    font-weight: 400;
}

.input-file .button {
    position: absolute;
    top: 4px;
    right: 4px;
    float: none;
    height: 22px;
    margin: 0;
    padding: 0 14px;
    font-size: 13px;
    line-height: 22px;
    background-color: #3276b1;
    opacity: 0.8;
    transition: opacity 0.2s;
    -o-transition: opacity 0.2s;
    -ms-transition: opacity 0.2s;
    -moz-transition: opacity 0.2s;
    -webkit-transition: opacity 0.2s;
    outline: 0;
    border: 0;
    text-decoration: none;
    color: #fff;
    cursor: pointer;
}

.input-file .button input {
    position: absolute;
    top: 0;
    right: 0;
    padding: 0;
    font-size: 30px;
    cursor: pointer;
    opacity: 0;
}
.input input {
    display: block;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    width: 100%;
    height: 28px;
    padding: 8px 10px;
    outline: 0;
    border-width: 1px;
    border-style: solid;
    border-radius: 0;
    background: #fff;
    font: 13px/16px "Open Sans", Helvetica, Arial, sans-serif;
    color: #404040;
    appearance: normal;
    -moz-appearance: none;
    -webkit-appearance: none;
}
h1 {
    font-family: "Indie Flower", cursive;
    font-size: 32px;
    color: #03a9f4;
    font-weight: bold;
    margin-bottom: 20px;
}
</style>

<template>
    <fragment>
        <v-app>
            <v-row class="fill-height">
                <v-col>
                    <v-sheet height="64">
                        <v-toolbar flat>
                            <v-btn
                                outlined
                                class="mr-4"
                                color="grey darken-2"
                                @click.stop="setToday"
                            >
                                Today
                            </v-btn>
                            <v-spacer></v-spacer>
                            <v-btn
                                fab
                                text
                                small
                                color="grey darken-2"
                                @click.stop="prev"
                            >
                                <v-icon small> mdi-chevron-left </v-icon>
                            </v-btn>
                            <v-toolbar-title v-if="$refs.calendar">
                                {{ $refs.calendar.title }}
                            </v-toolbar-title>
                            <v-toolbar-title v-else>
                                {{ calendarTitle }}
                            </v-toolbar-title>
                            <v-btn
                                fab
                                text
                                small
                                color="grey darken-2"
                                @click.stop="next"
                            >
                                <v-icon small> mdi-chevron-right </v-icon>
                            </v-btn>

                            <v-spacer></v-spacer>
                            <v-menu bottom right>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn
                                        outlined
                                        color="grey darken-2"
                                        v-bind="attrs"
                                        v-on="on"
                                    >
                                        <span>{{ typeToLabel[type] }}</span>
                                        <v-icon right> mdi-menu-down </v-icon>
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item @click.stop="type = 'day'">
                                        <v-list-item-title
                                            >Day</v-list-item-title
                                        >
                                    </v-list-item>
                                    <v-list-item @click.stop="type = 'week'">
                                        <v-list-item-title
                                            >Week</v-list-item-title
                                        >
                                    </v-list-item>
                                    <v-list-item @click.stop="type = 'month'">
                                        <v-list-item-title
                                            >Month</v-list-item-title
                                        >
                                    </v-list-item>
                                    <v-list-item @click.stop="type = '4day'">
                                        <v-list-item-title
                                            >4 days</v-list-item-title
                                        >
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </v-toolbar>
                    </v-sheet>
                    <calendar-month-drag-component
                        v-if="type == 'month'"
                        :current_teacher_id="current_teacher_id"
                        :current_student_id="current_student_id"
                        :calType="calType"
                        :unique_id="unique_id"
                        @change-type="currentType"
                        @open-edit="openEdit"
                        @send-email="sendEmail"
                        @close-model="closeModel"
                        @open-detail-model="openDetailModel"
                        @view-day="monthViewDay"
                        @calendar-title="calTitle"
                        @set-focus="setFocus"
                        @calendar-today-title="calendarTodayTitle"
                        @start-class="startClass"
                        @current-zoom-link="saveCurrentzoom_link"
                        @delete-slot="deleteSlot"
                        :focus="focus"
                    ></calendar-month-drag-component>

                    <v-sheet height="600" v-else>
                        <v-calendar
                            ref="calendar"
                            v-model="focus"
                            color="primary"
                            :events="events"
                            :event-color="getEventColor"
                            :type="type"
                            @click:event="showEvent"
                            @click:more="viewDay"
                            @click:date="viewDay"
                            @change="updateRange"
                            @mousedown:event="startDrag"
                            @mousedown:time="startTime"
                            @mousemove:time="mouseMove"
                            @mouseup:time="endDrag"
                            @mouseleave.native="cancelDrag"
                        >
                            <template
                                v-slot:event="{ event, timed, eventSummary }"
                            >
                                <div class="v-event-draggable">
                                    <!-- <component
                                        :is="{ render: eventSummary }"
                                    ></component> -->
                                </div>
                                <div
                                    v-if="timed"
                                    class="v-event-drag-bottom"
                                    @mousedown.stop="extendBottom(event)"
                                ></div>
                                <div class="custom-p">
                                    <button
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#dayDragModal"
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
                            id="dayDragModal"
                            tabindex="-1"
                            aria-labelledby="dayDragModalLabel"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1
                                            class="modal-title fs-5"
                                            id="dayDragModalLabel"
                                        >
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
                                            <ul
                                                class="list-group list-group-flush"
                                            >
                                                <li
                                                    class="list-group-item study-resource"
                                                >
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
                                                                    @change="
                                                                        handleResourceFile
                                                                    "
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
                                                            @click.stop="
                                                                saveResourceFile
                                                            "
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
                                                    v-for="(
                                                        rsf, index
                                                    ) in resource_file"
                                                    :key="index"
                                                    v-if="
                                                        rsf &&
                                                        rsf.resourceFile != null  && rsf.type=='study_resource'
                                                    "
                                                    style="padding-bottom: 2rem"
                                                >
                                                    <span class="rs-file">{{
                                                        rsf.resourceFile
                                                            .original_filename
                                                    }}</span>
                                                    <div
                                                        class="d-flex action mr-4"
                                                    >
                                                        <i
                                                            class="bi bi-download hand"
                                                            @click.stop="
                                                                downloadFile(
                                                                    rsf
                                                                        .resourceFile
                                                                        .id
                                                                )
                                                            "
                                                        ></i>
                                                        <i
                                                            class="bi bi-trash hand ml-2"
                                                            v-if="
                                                                checkPermission
                                                            "
                                                            @click.stop="
                                                                deleteStudyResource(
                                                                    rsf
                                                                        .resourceFile
                                                                        .id
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
                                                <li
                                                    class="list-group-item assignment"
                                                >
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
                                                            @click.stop="
                                                                saveAssignmentFile
                                                            "
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
                                                        <th scope="col">
                                                            Name
                                                        </th>
                                                        <th scope="col">
                                                            Answer
                                                        </th>
                                                        <th scope="col">
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="(
                                                            rsf, index
                                                        ) in resource_file"
                                                        :key="index"
                                                        v-if="
                                                            rsf.resourceFile !=
                                                            null && rsf.type=='assignment'
                                                        "
                                                    >
                                                        <td class="td-rs-file">
                                                            {{
                                                                rsf.resourceFile
                                                                    .original_filename
                                                            }}
                                                        </td>
                                                        <td
                                                            v-if="
                                                                getLoginInfo
                                                                    .user
                                                                    .role ==
                                                                'teacher'
                                                            "
                                                        >
                                                            <span
                                                                v-if="
                                                                    rsf.assignment_answer ==
                                                                    ''
                                                                "
                                                                >{{
                                                                    "not available"
                                                                }}</span
                                                            >
                                                            <i
                                                                class="bi bi-download hand"
                                                                @click.stop="
                                                                    downloadFile(
                                                                        rsf
                                                                            .assignment_answer
                                                                            .id
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
                                                                        rsf
                                                                            .resourceFile
                                                                            .id
                                                                    )
                                                                "
                                                                v-if="
                                                                    rsf.assignment_answer ==
                                                                    ''
                                                                "
                                                            ></i>
                                                            <i
                                                                class="bi bi-download hand"
                                                                @click.stop="
                                                                    downloadFile(
                                                                        rsf
                                                                            .assignment_answer
                                                                            .id
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
                                                                style="
                                                                    visibility: hidden;
                                                                "
                                                            />
                                                        </td>
                                                        <td>
                                                            <i
                                                                class="bi bi-download hand"
                                                                @click.stop="
                                                                    downloadFile(
                                                                        rsf
                                                                            .resourceFile
                                                                            .id
                                                                    )
                                                                "
                                                            ></i>
                                                            <i
                                                                class="bi bi-trash hand"
                                                                @click.stop="
                                                                    deleteStudyResource(
                                                                        rsf
                                                                            .resourceFile
                                                                            .id
                                                                    )
                                                                "
                                                            ></i>
                                                        </td>
                                                    </tr>
                                                    <tr
                                                        v-if="
                                                            resource_file &&
                                                            resource_file.length <
                                                                1
                                                        "
                                                    >
                                                        <span
                                                            >no record
                                                            found</span
                                                        >
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
                                                            @input="
                                                                savezoom_link
                                                            "
                                                        />
                                                        <i
                                                            class="bi bi-clipboard"
                                                            @click.stop="
                                                                copyzoom_link
                                                            "
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
                                            <ul
                                                class="list-group list-group-flush"
                                                v-else
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
                                            readonly
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
                                   
                                </div>
                                            </ul>
                                        </div>
                                        <div class="card">
                                            <div
                                                class="card-header d-flex justify-content-between"
                                            >
                                                <span
                                                    >Completed Class Video</span
                                                >
                                            </div>
                                            <ul
                                                class="list-group list-group-flush"
                                            >
                                                <li
                                                    class="list-group-item"
                                                ></li>
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
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                        >
                                            Save changes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal end -->
                    </v-sheet>
                </v-col>
            </v-row>
        </v-app>
    </fragment>
</template>
<script>
import CalendarMonthDragComponent from "./CalendarMonthDrag.vue";
import { loginInfoStore } from "../../stores/loginInfo";
import { mapState } from "pinia";
import moment from "moment";
export default {
    data: () => ({
        assessment_file_answer: "",
        assignmentFileName: "",
        resource_file: [],
        resourceFileName: "",
        checkPermission: true,
        userType: "",
        showDeleteModel: false,
        currentEvent: {},
        currentzoom_link: "",
        showStartModel: false,
        monthCalendar: {},
        calendarTitle: "",
        startDragAttempt: 0,
        show: true,
        sessionId: "",
        description: "",
        openMeetwith: false,
        titleInfo: {},
        openDetail: false,
        editOpen: false,
        isStudent: false,
        isTeacher: false,
        focus: "",
        type: "month",
        typeToLabel: {
            month: "Month",
            week: "Week",
            day: "Day",
            "4day": "4 Days",
        },
        selectedEvent: {},
        zoom_link: "",
        selectedElement: null,
        selectedOpen: false,
        events: [],
        slots: [],
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
        current_slot_unique_id: "",
        currentTeacherId: "",
        selected_assessment_id: "",
        click_on_slot:false
    }),
    props: {
        current_teacher_id: String,
        current_student_id: String,
        calType: String,
        unique_id: String,
    },
    components: {
        "calendar-month-drag-component": CalendarMonthDragComponent,
    },
    computed: {
        ...mapState(loginInfoStore, ["getLoginInfo"]),
    },
    mounted() {
        this.checkRole();
        this.$refs.calendar.checkChange();
    },
    methods: {
        getSlotInfo(slot) {
            this.click_on_slot=true;
        },
        uploadAssignmentAnswer(id) {
            this.selected_assessment_id = id;
            document.getElementById("assignment_file_answer-label").click();
        },
        async confirmDelete() {
            let isDelete = "";
            isDelete = await this.deleteRecord(
                "SingleTimetable",
                this.current_timetable_id
            );
            if (isDelete.status == "ok") {
                this.closeModel();
                location.reload();
            }
        },
        deleteSlot() {
            this.showDeleteModel = true;
            this.userType = " this slot";
        },
        saveCurrentzoom_link(val) {
            this.currentEvent = val;
            this.zoom_link = val.zoom_link;
            this.current_timetable_id = val.id;
        },
        startClass() {
            this.showStartModel = true;
        },

        calendarTodayTitle(val) {
            this.calendarTitle = val;
        },
        setFocus(val) {
            this.focus = val;
        },
        calTitle(val) {
            this.calendarTitle = val.title;
            this.monthCalendar = val;
        },
        currentType(type) {
            this.type = type;
        },
        closeModel() {
            this.showStartModel = false;
            this.selectedOpen = false;
            this.openDetail = false;
            this.editOpen = false;
            this.showDeleteModel = false;
            // location.reload();
        },
        startDrag({ event, timed }) {
            if (event && timed) {
                this.dragEvent = event;
                this.dragTime = null;
                this.extendOriginal = null;
            }

            if (this.startDragAttempt > 0) {
                let x = event.start;
                let y = this.start_end_time(event.start, event.end);
            }
            if (this.startDragAttempt == 0) {
                this.startDragAttempt = 1;
            }
        },
        startTime(tms) {
            const mouse = this.toTime(tms);

            if (this.dragEvent && this.dragTime === null) {
                const start = this.dragEvent.start;

                this.dragTime = mouse - start;
            } else {
                this.createStart = this.roundTime(mouse);
            }
        },
        mouseMove(tms) {
            const mouse = this.toTime(tms);

            if (this.dragEvent && this.dragTime !== null) {
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
                    this.dragEvent.start = newStart;
                    this.dragEvent.end = newEnd;
                }
            } else if (this.createEvent && this.createStart !== null) {
                const mouseRounded = this.roundTime(mouse, false);
                const min = Math.min(mouseRounded, this.createStart);
                const max = Math.max(mouseRounded, this.createStart);

                this.createEvent.start = min;
                this.createEvent.end = max;
            }
        },
        async endDrag() {
            if (!this.isDisable) {
                this.click_on_slot = false;
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

                if (this.getLoginInfo.user.role == "teacher") {
                    let postResponse = await this.post(urlText, formData);
                    if (!this.click_on_slot) {
                        let res = this.slotAvailableOrNot(postResponse);
                        if (res == "failed") {
                            this.updateRange();
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

        extendBottom(event) {
            this.createEvent = event;
            this.createStart = event.start;
            this.extendOriginal = event.end;
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
        getEvents({ start, end }) {
            const events = [];

            const min = new Date(`${start.date}T00:00:00`).getTime();
            const max = new Date(`${end.date}T23:59:59`).getTime();
            const days = (max - min) / 86400000;
            const eventCount = this.rnd(days, days + 20);

            for (let i = 0; i < eventCount; i++) {
                const timed = this.rnd(0, 3) !== 0;
                const firstTimestamp = this.rnd(min, max);
                const secondTimestamp = this.rnd(2, timed ? 8 : 288) * 900000;
                const start = firstTimestamp - (firstTimestamp % 900000);
                const end = start + secondTimestamp;

                events.push({
                    name: this.rndElement(this.names),
                    color: this.rndElement(this.colors),
                    start,
                    end,
                    timed,
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
        goToDetailPage() {
            this.$root.changeRoute(
                "/student-session-detail/" + this.$route.params.student_id
            );
            this.openMeetwith = false;
        },
        openDetailModel() {
            this.sessionId = this.selectedEvent.session_id;
            this.description = this.selectedEvent.description;
            this.openMeetwith = true;
        },
        modalClose() {
            this.openMeetwith = false;
            this.closeModel();
        },
        openEdit() {
            this.selectedOpen = false;
            this.editOpen = true;
            this.titleInfo = { pageType: "edit" };
        },
        sendEmail() {
            let y = this.selectedEvent;
            this.addStatus("Email send successfully");
        },
        monthViewDay(date) {
            this.focus = date;
            this.type = "day";
        },
        viewDay({ date }) {
            this.focus = date;
            this.type = "day";
        },
        getEventColor(event) {
            return event.color;
        },
        setToday() {
            this.focus = "";
            this.calendarTitle = this.monthCalendar.title;
        },
        async prev() {
            if (this.type == "month") {
                let pre = await this.monthCalendar.prev();
                this.calendarTitle = this.monthCalendar.title;
            } else {
                this.$refs.calendar.prev();
            }
        },
        async next() {
            if (this.type == "month") {
                let nex = await this.monthCalendar.next();
                this.calendarTitle = this.monthCalendar.title;
            } else {
                this.$refs.calendar.next();
            }
        },
        showEvent({ nativeEvent, event }) {
            this.currentEvent = event;
            this.zoom_link = event.zoom_link;
            this.current_slot_unique_id = event.class_unique_id;
            this.current_timetable_id = event.id;
            this.currentTeacherId = event.teacher_id;
            this.getResourceFile();

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
        async updateRange() {
            const events = [];
            let urlText = "";

            let getResponse = {};
            if (this.calType == "student_all") {
                //student-detail class tab
                urlText = "student/" + this.current_student_id + "/class";
            } else if (this.calType == "teacher_all") {
                //teacher-detail class tab
                urlText = "teacher/" + this.current_teacher_id + "/class";
            } else if (this.calType == "class_according_unique_id") {
                urlText = "timetable/" + this.unique_id;
            } else {
                //student-detail teacher tab
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

            this.slots.map((data) => {
                events.push({
                    id: data.id,
                    name: data.topic,
                    color: this.colors[this.rnd(0, this.colors.length - 1)],
                    start: new Date(data.start_date),
                    end: new Date(data.end_date),
                    timed: data.start_date,
                    description: data.description,
                    zoom_link: data.zoom_link,
                    teacher_id: this.current_teacher_id,
                    student_id: this.current_student_id,
                    class_unique_id: data.class_unique_id,
                });
            });

            this.events = events;
            this.show = false;
        },
        rnd(a, b) {
            return Math.floor((b - a + 1) * Math.random()) + a;
        },
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

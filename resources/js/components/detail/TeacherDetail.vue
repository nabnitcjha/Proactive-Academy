<template>
    <div class="row">
        <div
            class="modal fade modal-tall"
            id="sendMessageToTeacher"
            tabindex="-1"
            aria-labelledby="sendMessageToTeacherLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1
                            class="modal-title fs-5"
                            id="sendMessageToTeacherLabel"
                        >
                            SEND MESSAGE
                        </h1>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <chat-form
                            :current_friend_id="current_friend_id"
                                :message_type="message_type"
                                :current_class_unique_id="
                                    current_class_unique_id
                                "
                            ></chat-form>
                        </div>
                    </div>
                    <div class="modal-footer invisible"></div>
                </div>
            </div>
        </div>

        <div
            class="modal fade modal-tall"
            id="groupDiscussionMessage"
            tabindex="-1"
            aria-labelledby="groupDiscussionMessageLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1
                            class="modal-title fs-5"
                            id="groupDiscussionMessageLabel"
                        >
                            SEND MESSAGE
                        </h1>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <chat-form
                            :current_friend_id="current_friend_id"
                                :message_type="message_type"
                                :current_class_unique_id="
                                    current_class_unique_id
                                "
                            ></chat-form>
                        </div>
                    </div>
                    <div class="modal-footer invisible"></div>
                </div>
            </div>
        </div>

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
                                {{ profile_overview.teacher_info.full_name }}
                            </h2>
                            <h1 style="font-size: 14px">{{ "Teacher" }}</h1>
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
                                <ul class="nav nav-tabs nav-tabs-bordered">
                                    <li class="nav-item">
                                        <button
                                            class="nav-link active"
                                            data-bs-toggle="tab"
                                            data-bs-target="#profile-overview"
                                        >
                                            Overview
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button
                                            class="nav-link"
                                            data-bs-toggle="tab"
                                            data-bs-target="#profile-teacher"
                                            @click.stop="makeTrue"
                                        >
                                            Classes
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button
                                            class="nav-link"
                                            data-bs-toggle="tab"
                                            data-bs-target="#profile-discussion"
                                            @click.stop="setShowDiscussion"
                                        >
                                            Discussion
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button
                                            class="nav-link"
                                            data-bs-toggle="tab"
                                            data-bs-target="#profile-classes"
                                            @click.stop="makeFalse"
                                            v-if="
                                                getLoginInfo.user.role ==
                                                'admin'
                                            "
                                        >
                                            Classes
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button
                                            class="nav-link"
                                            data-bs-toggle="tab"
                                            data-bs-target="#profile-change-password"
                                            @click.stop="setHideDiscussion"
                                            v-if="
                                                getLoginInfo.user.role ==
                                                'admin'
                                            "
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
                                            <div
                                                class="col-lg-3 col-md-4 label"
                                            >
                                                Full Name
                                            </div>
                                            <div class="col-lg-9 col-md-8">
                                                {{
                                                    profile_overview
                                                        .teacher_info.full_name
                                                }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-4 label"
                                            >
                                                Message
                                            </div>
                                            <div class="col-lg-9 col-md-8">
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-secondary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#sendMessageToTeacher"
                                                    @click.stop="
                                                        setMessage_type(
                                                            'one-to-one'
                                                        )
                                                    "
                                                >
                                                    SEND MESSAGE TO
                                                    <span
                                                        class="text-uppercase badge badge-info"
                                                        style="
                                                            background-color: black;
                                                        "
                                                        >{{
                                                            profile_overview
                                                                .teacher_info
                                                                .full_name
                                                        }}</span
                                                    >
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-4 label"
                                            >
                                                Classes
                                            </div>
                                            <div class="col-lg-9 col-md-8">
                                                <div
                                                    class="accordion accordion-flush"
                                                    v-bind:id="
                                                        'overview_class_accordion' +
                                                        index
                                                    "
                                                    v-for="(
                                                        class_info, index
                                                    ) in profile_overview.sorted_class"
                                                    :key="index"
                                                    v-if="
                                                        checkStudent(class_info)
                                                    "
                                                >
                                                    <div class="accordion-item">
                                                        <h2
                                                            class="accordion-header"
                                                            v-bind:id="
                                                                'overview_class_heading' +
                                                                index
                                                            "
                                                        >
                                                            <button
                                                                class="accordion-button collapsed"
                                                                type="button"
                                                                data-bs-toggle="collapse"
                                                                v-bind:data-bs-target="
                                                                    '#' +
                                                                    'flush-overview_class_accordion' +
                                                                    index
                                                                "
                                                                aria-expanded="false"
                                                                v-bind:aria-controls="
                                                                    'flush-overview_class_accordion' +
                                                                    index
                                                                "
                                                            >
                                                                {{
                                                                    class_info.topic
                                                                }}
                                                            </button>
                                                        </h2>
                                                        <div
                                                            v-bind:id="
                                                                'flush-overview_class_accordion' +
                                                                index
                                                            "
                                                            class="accordion-collapse collapse"
                                                            v-bind:aria-labelledby="
                                                                'flush-overview_class_heading' +
                                                                index
                                                            "
                                                            v-bind:data-bs-parent="
                                                                '#' +
                                                                'overview_class_accordion' +
                                                                index
                                                            "
                                                        >
                                                            <div
                                                                class="accordion-body"
                                                            >
                                                                <ul
                                                                    class="list-group"
                                                                >
                                                                    <li
                                                                        class="list-group-item"
                                                                    >
                                                                        <b
                                                                            >START
                                                                            TIME
                                                                            : </b
                                                                        >{{
                                                                            timeFormater(
                                                                                class_info.start_date
                                                                            )
                                                                        }}
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item"
                                                                    >
                                                                        <b
                                                                            >END
                                                                            TIME
                                                                            : </b
                                                                        >{{
                                                                            timeFormater(
                                                                                class_info.end_date
                                                                            )
                                                                        }}
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item"
                                                                    >
                                                                        <b
                                                                            >CLASS
                                                                            DAY
                                                                            : </b
                                                                        ><span
                                                                            class="badge rounded-pill text-bg-warning mr-2"
                                                                            v-for="(
                                                                                cls_selected_day,
                                                                                index
                                                                            ) in class_info.selected_day"
                                                                            :key="
                                                                                index
                                                                            "
                                                                            >{{
                                                                                findDay(
                                                                                    cls_selected_day
                                                                                )
                                                                            }}</span
                                                                        >
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item"
                                                                    >
                                                                        <b
                                                                            >DURATION
                                                                            : </b
                                                                        >{{
                                                                            class_info.duration
                                                                        }}
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item"
                                                                    >
                                                                        <b
                                                                            >DESCRIPTION
                                                                            : </b
                                                                        >{{
                                                                            class_info.description
                                                                        }}
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item"
                                                                    >
                                                                        <b
                                                                            >SUBJECT
                                                                            : </b
                                                                        ><span
                                                                            class="badge rounded-pill text-bg-success mr-2"
                                                                        >
                                                                            {{
                                                                                class_info
                                                                                    .subject
                                                                                    .name
                                                                            }}
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="row"
                                            v-if="
                                                getLoginInfo.user.role ==
                                                'admin'
                                            "
                                        >
                                            <div
                                                class="col-lg-3 col-md-4 label"
                                            >
                                                Teachers
                                            </div>
                                            <div class="col-lg-9 col-md-8">
                                                <div
                                                    class="accordion accordion-flush"
                                                    v-bind:id="
                                                        'overview_teacher_accordion' +
                                                        index
                                                    "
                                                    v-for="(
                                                        thr_info, index
                                                    ) in profile_overview.teacher_info"
                                                    :key="index"
                                                >
                                                    <div class="accordion-item">
                                                        <h2
                                                            class="accordion-header"
                                                            v-bind:id="
                                                                'overview_teacher_heading' +
                                                                index
                                                            "
                                                        >
                                                            <button
                                                                class="accordion-button collapsed"
                                                                type="button"
                                                                data-bs-toggle="collapse"
                                                                v-bind:data-bs-target="
                                                                    '#' +
                                                                    'flush-overview_teacher_accordion' +
                                                                    index
                                                                "
                                                                aria-expanded="false"
                                                                v-bind:aria-controls="
                                                                    'flush-overview_teacher_accordion' +
                                                                    index
                                                                "
                                                            >
                                                                {{
                                                                    thr_info.full_name
                                                                }}
                                                            </button>
                                                        </h2>
                                                        <div
                                                            v-bind:id="
                                                                'flush-overview_teacher_accordion' +
                                                                index
                                                            "
                                                            class="accordion-collapse collapse"
                                                            v-bind:aria-labelledby="
                                                                'flush-overview_teacher_heading' +
                                                                index
                                                            "
                                                            v-bind:data-bs-parent="
                                                                '#' +
                                                                'overview_teacher_accordion' +
                                                                index
                                                            "
                                                        >
                                                            <div
                                                                class="accordion-body"
                                                            >
                                                                <ul
                                                                    class="list-group"
                                                                >
                                                                    <li
                                                                        class="list-group-item"
                                                                    >
                                                                        <b
                                                                            >EMAIL
                                                                            : </b
                                                                        >{{
                                                                            thr_info.email
                                                                        }}
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item"
                                                                    >
                                                                        <b
                                                                            >PHONE
                                                                            : </b
                                                                        >{{
                                                                            thr_info.phone
                                                                        }}
                                                                    </li>
                                                                    <li
                                                                        class="list-group-item"
                                                                    >
                                                                        <b
                                                                            >SUBJECT
                                                                            :
                                                                        </b>
                                                                        <span
                                                                            class="badge rounded-pill text-bg-warning mr-2"
                                                                            v-for="(
                                                                                tch_sub_info,
                                                                                index
                                                                            ) in thr_info.subject"
                                                                            :key="
                                                                                index
                                                                            "
                                                                            v-if="
                                                                                checkSubject(
                                                                                    tch_sub_info
                                                                                )
                                                                            "
                                                                            >{{
                                                                                tch_sub_info.name
                                                                            }}</span
                                                                        >
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-4 label"
                                            >
                                                Email
                                            </div>
                                            <div class="col-lg-9 col-md-8">
                                                {{
                                                    profile_overview
                                                        .teacher_info.email
                                                }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div
                                                class="col-lg-3 col-md-4 label"
                                            >
                                                Phone
                                            </div>
                                            <div class="col-lg-9 col-md-8">
                                                {{
                                                    profile_overview
                                                        .teacher_info.phone
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="tab-pane fade profile-teacher pt-3"
                                        id="profile-teacher"
                                        v-if="getLoginInfo.user.role == 'admin'"
                                    >
                                        <form>
                                            <div class="row mb-3">
                                                <div
                                                    class="accordion accordion-flush"
                                                    v-bind:id="
                                                        'profile-teacher-accordion' +
                                                        thr_info.id
                                                    "
                                                    v-for="(
                                                        thr_info,
                                                        tchr_info_index
                                                    ) in profile_overview.teacher_info"
                                                    :key="tchr_info_index"
                                                >
                                                    <div class="accordion-item">
                                                        <h2
                                                            class="accordion-header"
                                                            v-bind:id="
                                                                'profile-teacher-flush' +
                                                                thr_info.id
                                                            "
                                                        >
                                                            <button
                                                                class="accordion-button collapsed"
                                                                type="button"
                                                                data-bs-toggle="collapse"
                                                                v-bind:data-bs-target="
                                                                    '#' +
                                                                    'profile-teacher-flush-collapseOne' +
                                                                    thr_info.id
                                                                "
                                                                aria-expanded="false"
                                                                v-bind:aria-controls="
                                                                    'profile-teacher-flush-collapseOne' +
                                                                    thr_info.id
                                                                "
                                                            >
                                                                <h1
                                                                    class="fs-5"
                                                                >
                                                                    {{
                                                                        thr_info.full_name
                                                                    }}
                                                                </h1>
                                                            </button>
                                                        </h2>
                                                        <div
                                                            v-bind:id="
                                                                'profile-teacher-flush-collapseOne' +
                                                                thr_info.id
                                                            "
                                                            v-bind:class="[
                                                                'accordion-collapse collapse',
                                                                tchr_info_index ==
                                                                0
                                                                    ? 'show'
                                                                    : '',
                                                            ]"
                                                            aria-labelledby="profile-teacher-flush"
                                                            v-bind:data-bs-parent="
                                                                '#' +
                                                                'profile-teacher-accordion' +
                                                                thr_info.id
                                                            "
                                                        >
                                                            <div
                                                                class="accordion-body"
                                                            >
                                                                <div
                                                                    class="row"
                                                                >
                                                                    <div
                                                                        class="col-lg-3 col-md-4 label"
                                                                    >
                                                                        Subjects
                                                                    </div>
                                                                    <div
                                                                        class="col-lg-9 col-md-8"
                                                                    >
                                                                        <span
                                                                            class="badge rounded-pill bg-warning text-dark"
                                                                            v-for="(
                                                                                sub_info,
                                                                                sub_info_index
                                                                            ) in thr_info.subject"
                                                                            :key="
                                                                                sub_info_index
                                                                            "
                                                                            >{{
                                                                                sub_info.name
                                                                            }}</span
                                                                        >
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="row"
                                                                >
                                                                    <div
                                                                        class="col-lg-3 col-md-4 label"
                                                                    >
                                                                        Message
                                                                    </div>
                                                                    <div
                                                                        class="col-lg-9 col-md-8"
                                                                    >
                                                                        <button
                                                                            type="button"
                                                                            class="btn btn-success"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sendMessageToTeacher"
                                                                        >
                                                                            SEND
                                                                            MESSAGE
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="row"
                                                                >
                                                                    <div
                                                                        class="col-lg-3 col-md-4 label"
                                                                    >
                                                                        Email
                                                                    </div>
                                                                    <div
                                                                        class="col-lg-9 col-md-8"
                                                                    >
                                                                        {{
                                                                            thr_info.email
                                                                        }}
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="row"
                                                                >
                                                                    <div
                                                                        class="col-lg-3 col-md-4 label"
                                                                    >
                                                                        Phone
                                                                    </div>
                                                                    <div
                                                                        class="col-lg-9 col-md-8"
                                                                    >
                                                                        {{
                                                                            thr_info.phone
                                                                        }}
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="row"
                                                                >
                                                                    <div
                                                                        class="col-lg-3 col-md-4 label cstm-font"
                                                                    >
                                                                        <h1>
                                                                            Classes
                                                                        </h1>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="row"
                                                                    v-if="
                                                                        showCalendar
                                                                    "
                                                                >
                                                                    <div>
                                                                        <slot-calendar
                                                                            :current_teacher_id="
                                                                                thr_info.id
                                                                            "
                                                                            :current_student_id="
                                                                                $route
                                                                                    .params
                                                                                    .id
                                                                            "
                                                                            :calType="
                                                                                student_teacher_all
                                                                            "
                                                                        ></slot-calendar>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div
                                        class="tab-pane fade profile-teacher pt-3"
                                        id="profile-teacher"
                                        v-else
                                    >
                                        <form>
                                            <div class="row mb-3">
                                                <div
                                                    class="accordion accordion-flush"
                                                    id="
                                                    profile-teacher-accordion
                                                        
                                                    "
                                                >
                                                    <div class="accordion-item">
                                                        <div
                                                            id="
                                                            profile-teacher-flush-collapseOne
                                                            "
                                                            class="accordion-collapse collapse show"
                                                            aria-labelledby="profile-teacher-flush"
                                                            data-bs-parent="#profile-teacher-accordion
                                                            "
                                                        >
                                                            <div
                                                                class="accordion-body"
                                                            >
                                                                <div
                                                                    class="row"
                                                                    v-if="
                                                                        showCalendar
                                                                    "
                                                                >
                                                                    <div>
                                                                        <slot-calendar
                                                                            :current_teacher_id="
                                                                                $route
                                                                                    .params
                                                                                    .id
                                                                            "
                                                                            :current_student_id="
                                                                                getLoginInfo
                                                                                    .student_info
                                                                                    .id
                                                                            "
                                                                            :calType="
                                                                                student_teacher_all
                                                                            "
                                                                        ></slot-calendar>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div
                                        class="tab-pane fade pt-3"
                                        id="profile-classes"
                                    >
                                        <slot-calendar
                                            :current_student_id="
                                                $route.params.id
                                            "
                                            :calType="student_all"
                                            v-if="
                                                getLoginInfo.user.role ==
                                                'admin'
                                            "
                                        ></slot-calendar>
                                    </div>

                                    <div
                                        class="tab-pane fade pt-3"
                                        id="profile-change-password"
                                    >
                                        <form>
                                            <div class="row mb-3">
                                                <label
                                                    for="currentPassword"
                                                    class="col-md-4 col-lg-3 col-form-label"
                                                    >Current Password</label
                                                >
                                                <div class="col-md-8 col-lg-9">
                                                    <input
                                                        name="password"
                                                        type="password"
                                                        class="form-control"
                                                        id="currentPassword"
                                                    />
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label
                                                    for="newPassword"
                                                    class="col-md-4 col-lg-3 col-form-label"
                                                    >New Password</label
                                                >
                                                <div class="col-md-8 col-lg-9">
                                                    <input
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
                                                <div class="col-md-8 col-lg-9">
                                                    <input
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
                                                    @click.stop="changePassword"
                                                >
                                                    Change Password
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div
                                        class="tab-pane fade pt-3 profile-discussion-card"
                                        id="profile-discussion"
                                    >
                                        <div
                                            class="card"
                                            style="width: 18rem"
                                            v-for="(
                                                class_info, index
                                            ) in profile_overview.sorted_class"
                                            :key="index"
                                            v-if="checkStudent(class_info)"
                                        >
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    {{ class_info.topic }}
                                                </h5>
                                                <a
                                                    href="#"
                                                    class="btn btn-success"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#groupDiscussionMessage"
                                                    @click.stop="
                                                        setClassId(
                                                            class_info.class_unique_id,
                                                            'group-chat'
                                                        )
                                                    "
                                                    >Open Discussion</a
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
            current_friend_id:"",
            showDiscussion: true,
            message_type: "",
            student_all: "student_all",
            student_teacher_all: "student_teacher_all",
            show: false,
            showTeacherCalendar: false,
            showAllCalendar: false,
            profile_overview: [],
            sorted_class: [],
            current_teacher_id: 0,
            current_student_id: "",
            current_class_unique_id: "",
            current_class_id: 0,
            showCalendar: false,
            subjects: [],
        };
    },
    computed: {
        ...mapState(loginInfoStore, ["getLoginInfo"]),
    },
    mounted() {
        this.profileOverview();
    },
    methods: {
        checkStudent(class_info) {
            let results = [];
            if (this.getLoginInfo.user.role == "student") {
                results = class_info.student.filter(
                    (stu) => stu.full_name === this.getLoginInfo.user.name
                );
            }

            if (results.length > 0) {
                return true;
            } else {
                return false;
            }
        },
        setMessage_type(msg_type) {
            this.message_type = msg_type;
        },
        setClassId(class_unique_id, msg_type) {
            this.current_class_unique_id = class_unique_id;
            if (this.message_type == msg_type) {
                this.message_type = "again-click-group-chat";
            }else{
                this.message_type = msg_type;
            }
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
        makeTrue() {
            this.showCalendar = true;
        },
        makeFalse() {
            this.showCalendar = false;
        },
        setShowDiscussion() {
            this.showDiscussion = true;
        },
        async setHideDiscussion() {
            this.showDiscussion = false;
            await new Promise((resolve) => setTimeout(resolve, 100)); // 3 sec
            this.showDiscussion = true;
        },
        checkSubject(val) {
            let results = [];
            if (this.getLoginInfo.user.role == "teacher") {
                results = this.getLoginInfo.teacher_info.subject.filter(
                    (sub) => sub.name === val.name
                );
            } else {
                results = this.subjects.filter((sub) => sub.name === val.name);
            }

            if (results.length > 0) {
                return true;
            } else {
                return false;
            }
        },
        async profileOverview() {
            let id = this.$route.params.id;
            let urlText = "";
            if (this.getLoginInfo.user.role == "student") {
                urlText =
                    "student/" +
                    this.getLoginInfo.student_info.id +
                    "/teacher/" +
                    id +
                    "/detail";
            } else {
                urlText = "student/" + id + "/detailForAdmin";
            }

            let getResponse = await this.get(urlText, id, false);
            let sortedClass = await this.sortedClass();

            this.profile_overview = {
                ...getResponse.data.data,
                sorted_class: this.sorted_class,
            };
            this.subjects = this.profile_overview.subject_info;
            this.current_friend_id = this.profile_overview.teacher_info.user_id;
        },
        async sortedClass() {
            let id = this.$route.params.id;
            let urlText = "teacher/" + id + "/sortedClass";

            let getResponse = await this.get(urlText, id, false);

            this.sorted_class = getResponse.data.data;
        },

        async changePassword() {
            let id = 1;
            let formData = {};
            let urlText = "teacher/" + id + "/changePassword";

            let putResponse = await this.put(urlText, formData);
        },
    },
};
</script>

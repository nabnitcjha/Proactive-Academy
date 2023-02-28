<template>
    <div class="messaging">
        <div class="inbox_msg">
            <div class="mesgs col-12">
                <div class="msg_history" id="msg_history" v-chat-scroll>
                    <div
                        class="incoming_msg"
                        v-for="(msg, index) in user_message"
                        :key="index"
                        v-if="msg.message_type == 'one-to-one'"
                    >
                        <div
                            class="incoming_msg_img"
                            v-if="
                                msg.message_reciver_info.id == current_friend_id
                            "
                        >
                            <img
                                src="https://ptetutorials.com/images/user-profile.png"
                                alt="sunil"
                            />
                        </div>
                        <div
                            v-bind:class="[
                                '',
                                msg.message_reciver_info.id == current_friend_id
                                    ? 'received_msg'
                                    : 'outgoing_msg',
                            ]"
                        >
                            <div
                                v-bind:class="[
                                    '',
                                    msg.message_reciver_info.id ==
                                    current_friend_id
                                        ? 'received_withd_msg'
                                        : 'sent_msg',
                                ]"
                            >
                                <p>
                                    {{ msg.message }}
                                </p>
                                <span class="time_date">
                                    11:01 AM | June 9</span
                                >
                            </div>
                        </div>
                    </div>
                    <div
                        class="incoming_msg"
                        v-for="(msg, index) in user_message"
                        :key="index"
                        v-if="message_type == 'group-chat' || message_type == 'again-click-group-chat'"
                    >
                        <div
                            class="incoming_msg_img"
                            v-if="msg.user_info.id != my_id"
                        >
                            <img
                                src="https://ptetutorials.com/images/user-profile.png"
                                alt="sunil"
                            />
                        </div>
                        <div
                            v-bind:class="[
                                '',
                                msg.user_info.id != my_id
                                    ? 'received_msg'
                                    : 'outgoing_msg',
                            ]"
                        >
                            <div
                                v-bind:class="[
                                    '',
                                    msg.user_info.id != my_id
                                        ? 'received_withd_msg'
                                        : 'sent_msg',
                                ]"
                            >
                                <p>
                                    {{ msg.message }}
                                </p>
                                <span class="time_date">
                                    11:01 AM | June 9</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="type_msg">
                    <div class="input_msg_write">
                        <input
                            type="text"
                            class="write_msg"
                            placeholder="Type your message here..."
                            v-model="newMessage"
                            @keyup.enter="addMessage"
                        />
                        <button
                            class="msg_send_btn"
                            type="button"
                            @click="addMessage"
                        >
                            <i class="bi bi-send" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="input-group">
        <input
            id="btn-input"
            type="text"
            name="message"
            class="form-control input-sm"
            placeholder="Type your message here..."
            v-model="newMessage"
            @keyup.enter="addMessage"
        />
        <span class="input-group-btn">
            <button
                class="btn btn-primary btn-sm"
                id="btn-chat"
                @click="addMessage"
            >
                Send
            </button>
        </span>
    </div> -->
</template>
<script>
import { chatInfoStore } from "../../stores/chatInfo";
import { loginInfoStore } from "../../stores/loginInfo";
import { mapState, storeToRefs } from "pinia";

export default {
    data() {
        return {
            newMessage: "",
            user_message: [],
            urlText: "",
            friend_id: "",
            my_id: "",
        };
    },

    watch: {
        message_type(newValue, oldValue) {
            // this.user_message = [];
            this.fetchMessages(this.friend_id, this.my_id);
        },
        messageInfo(newValue, oldValue) {
            if (
                this.my_id == newValue.my_id ||
                this.friend_id == newValue.my_id
            ) {
                this.fetchMessages(newValue.my_id, newValue.friend_id);
            }
        },
    },
    props: {
        current_friend_id: String,
        message_type: String,
        current_class_unique_id: String,
    },

    computed: {
        ...mapState(chatInfoStore, ["getMessageInfo", "messageInfo"]),
        ...mapState(loginInfoStore, ["getLoginInfo"]),
    },
    mounted() {
        this.my_id = this.getLoginInfo.user.id;
        this.friend_id = this.current_friend_id;
        // this.fetchMessages(this.friend_id, this.my_id);
    },
    methods: {
        async addMessage() {
            let new_msg_info = {};

            if (this.message_type == "group-chat") {
                new_msg_info = {
                    message: this.newMessage,
                    message_type: this.message_type,
                    user_info: {
                        id: this.my_id,
                        full_name: this.getLoginInfo.user.name,
                    },
                };
            } else {
                new_msg_info = {
                    message: this.newMessage,
                    message_type: this.message_type,
                    message_sender_info: {
                        id: this.my_id,
                        full_name: this.getLoginInfo.user.name,
                    },
                    message_reciver_info: {
                        id: "",
                        full_name: "",
                    },
                };
            }

            this.user_message.unshift(new_msg_info);

            this.urlText = "messages";

            let formData = new FormData();

            if (this.message_type == "group-chat") {
                formData.append(
                    "message_info[class_unique_id]",
                    this.current_class_unique_id
                );
            } else {
                formData.append("message_info[class_unique_id]", "");
            }
            formData.append("message_info[message]", this.newMessage);
            formData.append("message_info[friend_id]", this.friend_id);
            formData.append("message_info[my_id]", this.my_id);
            formData.append("message_info[message_type]", this.message_type);
            formData.append(
                "message_info[my_role]",
                this.getLoginInfo.user.role
            );

            this.newMessage = "";
            let postResponse = await this.post(this.urlText, formData);
        },
        async fetchMessages(friend_id, my_id) {
            let urlText = "";
            if (this.message_type == "one-to-one") {
                urlText = "messages" + "/" + friend_id + "/" + my_id;
            } else if (this.message_type == "again-click-group-chat") {
                urlText =
                    "groupMessages" +
                    "/" +
                    this.current_class_unique_id +
                    "/" +
                    my_id;
            } else {
                urlText =
                    "groupMessages" +
                    "/" +
                    this.current_class_unique_id +
                    "/" +
                    my_id;
            }
            let getResponse = await this.get(urlText, 1, false);
            this.user_message = getResponse.data.data;
        },
    },
};
</script>

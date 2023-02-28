<template>
    <ul class="chat">
        <li class="left clearfix" v-for="mi in getMessageInfo" :key="mi.id">
            <div class="clearfix">
                <div class="header">
                    <strong>
                        {{ mi.user.first_name }}{{ " " }}{{ mi.user.last_name }}
                    </strong>
                </div>
                <p>
                    {{ mi.message }}
                </p>
            </div>
        </li>
    </ul>
</template>
<script>
import { chatInfoStore } from "../../stores/chatInfo";
import { mapState } from "pinia";
export default {
    computed: {
        ...mapState(chatInfoStore, ["getMessageInfo"]),
    },
    mounted() {},
};
</script>

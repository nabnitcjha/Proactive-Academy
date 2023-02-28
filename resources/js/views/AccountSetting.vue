<template>
    <account-setting />
</template>

<script>
import AccountSetting from "../components/dashboard/AccountSetting.vue";
export default {
    data() {
        return {
            mode: "add",
        };
    },
    components: {
        AccountSetting,
    },
};
</script>

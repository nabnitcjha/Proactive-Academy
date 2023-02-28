<template>
    <fragment v-if="isDisplay">
        <slot-calendar
            :current_student_id="$route.params.id"
            :calType="class_according_unique_id"
            :unique_id="unique_id"
        ></slot-calendar>
    </fragment>
</template>

<script>
export default {
    data() {
        return {
            class_according_unique_id: "class_according_unique_id",
            unique_id: "",
            isDisplay: false,
        };
    },
    methods: {
        getUniqueId() {
            this.unique_id = this.$route.params.class_unique_id;
            this.isDisplay = true;
        },
    },
    mounted() {
        this.getUniqueId();
    },
};
</script>

<template>
    <teacher-classes />
</template>

<script>
import TeacherClasses from "../components/detail/TeacherClasses.vue";
export default {
    data() {
        return {
            mode: "add",
        };
    },
    components: {
        TeacherClasses,
    },
};
</script>

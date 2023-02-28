<template>
  <admin-dashboard  v-if="getLoginInfo.user.role=='admin'" />
  <teacher-dashboard v-else-if="getLoginInfo.user.role == 'teacher'" />
  <student-dashboard v-else-if="getLoginInfo.user.role == 'student'" />
  <parent-dashboard v-else />
</template>
  
<script>
import AdminDashboard from '../components/dashboard/dashboard/AdminDashboard.vue'
import TeacherDashboard from '../components/dashboard/dashboard/TeacherDashboard.vue'
import StudentDashboard from '../components/dashboard/dashboard/StudentDashboard.vue'
import ParentDashboard from '../components/dashboard/dashboard/ParentDashboard.vue'

import { loginInfoStore } from '../stores/loginInfo.js'
import { mapState , mapActions} from 'pinia'

export default {
    data: function () {
        return {
        };
    },
    components: {
      AdminDashboard,
      TeacherDashboard,
      StudentDashboard,
      ParentDashboard
  },
    computed: {
    ...mapState(loginInfoStore, ['getLoginInfo']),
  },
    methods: {
        ...mapActions(loginInfoStore, ['setLoginInfo']),
    } 
};
</script>

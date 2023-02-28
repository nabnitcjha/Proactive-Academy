<template>
    <admin-dashboard  :userType="userType" v-if="userType=='admin'"/>
    <teacher-dashboard  :userType="userType" v-else-if="userType=='teacher'"/>
    <student-dashboard  :userType="userType" v-else-if="userType=='student'"/>
    <parent-dashboard  :userType="userType" v-else/>
  </template>
  
  <script>
  import { ref } from 'vue'
  import AdminDashboard from '../components/dashboard/dashboard/AdminDashboard.vue'
  import TeacherDashboard from '../components/dashboard/dashboard/TeacherDashboard.vue'
  import StudentDashboard from '../components/dashboard/dashboard/StudentDashboard.vue'
  import ParentDashboard from '../components/dashboard/dashboard/ParentDashboard.vue'

  import {loginInfoStore} from '../stores/loginInfo.js'
import {mapState} from 'pinia'
  
  export default {
    setup() {
      const loginInfo = loginInfoStore()
      let role = loginInfo.getLoginInfo.user.role[0]

      const userType = ref(role)
  
      // expose to template and other options API hooks
      return {
        userType
      }
    },
    computed: {
    ...mapState(loginInfoStore, ['getLoginInfo','isAuthenticate']),
  },
    components:{
      "admin-dashboard":AdminDashboard,
      "teacher-dashboard":TeacherDashboard,
      "student-dashboard":StudentDashboard,
      "parent-dashboard":ParentDashboard,
    },
    mounted() {
      console.log(this.userType) // 0
    }
  }
  </script>
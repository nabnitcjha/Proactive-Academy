import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../components/Login.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'log-in',
    component: Login
  },
  {
    path: '/chat',
    name: 'chat',
    component: () => import('../views/Chat.vue')
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: () => import('../views/Dashboard.vue')
  },
  {
    path: '/account-setting',
    name: 'accountSetting',
    component: () => import('../views/AccountSetting.vue')
  },
  {
    path: '/payment',
    name: 'classPayment',
    component: () => import('../views/ClassPayment.vue')
  },
   // calendar
   {
    path: '/calendar',
    name: 'calendar',
    component: () => import('../views/Calendar.vue')
  },
  // student
  {
    path: '/student',
    name: 'student',
    component: () => import('../views/form/student/Student.vue')
  },
  {
    path: '/register-student',
    name: 'registerStudent',
    component: () => import('../views/form/student/AddStudent.vue')
  },
  {
    path: '/add-student',
    name: 'addStudent',
    component: () => import('../views/form/student/AddStudent.vue')
  },
  {
    path: '/edit-student',
    name: 'editStudent',
    component: () => import('../views/form/student/EditStudent.vue')
  },
  {
    path: '/student/:id/detail',
    name: 'studentDetail',
    component: () => import('../views/detail/StudentDetail.vue')
  },
  // teacher
  {
    path: '/teacher',
    name: 'teacher',
    component: () => import('../views/form/teacher/Teacher.vue')
  },
  {
    path: '/register-teacher',
    name: 'registerTeacher',
    component: () => import('../views/form/teacher/AddTeacher.vue')
  },
  {
    path: '/add-teacher',
    name: 'addTeacher',
    component: () => import('../views/form/teacher/AddTeacher.vue')
  },
  {
    path: '/edit-teacher',
    name: 'editTeacher',
    component: () => import('../views/form/teacher/EditTeacher.vue')
  },
  {
    path: '/teacher/:id/detail',
    name: 'teacherDetail',
    component: () => import('../views/detail/TeacherDetail.vue')
  },
  {
    path: '/teacher-classes',
    name: 'teacherDetail',
    component: () => import('../views/TeacherClasses.vue')
  },
  // subject
  {
    path: '/subject',
    name: 'subject',
    component: () => import('../views/form/subject/Subject.vue')
  },
  {
    path: '/add-subject',
    name: 'addSubject',
    component: () => import('../views/form/subject/AddSubject.vue')
  },
  {
    path: '/edit-subject',
    name: 'editSubject',
    component: () => import('../views/form/subject/EditSubject.vue')
  },
   // class schedule
   {
    path: '/class-schedule',
    name: 'classSchedule',
    component: () => import('../views/form/classSchedule/ClassSchedule.vue')
  },
  {
    path: '/class-schedule/:class_unique_id',
    name: 'class_according_uniqueId',
    component: () => import('../views/form/classSchedule/ClassAccordingUniqueId.vue')
  },
  {
    path: '/add/class-schedule',
    name: 'addClassSchedule',
    component: () => import('../views/form/classSchedule/AddClassSchedule.vue')
  },
  {
    path: '/edit/class-schedule',
    name: 'editClassSchedule',
    component: () => import('../views/form/classSchedule/EditClassSchedule.vue')
  }
]

const router = new VueRouter({
  linkActiveClass: 'active',
  routes
})

export default router
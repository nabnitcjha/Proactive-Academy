<template>
  <fragment>
   <!-- ======= Header ======= -->
   <header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="index.html" class="logo d-flex align-items-center">
    <img src="../../../../public/dashboard_css/assets/img/logo.png" alt="">
    <span class="d-none d-lg-block">PROACTIVE</span>
  </a>
</div><!-- End Logo -->
<!-- Start Search Bar -->
<!-- End Search Bar -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle">
        <i class="bi bi-search"></i>
      </a>
    </li><!-- End Search Icon-->

      <!-- Start Notification Icon -->
      <!-- End Notification Icon -->
 
    <!-- Start Messages Icon -->
    <!-- End Messages Icon -->

    <!-- Start Profile Nav Icon -->
    <profile-nav :user_name="getLoginInfo.user.name" :user_role="getLoginInfo.user.role"  v-if="getLoginInfo.user.role=='admin'"/>
    <profile-nav :user_name="getLoginInfo.student_info.full_name" :user_role="getLoginInfo.user.role"  v-if="getLoginInfo.user.role=='student'"/>
    <profile-nav :user_name="getLoginInfo.teacher_info.full_name" :user_role="getLoginInfo.user.role"  v-if="getLoginInfo.user.role=='teacher'"/>
    <profile-nav :user_name="getLoginInfo.parent_info.full_name" :user_role="getLoginInfo.user.role"  v-if="getLoginInfo.user.role=='parent'"/>
    <!-- End Profile Nav Icon -->

 

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<!-- Start Sidebar-->
<admin-sidebar v-if="getLoginInfo.user.role=='admin'"/>
<student-sidebar v-if="getLoginInfo.user.role=='student'"/>
<teacher-sidebar v-if="getLoginInfo.user.role=='teacher'"/>
<parent-sidebar v-if="getLoginInfo.user.role=='parent'"/>
<!-- End Sidebar-->
</aside>

<main id="main" class="main">

<div class="pagetitle">

  <!-- <h1>Dashboard</h1> -->
  <div class="bd-callout bd-callout-info text-uppercase d-flex justify-content-between">
<strong>{{ getLoginInfo.user.role }} {{ ' ' }} {{ 'Dashboard   ' }}</strong> <span class="text-capitalize">{{  }}</span>
</div>
  
  <!-- start bread crumb -->
  <!-- end bread crumb -->
</div><!-- End Page Title -->

<section class="section dashboard profile">
<!-- start main center area -->
<router-view></router-view>
<!-- end main center area -->
</section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<!-- Start Footer -->
<!-- End Footer -->
</fragment>
</template>

<script>
import { loginInfoStore } from '../../stores/loginInfo';
import ProfileNav from './ProfileNav.vue';
import AdminSidebar from './sidebar/AdminSidebar.vue';
import StudentSidebar from './sidebar/StudentSidebar.vue';
import TeacherSidebar from './sidebar/TeacherSidebar.vue';
import ParentSidebar from './sidebar/ParentSidebar.vue';
import BreadCrumb from './BreadCrumb.vue';
import Footer from './Footer.vue';
import {mapState,mapActions} from 'pinia'

export default {
    data: function () {
        return {
        };
    },
    components: {
     ProfileNav,
     AdminSidebar,
     StudentSidebar,
     TeacherSidebar,
     ParentSidebar,
     BreadCrumb,
     Footer
  },
    computed: {
    ...mapState(loginInfoStore, ['getLoginInfo']),
  },
    methods: {
        ...mapActions(loginInfoStore, ['setLoginInfo']),
    } 
};
</script>
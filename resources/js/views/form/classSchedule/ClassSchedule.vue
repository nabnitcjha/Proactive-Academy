<template>
    <class-schedule :mode="mode" />
 </template>
 
 <script>
 import ClassSchedule from '../../../components/form/ClassSchedule.vue';
 export default {
   data() {
     return {
      mode:'fetch-classes'
     };
   },
   components:{
    ClassSchedule
   }
 };
 </script>
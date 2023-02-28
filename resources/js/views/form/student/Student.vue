<template>
    <student :mode="mode" />
 </template>
 
 <script>

 import Student from '../../../components/form/Student.vue';
 export default {
   data() {
     return {
      mode:'fetch-students'
     };
   },
   components:{
     Student
   }
 };
 </script>
 
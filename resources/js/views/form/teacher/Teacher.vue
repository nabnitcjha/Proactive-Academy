<template>
    <teacher :mode="mode" />
 </template>
 
 <script>

 import Teacher from '../../../components/form/Teacher.vue';
 export default {
   data() {
     return {
      mode:'fetch-teachers'
     };
   },
   components:{
    Teacher
   }
 };
 </script>
 
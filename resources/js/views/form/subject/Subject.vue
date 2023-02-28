<template>
    <Subject :mode="mode" />
 </template>
 
 <script>

 import Subject from '../../../components/form/Subject.vue';
 export default {
   data() {
     return {
      mode:'fetch-subjects'
     };
   },
   components:{
    Subject
   }
 };
 </script>
 
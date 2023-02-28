<template>
    <class-according-unique-id :mode="mode" />
 </template>
 
 <script>

 import ClassAccordingUniqueId from '../../../components/form/ClassAccordingUniqueId.vue';
 export default {
   data() {
     return {
      mode:'fetch-classes'
     };
   },
   components:{
    "class-according-unique-id":ClassAccordingUniqueId
   }
 };

 </script>

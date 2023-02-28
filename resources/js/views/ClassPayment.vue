<template>
    <class-payment />
  </template>
  
  <script>
  import ClassPayment from '../components/detail/ClassPayment.vue';
  export default {
   data() {
     return {
      mode:'add'
     };
   },
   components:{
    ClassPayment
   }
  };
  </script>
  
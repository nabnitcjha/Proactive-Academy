<template>
    <chat-form :mode="mode" />
  </template>
  
  <script>
  import ChatForm from '../components/chat/ChatForm.vue';
  export default {
   data() {
     return {
      mode:'add'
     };
   },
   components:{
     ChatForm
   }
  };
  </script>
  
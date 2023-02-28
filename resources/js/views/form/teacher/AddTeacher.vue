<template>
  <teacher :mode="mode" />
</template>

<script>
import Teacher from '../../../components/form/Teacher.vue';
export default {
 data() {
   return {
    mode:'add'
   };
 },
 components:{
   Teacher
 }
};
</script>

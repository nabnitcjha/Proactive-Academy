<template>
  <class-schedule :mode="mode" />
</template>

<script>
import ClassSchedule from '../../../components/form/ClassSchedule.vue';
export default {
 data() {
   return {
    mode:'add'
   };
 },
 components:{
  ClassSchedule
 }
};
</script>

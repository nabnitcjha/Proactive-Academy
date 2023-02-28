<template>
  <subject :mode="mode" />
</template>

<script>
import Subject from '../../../components/form/Subject.vue';
export default {
 data() {
   return {
    mode:'add'
   };
 },
 components:{
   Subject
 }
};
</script>

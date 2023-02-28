<script>
import {adminStore} from '../stores/AdminStore/index.js';
import {mapState,mapActions} from 'pinia'
import moment from 'moment'
export default {
  data() {
    return {};
  },
  // setup() {
  //   const admin = adminStore()
  // },
  computed: {
    ...mapState(adminStore, ['message','getMsg']),
  },
  methods: {
    ...mapActions(adminStore, ['setMsg']),
    testAPI() {
      this.axios.get("/test").then((response) => {
        this.$toast.show(`Hey! I'm here`);
        // alert(response.data)
      });
    },
    testPINIA() {
      this.setMsg('I am from')
      let x = this.getMsg;
      alert(this.getMsg)
    }
  },
  props: {
    msg: {
    type: String,
    required: true
  }
  },
}
</script>

<template>
  <div class="greetings">
    <h1 class="green">{{ msg }}</h1>
    <h3>
      Pinia Implement
      <button type="button" class="btn btn-primary" @click.stop="testAPI">Test API</button>
      <button type="button" class="btn btn-primary" @click.stop="testPINIA">Test PINIA</button>
    </h3>
  </div>
</template>

<style scoped>
h1 {
  font-weight: 500;
  font-size: 2.6rem;
  top: -10px;
}

h3 {
  font-size: 1.2rem;
}

.greetings h1,
.greetings h3 {
  text-align: center;
}

@media (min-width: 1024px) {

  .greetings h1,
  .greetings h3 {
    text-align: left;
  }
}
</style>

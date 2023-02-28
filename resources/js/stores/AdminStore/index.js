// stores/counter.js
import { defineStore } from 'pinia'

export const adminStore = defineStore(
{
 id:'adminStoreId',
  state: () => {
    return { 
      message: '' 
    }
  },
  getters:{
    getMsg(){
        return this.message;
    }
  },
  actions: {
    setMsg(val) {
      this.message=val;
    },
  },
})

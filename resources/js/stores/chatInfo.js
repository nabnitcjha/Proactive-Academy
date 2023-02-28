// stores/counter.js
import { defineStore } from 'pinia'

export const chatInfoStore = defineStore(
{
 id:'chatInfoStoreId',
  state: () => {
    return { 
      messageInfo: []
    }
  },
  getters:{
    getMessageInfo(){
        return this.messageInfo;
    }
  },
  actions: {
    setMessageInfo(val) {
      this.messageInfo=val;
    }
  },
  persist: {
    enabled: true
  }
})

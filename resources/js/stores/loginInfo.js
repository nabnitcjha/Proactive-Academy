// stores/counter.js
import { defineStore } from 'pinia'

export const loginInfoStore = defineStore(
{
 id:'loginInfoStoreId',
  state: () => {
    return { 
      loginInfo: {},
      isAuthenticate:false ,
      default_image:''
    }
  },
  getters:{
    getDefaultImage(){
      return this.default_image;
  },
    getLoginInfo(){
        return this.loginInfo;
    },
    getAuthenticate(){
      return this.isAuthenticate;
    }
  },
  actions: {
    setDefaultImage(val) {
      this.default_image=val;
    },
    setLoginInfo(val) {
      this.loginInfo=val;
    },
    setAuthenticate(val){
      this.isAuthenticate=val;
    }
  },
  persist: {
    enabled: true
  }
})

import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import router from './router'
import store from './store'
import axios from 'axios'

Vue.config.productionTip = false

import "../src/assets/css/main.css";

axios.defaults.withCredentials = true
axios.defaults.baseURL = 'http://localhost:81';

axios.interceptors.response.use(undefined, function (error) {
  if (error) {
    const originalRequest = error.config;
    if (error.response.status === 401 && !originalRequest._retry) {

      originalRequest._retry = true;

      let user = JSON.parse(localStorage.getItem('user'));

      if (user && user.email) {
        const User = new FormData();
        User.append("email", user.email);
        User.append("password", user.password);
        store.dispatch('login', User)
      } else {
        store.dispatch('logout')
        return router.push('/login')
      }
    }
  }
})

new Vue({
  vuetify,
  router,
  store,
  render: h => h(App)
}).$mount('#app')

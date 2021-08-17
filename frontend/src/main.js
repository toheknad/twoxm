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

new Vue({
  vuetify,
  router,
  store,
  render: h => h(App)
}).$mount('#app')

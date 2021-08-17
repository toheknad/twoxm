import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
import { createLogger } from 'vuex'
import auth from './modules/auth.js'


Vue.use(Vuex)

const debug = 'dev'

export default new Vuex.Store({
    modules: {
        auth
    },
    strict: debug,
    plugins: debug ? [createLogger(), createPersistedState()] : [createPersistedState()]
})
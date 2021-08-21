import axios from 'axios';

const state = {
    profile: null,
    repeats: null,
};

const actions = {
    async getProfile({dispatch},form) {
        await axios.post('/api/auth/signup-by-email-request', {email:form.email, password:form.password})
        let UserForm = new FormData()
        UserForm.append('email', form.email)
        UserForm.append('password', form.password)
        await dispatch('login', UserForm)
    },
    async login({commit}, User) {
        await axios.post('/api/auth/login', User).then( response => {
            if (response.data.token) {
                console.log(JSON.stringify(response.data));
                commit('setUser', JSON.stringify(response.data))
            }

        })
    },
    async logout({commit}){
        let user = null
        commit('logOut', user)
    }
};

const mutations = {
    setUser(state, email){
        state.user = email
    },
    logOut(state){
        state.user = null
    },
};

export default {
    state,
    getters,
    actions,
    mutations
};
import axios from 'axios';

const user = JSON.parse(localStorage.getItem('user'));

const state = user
    ? { status: { loggedIn: true }, user }
    : { status: { loggedIn: false }, user: null };

const getters = {
    isAuthenticated: state => !!state.user,
};

const actions = {
    async register({dispatch},form) {
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
                localStorage.setItem('user', JSON.stringify(response.data));
                commit('loginSuccess', response.data)

            }

        })
    },
    async logout({commit}){
        localStorage.removeItem('user');
        let user = null
        commit('logOut', user)
    }
};

const mutations = {
    loginSuccess(state, user) {
        state.status.loggedIn = true;
        state.user = user;
    },
    logOut(state){
        state.status.loggedIn = false;
        state.user = null
    },
};

export default {
    state,
    getters,
    actions,
    mutations
};
import axios from 'axios';
import authHeader from "@/tools/auth-api";

const state = {
    userStatistic: null
};

const actions = {
    async getUserStatistic({commit}) {
        await axios.post('/api/statistic/get-user-statistic', [], { headers: authHeader() }).then( response => {
            if (response.data) {
                commit('setUserStatistic', response.data.response)
            }

        })
    },
};

const mutations = {
    setUserStatistic(state, userStatistic) {
        state.userStatistic = {all: userStatistic.all, learned: userStatistic.learned}
    }
};

const getters = {
    userStatistic(state) {
        return state.userStatistic
    }
}

export default {
    state,
    getters,
    actions,
    mutations
};
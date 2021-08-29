import axios from 'axios';
import authHeader from "@/tools/auth-api";

const state = {
    words: null,
};

const actions = {
    async saveWords({commit}, Words) {

        await axios.post('/api/words/save', Words, { headers: authHeader() }).then( response => {
            if (response.data) {
                console.log(response.data);
                commit('setWords', response.data)
            }

        })
    },
};

const mutations = {
    setWords(state, words){
        state.words = words
    },
};

export default {
    state,
    actions,
    mutations
};
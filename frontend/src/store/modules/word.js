import axios from 'axios';
import authHeader from "@/tools/auth-api";

const state = {
    words: null,
    countRepeatWords: null,
    repeatWords: null
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

    async getCountWordsToRepeat({commit}) {
        await axios.post('/api/repeat/get-count-ready-words', [], { headers: authHeader() }).then( response => {
            if (response.data) {
                // console.log(response.data.response.count)
                commit('setCountRepeatWords', response.data.response.count)
            }

        })
    },

    async getWordsToRepeat({commit}) {
        await axios.post('/api/repeat/get-ready-words', [], { headers: authHeader() }).then( response => {
            if (response.data) {
                // console.log(response.data.response.count)
                commit('setCountRepeatWords', response.data.response.count)
            }

        })
    }
};

const mutations = {
    setWords(state, words) {
        state.words = words
    },
    setCountRepeatWords(state, repeatWords) {
        console.log(repeatWords + '- тест')
        state.countRepeatWords = repeatWords
    }
};

export default {
    state,
    actions,
    mutations
};
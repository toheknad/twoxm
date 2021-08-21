import axios from "axios";

export const instance = axios.create({
    headers: {
        'Access-Control-Allow-Origin': '*',
        'withCredentials': 'true   '
    }
})

export const instanceAuth = axios.create({
    baseURL:'http://localhost:81/',
    headers: {
        'Access-Control-Allow-Origin': '*',
        'withCredentials': 'true   ',
        'Authorization': 'Bearer ' + localStorage.getItem('token')
    }
})

export const authAPI = {

    testMessage() {
        return instance.get('api/test')
    },

    register(email,password) {
        return instance.post('api/auth/signup-by-email-request', {email, password})
    },

    login(email,password) {
        return instance.post('api/auth/login', {
            email: email,
            password: password
        })
    },

}
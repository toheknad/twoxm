import axios from "axios";

export const instance = axios.create({
    baseURL:'http://localhost:81/',
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

    registration(email,password, gender, name, age) {
        return instance.post('api/auth/searcher-join-by-email-request', {
            email: email,
            password: password,
            name:name,
            gender:gender,
            age: age
        })
    },

    login(email,password) {
        return instance.post('api/auth/login', {
            email: email,
            password: password
        })
    },


    // check() {
    //     return instance.post('api/auth/login', {
    //         email: localStorage.getItem('email'),
    //         password: localStorage.getItem('password'),
    //     }).then(response => {
    //         localStorage.setItem('token', response.data.token)
    //         localStorage.setItem('email', values.email)
    //         localStorage.setItem('password', values.password)
    //     })
    // }
}
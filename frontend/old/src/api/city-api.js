import {instanceAuth, authAPI, instance} from './auth-api'


export const cityApi = {
    getCitiesToValue(value) {
        // this.check();
        return instanceAuth.post('/api/city/get-hint', {
                nameLike: value
            }
        )
    }
    // check() {
    //     return instanceAuth().post('api/auth/login', {
    //         email: localStorage.getItem('email'),
    //         password: localStorage.getItem('password'),
    //     }).then(response => {
    //         localStorage.setItem('token', response.data.token)
    //     })
    // }
}

export default cityApi



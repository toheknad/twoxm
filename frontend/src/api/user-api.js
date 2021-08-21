import {instanceAuth} from './auth-api'

export const userApi = {

    setUserStatus(status) {
        return instanceAuth.post('/user/setStatus', {
            status: status
        })
    }
}

export default userApi
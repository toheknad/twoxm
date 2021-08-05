import {authAPI} from "../../api/auth-api";

const SET_IS_AUTH = 'SET_IS_AUTH'

let initialState = {
    message:null,
    isAuth: false
}

const authReducer  = (state = initialState, action) => {
    switch (action.type){
        case SET_IS_AUTH: {
            return {...state, isAuth: action.isAuth}
        }
        default:{
            return state;
        }
    }
}

export const actions = {
    setIsAuth: (isAuth) => ({type:SET_IS_AUTH, isAuth})
}

export const changeMessageThunk = () => (dispatch) => {
    console.log('13123');
    authAPI.testMessage().then(response => {
        dispatch(actions.changeMessage(response.data.message))
    })
}

export const registrationThunk = (values) => (dispatch) => {
    authAPI.registration(values.email, values.password, values.gender, values.name, values.age).then(response => {
        console.log(response)
        authAPI.login(values.email, values.password).then(response => {
            localStorage.setItem('token', response.data.token)
            localStorage.setItem('email', values.email)
            localStorage.setItem('password', values.password)
            dispatch(actions.setIsAuth(true))
        })
    })
}

export const loginThunk = (values) => (dispatch) => {
    console.log('111111')
    console.log(values)
    authAPI.login(values.email, values.password).then(response => {
        console.log(response)
        localStorage.setItem('token', response.data.token)
        localStorage.setItem('email', values.email)
        localStorage.setItem('password', values.password)
        dispatch(actions.setIsAuth(true))
    })
}

export const logoutThunk = () => (dispatch) => {
    // authAPI.log(values.email, values.password).then(response => {
    //     console.log(response)
    //     localStorage.setItem('token', response.data.token)
    //     localStorage.setItem('email', values.email)
    //     localStorage.setItem('password', values.password)
    //     dispatch(actions.setIsAuth(true))
    // })
    localStorage.clear()
    dispatch(actions.setIsAuth(false))
}

export default authReducer;
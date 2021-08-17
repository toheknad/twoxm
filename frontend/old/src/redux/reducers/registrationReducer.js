import {authAPI} from "../../api/auth-api";
import {act} from "@testing-library/react";

const SET_USER_DATA = 'SET_USER_DATA'

let initialState = {
    email:'testestsad',
    password:null,
    phone:null,
    name:null,
    city:null,
    isAuth: false
}

const registrationReducer  = (state = initialState, action) => {
    switch (action.type){
        case SET_USER_DATA: {
            return {...state, message:action.message};
        }
        default:{
            return state;
        }
    }
}

export const actions = {
    setUserData: (email,password,phone,name,city) => ({type:'SET_USER_DATA', email,password,phone,name,city}),
}


export default registrationReducer;
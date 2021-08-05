import userApi from '../../api/user-api'
import {act} from "@testing-library/react";
import cityApi from "../../api/city-api";

const SET_IS_PICKED_STATUS = 'SET_IS_PICKED_STATUS'
const SET_STATUS = 'SET_STATUS'
const SET_MAP_ZOOM = 'SET_MAP_ZOOM'
const SET_CIRCLE_COORD = 'SET_CIRCLE_COORD'
const SET_MAP_INSTANCE = 'SET_MAP_INSTANCE'
const SET_CIRCLE_RADIUS = 'SET_CIRCLE_RADIUS'
const SET_PLACEMARK_GEOMETRY = 'SET_PLACEMARK_GEOMETRY'
const SET_CITY_VALUE = 'SET_CITY_VALUE'


let initialState = {
    isPickedStatus: false,
    status: null,
    mapState: {center: [55.831903, 37.411961], zoom: 14 },
    circleState: {coordinates: [55.831903, 37.411961], radius:1000},
    mapInstance: null,
    placemark: {center: [55.831903, 37.411961]}
}

const choiceStatusReducer  = (state = initialState, action) => {
    switch (action.type){
        case SET_IS_PICKED_STATUS:
            return {...state, isPickedStatus: action.isPicked}
        case SET_STATUS:
            return {...state, status: action.status}
        case SET_MAP_ZOOM:
            return {...state, mapState: {...state.mapState, zoom:action.zoom}}
        case SET_CIRCLE_COORD:
            return {...state, circleState: {...state.circleState ,coordinates:action.coordinates,}}
        case SET_MAP_INSTANCE:
            return {...state, mapInstance: {current: action.instance} }
        case SET_CIRCLE_RADIUS:
            return {...state, circleState: {...state.circleState ,radius:action.radius}}
        case SET_PLACEMARK_GEOMETRY:
            return {...state, placemark: {center: action.geometry }}
        case SET_CITY_VALUE:
            return {...state, cityName: action.city}
        default:{
            return state;
        }
    }
}



export const actions = {
    setIsPickedStatus: (isPicked) => ({type:SET_IS_PICKED_STATUS, isPicked}),
    setStatus: (status) => ({type:SET_STATUS, status}),
    setMapZoom: (zoom) => ({type:SET_MAP_ZOOM, zoom}),
    setCircleCoord: (coordinates) => ({type:SET_CIRCLE_COORD, coordinates}),
    setMapInstance: (instance) => ({type:SET_MAP_INSTANCE, instance}),
    setCircleRadius: (radius) => ({type:SET_CIRCLE_RADIUS, radius}),
    setPlacemarkGeometry: (geometry) => ({type:SET_PLACEMARK_GEOMETRY, geometry}),
    setCity: (city) => ({type:SET_CITY_VALUE, city})
}

export const sendUserStatusThunk = (status) => (dispatch) => {
    // userApi.setUserStatus(status).then(response => {
    //     console.log(response)
    //     dispatch(actions.setIsPickedStatus(true))
    // })
    dispatch(actions.setIsPickedStatus(true))
    dispatch(actions.setStatus(status))
}

export const getCitiesAfterChangeThunk = (value) => (dispatch) => {
    cityApi.getCitiesToValue(value).then(response => {
        console.log(response)
    })
}

export default choiceStatusReducer
import {applyMiddleware, combineReducers, createStore} from "redux"
import thunk from "redux-thunk";

import authReducer from "./reducers/authReducer";
import registrationReducer from "./reducers/registrationReducer";
import choiceStatusReducer from "./reducers/choiceStatusReducer";

let reducers = combineReducers({
    auth: authReducer,
    registration: registrationReducer,
    choiceStatus: choiceStatusReducer
})

const store = createStore(reducers, applyMiddleware(thunk));

window.__store__ = store;

export default store;

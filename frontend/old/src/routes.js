import React from 'react'
import {Switch, Route, Router} from 'react-router-dom'

import MainContainer from "./components/Main/MainContainer";
import LoginContainer from "./components/Login/LoginContainer";
import RegistrationContainer from "./components/Registration/RegistrationContainer";
import ProfileContainer from "./components/Profile/ProfileContainer";

export const useRoutes = (isAuth) => {
        // if (isAuth ){
        //     console.log('1231');
        //         return (
        //             <Switch>
        //                     <Route path="/" component={MainContainer} exact/>
        //                     <Route path="/status" component={ChoiceStatusContainer} exact/>
        //                     <Route path="/profile" component={ProfileContainer} exact/>
        //             </Switch>
        //         )
        // }
        return (
            <Switch>
                <Route path="/" component={MainContainer} exact/>
                <Route path="/profile" component={ProfileContainer} exact/>
                <Route path="/login" component={LoginContainer} exact/>
                <Route path="/registration" component={RegistrationContainer} exact/>
            </Switch>
        )
}
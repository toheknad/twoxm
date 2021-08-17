import React from 'react'
import {Redirect} from "react-router-dom";
import {connect} from "react-redux";

let mapStateToProps = (state) => {
    return {
        isAuth: state.auth.isAuth
    }
}
export const withAuthRedirect = (Component) => {

    class RedirectComponent extends React.Component {

        render() {
            if (!this.props.isAuth){
                console.log('middleware')
                return <Redirect to='/login'/>
            }
            console.log(this.props.isAuth)
            console.log('not-middlwwate')
            return <Component {...this.props} />
        }
    }
    return connect(mapStateToProps)(RedirectComponent)
}






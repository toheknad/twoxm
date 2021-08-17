import React from 'react';
import {actions, loginThunk} from '../../redux/reducers/authReducer';
import {connect} from 'react-redux';
import Login from "./Login";
import {Redirect} from "react-router-dom";

class LoginContainer extends React.Component {


    render() {
        if (this.props.isAuth) {
            console.log('ISAUTH')
            return ( <Redirect to='/profile'/> )
        }
        return (
            <Login {...this.props} onSubmit={this.props.loginThunk}/>
        )
    }
}

let mapStateToProps = (state) => {
    return {
        isAuth:state.auth.isAuth
    }
}

export default connect(mapStateToProps,{...actions, loginThunk})(LoginContainer)
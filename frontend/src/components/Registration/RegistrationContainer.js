import React from 'react'
import Registration from './Registration';
import {actions, registrationThunk} from '../../redux/reducers/authReducer';
import {connect} from 'react-redux';
import {Redirect, useHistory} from 'react-router-dom'

class RegistrationContainer extends React.Component {

    render() {
        if (this.props.isAuth) {
            return ( <Redirect to='/status'/> )
        }
        return (
            <Registration {...this.props} onSubmit={this.props.registrationThunk}/>
        )
    }
}


let mapStateToProps = (state) => {
    return {
        isAuth: state.auth.isAuth
    }
}

export default connect(mapStateToProps,{...actions, registrationThunk})(RegistrationContainer)
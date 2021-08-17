import React from "react";
import Profile from "./Profile";
import {compose} from "redux";
import {connect} from "react-redux";
import {actions, logoutThunk} from "../../redux/reducers/authReducer";

class ProfileContainer extends React.Component {

    render() {
        return (
            <Profile {...this.props} logout={this.props.logoutThunk}/>
        )
    }
}

let mapStateToProps = (state) => {
    return {
    }
}

export default compose(
    connect(mapStateToProps, {...actions, logoutThunk})
)(ProfileContainer)

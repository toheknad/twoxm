import React from "react";
import Profile from "./Profile";
import {compose} from "redux";
import {connect} from "react-redux";

class ProfileContainer extends React.Component {

    render() {
        return (
            <Profile {...this.props}/>
        )
    }
}

let mapStateToProps = (state) => {
    return {
    }
}

export default compose(
    connect(mapStateToProps)
)(ProfileContainer)

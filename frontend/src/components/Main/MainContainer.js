import React from "react";
import Main from "./Main";
import {compose} from "redux";
import {withAuthRedirect} from "../../hoc/withAuthRedirect";
import {connect} from "react-redux";

class MainContainer extends React.Component {

    render() {
        return (
            <Main {...this.props}/>
        )
    }
}

let mapStateToProps = (state) => {
    return {
    }
}

export default compose(
    connect(mapStateToProps)
)(MainContainer)

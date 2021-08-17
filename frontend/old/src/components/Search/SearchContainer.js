import React from "react";
import {withAuthRedirect} from "../../hoc/withAuthRedirect";
import {connect} from 'react-redux'
import {compose} from "redux";
import Search from "./Search";


class SearchContainer extends React.Component{

    render() {
        return (<Search {...this.props}/>)
    }
}

let mapStateToProps = state => {
    return {

    }
}

export default compose(
    connect(mapStateToProps)
)(SearchContainer)
import React from "react";
import {withAuthRedirect} from "../../hoc/withAuthRedirect";
import ChoiceStatus from "./ChoiceStatus";
import {connect} from 'react-redux';
import {compose} from "redux";
import {actions, sendUserStatusThunk} from "../../redux/reducers/choiceStatusReducer";
import {Redirect} from "react-router-dom";

class ChoiceStatusContainer extends React.Component {

    render() {
        if (this.props.isPickedStatus) {
            console.log('PICKEDDD')
            return (<Redirect to={'/status/fill/'+ this.props.status}/> )
        }
        return (<ChoiceStatus {...this.props} sendUserStatusThunk={this.props.sendUserStatusThunk}/>)
    }
}


let mapStateToProps = state => {
    return {
        isPickedStatus: state.choiceStatus.isPickedStatus,
        status: state.choiceStatus.status
    }
}

export default compose(
    connect(mapStateToProps, {...actions, sendUserStatusThunk})
)(ChoiceStatusContainer)
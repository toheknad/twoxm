import React from "react";
import {compose} from "redux";
import StatusInfoOne from "./StatusInfoOne";
import {connect} from 'react-redux'
import {actions, getCitiesAfterChangeThunk} from "../../../redux/reducers/choiceStatusReducer";


class StatusInfoOneContainer extends React.Component {
    test() {
        console.log('123')
    }

    drawCircle() {
        // console.log(e.get('target').getCenter())
        console.log(this.props.mapInstance.current.getBounds())
        console.log('1231');
        // this.props.setCircleCoord(e.get('target').getCenter())
    }

    render(){
        return (<StatusInfoOne {...this.props}
                               getCitiesAfterChangeThunk={this.props.getCitiesAfterChangeThunk}
                               onSubmit={this.test}
                               drawCircle={this.drawCircle}
        />)
    }
}

let mapStateToProps = state => {
    return {
        mapState: state.choiceStatus.mapState,
        circleState: state.choiceStatus.circleState,
        placemark: state.choiceStatus.placemark,
        mapInstance: state.choiceStatus.mapInstance,
        city: state.choiceStatus.city
    }

}
export default compose(
    connect(mapStateToProps, {...actions, getCitiesAfterChangeThunk})
)(StatusInfoOneContainer)
import React from 'react'
import {Link} from "react-router-dom";
import {connect} from 'react-redux'
import {actions, logoutThunk} from "../../redux/reducers/authReducer";
import Toolbar from '@material-ui/core/Toolbar';
import {Container, Grid} from "@material-ui/core";





export const NavbarGuest = (props) => {
    return (
        <Container fixed>
            <Grid container  justify="center" className='main-block'>
                <Link  className='nav-link-text' to="/">
                    <span>Главная</span>
                </Link>
                <Link  className='nav-link-text' to="/login">
                    <span>О сайте</span>
                </Link>
                <Link  className='nav-link-text' to="/login">
                    <span>Контакты</span>
                </Link>
                <Link  className='nav-link-text' to="/login">
                    <span>Условия использования</span>
                </Link>
            </Grid>
        </Container>
    );
}


export const NavbarAuth = (props) => {
    return (
        <Container fixed>
            <Grid container  justify="center" className='main-block'>
                <Link  className='nav-link-text' to="/login">
                    <span>Главная</span>
                </Link>
                <Link  className='nav-link-text' to="/login">
                    <span>О сайте</span>
                </Link>
                <Link  className='nav-link-text' to="/login">
                    <span>Контакты</span>
                </Link>
                <Link  className='nav-link-text' to="/login">
                    <span>Условия использования</span>
                </Link>
            </Grid>
        </Container>
    );
}


class NavbarContainer extends React.Component {

    render() {
        if(this.props.isAuth) {
            return (<NavbarAuth {...this.props} logout={this.props.logoutThunk}/>)
        }
        return (<NavbarGuest {...this.props}/>)
    }
}

let mapStateToProps = (state) => {
    return {
        isAuth: state.auth.isAuth
    }
}

export default connect(mapStateToProps,{...actions, logoutThunk})(NavbarContainer)

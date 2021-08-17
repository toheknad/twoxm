import React from 'react'
import {BrowserRouter as Router, Link} from "react-router-dom";
import './App.css';
import {useRoutes} from "./routes";
import NavbarContainer from './components/Navbar/Navbar'
import {connect} from 'react-redux'

// Importing the Bootstrap CSS

import {Col, Row, Container, Form, FormControl, Button, Nav, InputGroup} from "react-bootstrap";
import {actions} from "./redux/reducers/authReducer";

const  App = (props) => {
  const routes = useRoutes(props.isAuth)
  return (
      <Router>
          <NavbarContainer/>
          {routes}
      </Router>
  );
}

class AppContainer extends React.Component {
    componentDidMount() {
        if(localStorage.getItem('token')){
            this.props.setIsAuth(true)
        }
    }

    render() {
        return (<App {...this.props}/>)
    }
}

let mapStateToProps = (state) => {
    return {
        isAuth: state.auth.isAuth
    }
}

export default connect(mapStateToProps, {...actions})(AppContainer);

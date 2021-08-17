import React from 'react'
import {Form, Field} from "react-final-form"

import Vk from '../../img/social/105-VK.png';
import Google from '../../img/social/042-google plus.png';
import Inst from '../../img/social/044-instagram.png';
import Twitter from '../../img/social/096-twitter.png';
import {Link} from "react-router-dom";
import {Container, Grid} from "@material-ui/core";
import InputPassword from '../utils/form/InputPassword'
import InputEmail from '../utils/form/InputEmail'

let Login = (props) => {
    return (
        <Container>
            <Grid xs={12}>
                <Grid  lg={12} md={12} className="login " style={{justifyContent:'center',display:'flex', textAlign:'center'}}>
                    <Form onSubmit={props.onSubmit}
                          render={({handleSubmit}) =>
                        (
                            <form onSubmit={handleSubmit}>
                                <h2 className="login-title ">Привет, снова<span className="login-title-smile">;)</span></h2>
                                <h5 className="login-subtitle text-center">Введите ваши данные, чтобы войти</h5>

                                {/*<h4>Или с помощью других сервисов</h4>*/}
                                {/*<div className="social-login">*/}
                                {/*    <img  className="social-img" src={Google} alt="" width="32px"/>*/}
                                {/*    <img  className="social-img" src={Vk} alt="" width="32px"/>*/}
                                {/*    <img  className="social-img" src={Inst} alt="" width="32px"/>*/}
                                {/*    <img  className="social-img" src={Twitter} alt="" width="32px"/>*/}
                                {/*</div>*/}

                                <div className="form-floating mb-3" style={{marginBottom:15}}>
                                    <Field type="email" name='email'  component={InputEmail} className="form-control login-input" id="floatingInput" placeholder="name@example.com"/>
                                </div>

                                <div className="form-floating mb-3">
                                    <Field name='password' component={InputPassword} type="password" className="form-control" id="floatingInput" placeholder="1234567"/>
                                </div>

                                <div className="form-group login-group" >
                                    <div className="custom-control custom-checkbox">
                                        <input type="checkbox" className="custom-control-input" id="customCheck1" />
                                        <label className="custom-control-label remember-me" htmlFor="customCheck1">Запомнить меня</label>
                                    </div>
                                    <p className="forgot-password text-right forgot-password">
                                        Забыли <a href="#">пароль?</a>
                                    </p>
                                </div>


                                <div>
                                    <button className='default-button'>
                                        <span>Войти</span>
                                    </button>
                                </div>
                                {/*<p className='login-or text-center'>Или</p>*/}
                                {/*<p className="forgot-password text-right  forgot-passwo rd"> */}
                                <div className="mt-1">
                                    <Link to="/registration" className="default-button-outline  login-margin">Зарегистрироваться</Link>
                                </div>
                                {/*</p>*/}
                            </form>
                        )
                    }/>

                </Grid>
                {/*<Col  lg={{span:8}} md={{span:8}} className="plus">*/}
                {/*</Col>*/}
            </Grid>
        </Container>
    )
}

export default Login
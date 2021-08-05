import React from 'react'
import {Form, Field} from "react-final-form"
import {Container, Grid} from "@material-ui/core";
import InputPassword from '../utils/form/InputPassword'
import InputEmail from '../utils/form/InputEmail'


import Vk from '../../img/social/105-VK.png';
import Google from '../../img/social/042-google plus.png';
import Inst from '../../img/social/044-instagram.png';
import Twitter from '../../img/social/096-twitter.png';
import InputName from "../utils/form/InputName";
import InputPhone from "../utils/form/InputPhone";
import InputGender from "../utils/form/InputGender";
import InputCity from "../utils/form/InputCity";
import InputBirthDay from "../utils/form/InputBirthDay";



const Registration = (props) => {
    return (
        <Container>
            <Grid xs={12}>
                <Grid  lg={{span:12}} md={{span:12}} className="login flex-center">
                    <Form onSubmit={props.onSubmit}
                          render={({ handleSubmit}) =>
                            (
                                <form onSubmit={handleSubmit}>
                                    <h2 className="login-title text-center">Регистрация аккаунта</h2>
                                    <h5 className="login-subtitle text-center">Присоединитесь прямо сейчас, чтобы получить<br/> доступ ко всем функциям на сайте</h5>
                                    <div className="form-floating mb-3">
                                        <Field type="email" className="form-control" component={InputEmail} id="floatingInput" placeholder="name@example.com" name='email'/>
                                    </div>

                                    <div className="form-floating mb-3">
                                        <Field component={InputPassword} name='password' type="password" className="form-control" id="floatingInput" placeholder="123456 ( не надо )"/>
                                    </div>

                                    <div className="form-floating mb-3">
                                        <Field component={InputName} name='name'  className="form-control" id="floatingInput" placeholder="Серафим"/>
                                    </div>


                                    <div className="form-group registration-group">
                                    <Field  component={InputGender} name='gender' className="form-select">
                                        <option value="" selected>Выберите пол</option>
                                        <option value="1">Мужской</option>
                                        <option value="2">Женский</option>
                                    </Field>
                                    </div>

                                    <div className="form-group registration-group">
                                        <Field  component={InputBirthDay} name='age' className="form-select"/>
                                    </div>

                                    <div>
                                        <button className='default-button'>
                                            <span>Зарегистрироваться</span>
                                        </button>
                                    </div>
                                </form>

                        )}
                    />
                </Grid>
            </Grid>
        </Container>
    )
}

export default Registration
import React, {useState} from 'react'
import {Avatar, Container, Grid, Paper} from "@material-ui/core";
import {Link} from "react-router-dom";

import makeStyles from "@material-ui/core/styles/makeStyles";

// import MainImage from '../../img/Main/ebbinghaus.jpg'
import MainImage from '../../img/Main/17973872.png'
import {forEach} from "react-bootstrap/ElementChildren";
import FirstIcon from '../../img/Profile/052-snapchat.png'
import SecondIcon from '../../img/Profile/061-discord.png'
import ThirdIcon from '../../img/Profile/049-messenger.png'
import UserImg from '../../img/Profile/e4dvJJMEDKE.jpeg'
import MyQuestionImg from '../../img/Profile/067-mortarboard.png'

import ArrowForwardIosIcon from '@material-ui/icons/ArrowForwardIos';
import SvgIcon from "@material-ui/icons/ArrowForwardIos";


const useStyles = makeStyles((theme) => ({
    root: {
        display: 'flex',
        flexWrap: 'wrap',
        justifyContent: 'center'
    },
    textField: {
        marginLeft: theme.spacing(1),
        marginRight: theme.spacing(1),
        width: '25ch',
    },
}));

let Profile = (props) => {
    const classes = useStyles();


    return (

        <main >
            <Container fixed>
                <Grid container  justify="center" className='main-block' spacing={3}>
                    <Grid item xs={12} md={6} className="main-right" style={{marginTop:75}}>
                        <Paper className="paper background-sky-light profile-block-user">
                            <img className='default-img' src={ThirdIcon}/>
                            <h4 className='title profile-title'>Даниил Янушковский</h4>
                            <button className='default-button btn-half btn-sky'>
                                <Link className="link-for-white" onClick={props.logout}>Выйти</Link>
                            </button>
                            <div className="flex-center" style={{paddingBottom:25}}>
                                <div className="profile-block-statistic profile-border">
                                    <p className="profile-value-statistic">53</p>
                                    <p className="profile-under-value-statistic">Создано</p>
                                </div>
                                <div className="profile-block-statistic profile-border">
                                    <p className="profile-value-statistic">#1000+</p>
                                    <p className="profile-under-value-statistic">Рейтинг</p>
                                </div>
                                <div className="profile-block-statistic">
                                    <p className="profile-value-statistic">10</p>
                                    <p className="profile-under-value-statistic">Отвечено</p>
                                </div>
                            </div>
                        </Paper>
                    </Grid>


                    <Grid item xs={3} md={3} className="main-right" style={{marginTop:75}}>
                        <Paper className="paper background-pink">
                            <img className='default-img' src={MyQuestionImg}/>
                            <h4 className='paper-title-small'>Мои вопросы</h4>
                            <button className='default-button btn-half btn-white' style={{width:'80%'}}>
                                <Link className="link-for-white" to='/login'>Создать</Link>
                            </button>
                            <button className='default-button btn-half btn-white' style={{width:'80%'}}>
                                <Link className="link-for-white" to='/login'>Посмотреть все</Link>
                            </button>
                        </Paper>
                    </Grid>


                    <Grid item xs={3} md={3} className="main-right" style={{marginTop:75}}>
                        <Paper className="paper background-sky">
                            <img className='default-img' src={FirstIcon}/>
                            <h4 className='paper-title-small'>Активность</h4>
                            <button className='default-button btn-half btn-white' style={{width:'80%'}}>
                                <Link className="link-for-white" to='/login'>Вопросы</Link>
                            </button>
                            <button className='default-button btn-half btn-white' style={{width:'80%'}}>
                                <Link className="link-for-white" to='/login'>Комментарии</Link>
                            </button>
                        </Paper>
                    </Grid>

                    {/*<Grid item xs={3} md={3} className="main-right" style={{marginTop:75}}>*/}
                    {/*    <Grid item xs={12}  style={{marginBottom:25}}>*/}
                    {/*        <h4>Мои вопросы</h4>*/}
                    {/*        <Paper className="profile-block-question">*/}
                    {/*            <Grid container >*/}
                    {/*                <Grid item xs={10}  style={{textAlign:'left', paddingLeft:20}}>*/}
                    {/*                    <p className="profile-title-question">Вопрос жизни и смерти</p>*/}
                    {/*                    /!*<div className="profile-subtitle-qeustion">*!/*/}
                    {/*                    /!*    <span>@toheknad</span>*!/*/}
                    {/*                    /!*</div>*!/*/}
                    {/*                </Grid>*/}
                    {/*                <Grid item xs={2}>*/}
                    {/*                    <SvgIcon className="profile-arrow-question">*/}
                    {/*                    </SvgIcon>*/}
                    {/*                </Grid>*/}
                    {/*            </Grid>*/}
                    {/*        </Paper>*/}
                    {/*    </Grid>*/}

                    {/*    <Grid item xs={12}  style={{marginBottom:25}}>*/}
                    {/*        <Paper className="profile-block-question">*/}
                    {/*            <Grid container >*/}
                    {/*                <Grid item xs={10}  style={{textAlign:'left', paddingLeft:20}}>*/}
                    {/*                    <p className="profile-title-question">Вопрос жизни и смерти</p>*/}
                    {/*                    /!*<div className="profile-subtitle-qeustion">*!/*/}
                    {/*                    /!*    <span>@toheknad</span>*!/*/}
                    {/*                    /!*</div>*!/*/}
                    {/*                </Grid>*/}
                    {/*                <Grid item xs={2}>*/}
                    {/*                    <SvgIcon className="profile-arrow-question">*/}
                    {/*                    </SvgIcon>*/}
                    {/*                </Grid>*/}
                    {/*            </Grid>*/}
                    {/*        </Paper>*/}
                    {/*    </Grid>*/}

                    {/*    <Grid item xs={12}  style={{marginBottom:25}}>*/}
                    {/*        <Paper className="profile-block-question">*/}
                    {/*            <Grid container >*/}
                    {/*                <Grid item xs={10}  style={{textAlign:'left', paddingLeft:20}}>*/}
                    {/*                    <p className="profile-title-question">Вопрос жизни и смерти</p>*/}
                    {/*                    /!*<div className="profile-subtitle-qeustion">*!/*/}
                    {/*                    /!*    <span>@toheknad</span>*!/*/}
                    {/*                    /!*</div>*!/*/}
                    {/*                </Grid>*/}
                    {/*                <Grid item xs={2}>*/}
                    {/*                    <SvgIcon className="profile-arrow-question">*/}
                    {/*                    </SvgIcon>*/}
                    {/*                </Grid>*/}
                    {/*            </Grid>*/}
                    {/*        </Paper>*/}
                    {/*    </Grid>*/}

                    {/*</Grid>*/}


                </Grid>
                <Grid container  justify="center" className='main-block' spacing={3}>
                    <Grid item xs={12} md={4} className="main-right" style={{marginTop:75}}>
                        <Paper className="paper background-pink">
                            <img className='default-img' src={FirstIcon}/>
                            <h4 className='paper-title'>Необычные</h4>
                            <p className='subtitle paper-subtitle'>1424 вопросов</p>
                            <button className='default-button btn-half btn-white'>
                                <Link className="link-for-white" to='/login'>Посмотреть все</Link>
                            </button>
                        </Paper>
                    </Grid>
                    <Grid item xs={12} md={4} className="main-right" style={{marginTop:75}}>
                        <Paper className='paper background-sky'>
                            <img className='default-img' src={SecondIcon}/>
                            <h4 className='paper-title'>От людей</h4>
                            <p className='subtitle paper-subtitle'>5150 вопросов</p>
                            <button className='default-button btn-half btn-white'>
                                <Link className="link-for-white" to='/login'>Посмотреть все</Link>
                            </button>
                        </Paper>
                    </Grid>
                    <Grid item xs={12} md={4} className="main-right" style={{marginTop:75}}>
                        <Paper className="paper background-sky-light">
                            <img className='default-img' src={ThirdIcon}/>
                            <h4 className='paper-title'>Безумие</h4>
                            <p className='subtitle paper-subtitle'>1424 вопросов</p>
                            <button className='default-button btn-half btn-white'>
                                <Link className="link-for-white" to='/login'>Посмотреть все</Link>
                            </button>
                        </Paper>
                    </Grid>
                </Grid>
            </Container>
            <footer >

            </footer>

        </main>
    )
}

export default Profile
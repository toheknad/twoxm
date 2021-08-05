import React from 'react'
import {Container, Grid} from "@material-ui/core";

import Men from '../../img/Choice/20943632.jpg';
import {Link} from "react-router-dom";
import {sendUserStatusThunk} from "../../redux/reducers/choiceStatusReducer";


let ChoiceStatus = (props) => {

    return (
        <Container>
            <Grid container >
                <Grid  xs={6} lg={5} md={5} className="choice-left-block ">
                    <h1 className="choice-title text-center">Я ищу <span className='choice-title-dots'>...</span></h1>
                    <p className="choice-subtitle text-center">Выберите статусы, которые подходят вам</p> 


                    <div className='mb-3'>
                        <button  onClick={() => props.sendUserStatusThunk(1)} className="default-button btn-center" type="submit">
                            <span>Человека, чтобы жить вместе</span>
                        </button>
                    </div>
                    <div className='mb-3'>
                        <button  onClick={() => props.sendUserStatusThunk(2)} className="default-button btn-center" type="submit">
                            <span>Человека на подселение</span>
                        </button>
                    </div>
                    <div className='mb-3'>
                        <Link to="/search" className="default-button-outline">Пропустить</Link>
                    </div>

                </Grid>
                <Grid  xs={6} lg={5} md={5}>
                    <img src={Men} alt='13' width="757px" style={{marginLeft:10}}/>
                </Grid>
            </Grid>
    </Container>
    )
}

export default ChoiceStatus
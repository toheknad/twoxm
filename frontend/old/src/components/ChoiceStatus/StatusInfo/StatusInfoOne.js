import React, {useRef} from 'react'
import {Container, Grid} from "@material-ui/core";
import {Form, Field} from 'react-final-form'
import {
    YMaps,
    Map,
    SearchControl,
    ZoomControl,
    Placemark,
    Circle,
    FullscreenControl,
    GeolocationControl
} from 'react-yandex-maps';
import {Link} from "react-router-dom";
import InputCity from "../../utils/form/InputCity";

import Button from '@material-ui/core/Button';
import TextField from '@material-ui/core/TextField';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogContentText from '@material-ui/core/DialogContentText';
import DialogTitle from '@material-ui/core/DialogTitle';
import ButtonGroup from "@material-ui/core/ButtonGroup";

import ReactSelect from 'react-select-cities';

import Select from 'react-select';
import AsyncSelect from 'react-select/async';
// import 'react-select/dist/react-select.css';


let StatusInfoOne = (props) => {


    const [open, setOpen] = React.useState(false);

    const handleClickOpen = () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
    };

    const mapState = props.mapState;
    const circleState = [props.circleState.coordinates, props.circleState.radius];
    const placemark = props.placemark.center;

    const circleManager = useRef(null);
    const placemarkManager = useRef(null);
    const map = useRef(null);
    const ymaps = useRef(null);

    const onBoundChange = (e) => {
        props.setCircleCoord(e.get('target').getCenter())
    }

    const onDrag = e => {
        console.log(e.get('target'));
    }

    const onActionBegin = (e) => {
        props.setPlacemarkGeometry(map.current.options.get('projection').fromGlobalPixels(e.get('tick').globalPixelCenter,e.get('tick').zoom ))
    }

    let setCircleRadius = (radius, zoom) => {
        props.setCircleRadius(radius)
        props.setMapZoom(zoom)
    }

    const loadOptions = (inputValue, callback) => {
        setTimeout(() => {
            callback(props.getCitiesAfterChangeThunk(inputValue));
        }, 1000);
    };

    const handleInputChange = (newValue) => {
        props.setCity({ newValue });
        return newValue;
    };




    return (

        <Container>
            <Grid container >
                <Grid  xs={6} lg={5} md={5} className="choice-left-block ">
                    <h1 className="choice-title text-center">Еще чуть-чуть <span className='choice-title-dots'>!</span></h1>
                    <p className="choice-subtitle text-center">Заполните информацию о себе</p>

                    <Form onSubmit={props.onSubmit} render={({handleSubmit}) =>
                        (
                            <form onSubmit={handleSubmit}>
                                {/*<Field name="city" component={InputCity}/>*/}
                                {/*<Select options={options} />*/}
                                <AsyncSelect
                                    cacheOptions
                                    loadOptions={loadOptions}
                                    defaultOptions
                                    onInputChange={handleInputChange}
                                />
                                <button className='default-button' onClick={handleClickOpen}>Точный адрес</button>
                            </form>
                        )}
                    />
                </Grid>
            </Grid>
            <Dialog open={open} onClose={handleClose} aria-labelledby="form-dialog-title">
                <DialogTitle id="form-dialog-title">Выбор Город/Радиус</DialogTitle>
                <DialogContent>
                    <DialogContentText>
                        С помощью указанных данных мы сможем точнее искать для вас. Если вы ищете квартиру в определенном месте,
                        то укажите радиус, для более точного поиска
                    </DialogContentText>

                    <YMaps  query={{apikey: '94dd5d22-0258-474a-b752-3add0ab0d6d7', lang:'ru_RU'}}>
                        {/*<div>My awesome application with maps!</div>*/}
                        <Map
                            style={{width:'100%', height:400}}
                            state={mapState}
                            onBoundsChange={onBoundChange}
                            instanceRef={map}
                            onLoad={ymapsInstance => {
                                // Также способ сохранить ymaps в переменную
                                ymaps.current = ymapsInstance;
                            }}
                            onActionTick={(e) => onActionBegin(e)}
                        >
                            <SearchControl options={{fitMaxWidth:'true', kind:'district'}} />
                            <Placemark
                                geometry={placemark}
                                instanceRef={placemarkManager}
                                onDrag={onDrag}
                            />
                            <ZoomControl options={{ float: 'right'}} />
                            <Circle
                                instanceRef={circleManager}
                                geometry={circleState}
                            />
                            <FullscreenControl />
                            <GeolocationControl options={{ float: 'left' }} />
                        </Map>

                    </YMaps>
                    <p>Радиус поиска, км</p>
                    <ButtonGroup color="primary" aria-label="outlined primary button group">
                        <Button onClick={() => setCircleRadius(1000,14)}>1</Button>
                        <Button onClick={() => setCircleRadius(5000,11)}>5</Button>
                        <Button onClick={() => setCircleRadius(10000,10)}>10</Button>
                        <Button onClick={() => setCircleRadius(25000,9)}>25</Button>
                        <Button onClick={() => setCircleRadius(50000,8)}>50</Button>
                        <Button onClick={() => setCircleRadius(100000,7)}>100</Button>
                    </ButtonGroup>
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleClose} color="primary">
                        Отменить
                    </Button>
                    <Button onClick={handleClose} color="primary">
                        Сохранить
                    </Button>
                </DialogActions>
            </Dialog>
    </Container>

    )
}

export default StatusInfoOne
import React from 'react';
import TextField from "@material-ui/core/TextField";



export const InputCity = (props) => {
    return (
    <TextField
        id="outlined-email-input"
        label="Город"
        autoComplete={props.input.name}
        margin="normal"
        variant="outlined"
        name={props.input.name}
        value={props.input.value}
        onChange={props.input.onChange}
        style={{width:'100%'}}
    />

    );
}

export default InputCity
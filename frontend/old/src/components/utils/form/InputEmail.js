import React from 'react';
import TextField from "@material-ui/core/TextField";



export const InputEmail = (props) => {
    return (
        // <TextField
        //     id="outlined-textarea"
        //     label="Тут email"
        //     placeholder="Тут email"
        //     multiline
        //     type='email'
        //     variant="outlined"
        //     name={props.input.name}
        //     value={props.input.value}
        //     onChange={props.input.onChange}
        // />
    <TextField
        id="outlined-email-input"
        label="Почта"
        type="email"
        autoComplete="email"
        margin="normal"
        variant="outlined"
        name={props.input.name}
        value={props.input.value}
        onChange={props.input.onChange}
        style={{width:'100%'}}
    />
    );
}

export default InputEmail
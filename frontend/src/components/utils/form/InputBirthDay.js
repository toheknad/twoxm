import React from 'react';
import TextField from "@material-ui/core/TextField";
import InputMask from "react-input-mask";
import FormControl from "@material-ui/core/FormControl";
import InputLabel from "@material-ui/core/InputLabel";
import Select from "@material-ui/core/Select";

export const InputBirthDay = (props) => {
    return (
    <TextField className='default-input'
        id="date"
        label="Дата рождения"
        type="date"
               variant="outlined"
        defaultValue="2000-05-25"
        name={props.input.name}
        value={props.input.value}
        onChange={props.input.onChange}
        InputLabelProps={{
            shrink: true,
        }}
    />
    );
}

export default InputBirthDay
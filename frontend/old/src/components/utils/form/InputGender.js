import React from 'react';
import TextField from "@material-ui/core/TextField";
import InputMask from "react-input-mask";
import FormControl from "@material-ui/core/FormControl";
import InputLabel from "@material-ui/core/InputLabel";
import Select from "@material-ui/core/Select";

export const InputGender = (props) => {
    return (
        <FormControl variant="outlined" style={{width:'100%'}}>
            <InputLabel htmlFor="outlined-age-native-simple">Пол</InputLabel>
            <Select
                native
                label="Пол"
                name={props.input.name}
                value={props.input.value}
                onChange={props.input.onChange}
            >
                <option aria-label="None" value="" />
                <option value='male'>Мужской</option>
                <option value='female'>Женский</option>
            </Select>
        </FormControl>
    );
}

export default InputGender
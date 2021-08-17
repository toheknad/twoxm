import React from 'react';
import TextField from "@material-ui/core/TextField";
import InputMask from "react-input-mask";

class PhoneInput extends React.Component {
    render() {
        return <InputMask {...this.props} mask="+7 (999) 999 99 99" maskChar=" " />;
    }
}



export const InputPhone = (props) => {
    return (
    <TextField
        id="outlined-email-input"
        label="Телефон"
        type="phone"
        autoComplete="phone"
        margin="normal"
        variant="outlined"
        name={props.input.name}
        value={props.input.value}
        onChange={props.input.onChange}
        style={{width:'100%'}}
        inputComponent={PhoneInput}
    />
    );
}

export default InputPhone
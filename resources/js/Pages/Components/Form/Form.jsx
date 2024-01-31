import React from "react";

const Form = ({ onSubmit, children }) => {
    return (
        <React.Fragment>
            <form onSubmit={onSubmit}>
                {children}
            </form>
        </React.Fragment>
    );
}

export default Form;

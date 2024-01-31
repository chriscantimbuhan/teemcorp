import React from "react";

const Button = ({ label, type }) => {
    return (
        <React.Fragment>
            <button type={type} className="px-4 py-2 text-sm text-blue-100 bg-blue-500 rounded shadow">
                {label}
            </button>
        </React.Fragment>
    );
}

export default Button;
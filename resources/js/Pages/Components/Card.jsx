import React from "react";

const Card = ({ children }) => {
    return (
        <div className="w-full rounded-lg shadow-md">
            {children}
        </div>
    );
}

export default Card;

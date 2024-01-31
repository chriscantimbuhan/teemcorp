import React from 'react';

const Dropdown = ({inputLabel, name, options, onChange }) => {
    return (
        <React.Fragment>
            <div className="mb-3">
            <label className="block text-sm font-medium leading-6 text-gray-900">
                {inputLabel}
              </label>
              <div className="mt-2">
                <select
                  id={name}
                  name={name}
                  onChange={onChange}
                  className="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
                
                {Object.keys(options).map(option => (
                    <option key={option} value={options[option]['value']}>{options[option]['label']}</option>
                ))}

                </select>
              </div>
            </div>
        </React.Fragment>
    );
}

export default Dropdown;
import React, { useEffect, useState } from "react";
import MasterPage from "../Components/MasterPage";
import Form from "../Components/Form/Form";
import Input from "../Components/Form/Input";
import Card from "../Components/Card";
import Button from "../Components/Button";
import Dropdown from "../Components/Form/Dropdown";
import Login from "../Login";

const Index = ({ options, search_types }) => {

    const [formData, setFormData] = useState({
        search_type: '',
        symbol: '',
    });

    const [result, setResult] = useState([]);
    const [loading, setLoading] = useState('');

    const handleInputChange = (event) => {
        const { name, value } = event.target;
        setFormData((prevFormData) => ({
            ...prevFormData,
            [name]: value,
        }));
    };


    function buildQueryString(params) {
        return Object.keys(params)
            .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(params[key]))
            .join('&');
    }

    const handleSubmit = (e) => {
        e.preventDefault();

        setResult([]);
        setLoading('');
        setLoading('Please wait...');

        const xhr = new XMLHttpRequest();

        xhr.open('GET', `/api/financial-model/search?${buildQueryString(formData)}`, true);
        xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('access_token'));
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status >= 200 && xhr.status < 300) {
                    console.log(xhr.response);
                    if (Object.keys(xhr.response).length == 0) {
                        setLoading('No data available.');
                    } else {
                        setResult(JSON.parse(xhr.response));
                    }
                } else {
                    console.error('HTTP error! Status:', xhr.status);
                }
            }
        };

        xhr.send(formData);
    };

    return (
        <React.Fragment>
            {localStorage.getItem('access_token') ?
            <MasterPage>
                <div className="flex">
                    <div className="w-2/6 mt-6">
                        <Card>
                            <div className="p-4">
                                <div>
                                    <h4 className="text-xl font-semibold tracking-tight text-blue-600">
                                        Filters
                                    </h4>
                                </div>
                                    <Form onSubmit={handleSubmit}> 
                                    <div id='generalError' className='text-red-500 text-xs mt-1'></div>
                                    <div className="mb-3">
                                        <Dropdown
                                            inputLabel='Search Type'
                                            options={search_types}
                                            name='search_type'
                                            onChange={handleInputChange}
                                        />
                                        {Object.keys(options).map(option => (
                                            <Input
                                                key={option}
                                                type='text'
                                                inputLabel={options[option]['label']}
                                                name={options[option]['key']}
                                                placeholder={options[option]['label']}
                                                onChange={handleInputChange}
                                                />
                                        ))}
                                    </div>

                                    <Button label='Search' type='submit'/>
                                </Form>
                            </div>
                        </Card>
                    </div>
                    <div className="w-4/6 mt-6 ml-3">
                        <Card>
                        {Object.keys(result).length > 0 ?
                            <div className="p-4">
                                <h4 className="text-xl font-semibold tracking-tight text-blue-600">
                                    Result:
                                </h4>
                                <div>
                                    <ul>
                                        {Object.keys(result).map(key => (
                                            <li key={key}>
                                                <strong>{key}:</strong> {result[key]}
                                            </li>
                                        ))}
                                    </ul>
                                </div>
                            </div>
                        : loading ? <div className="bg-blue-400 text-white px-5 py-5 font-semibold">{loading}</div> : ''}
                        </Card>
                    </div>
                </div>
            </MasterPage>
            : <Login/>}
        </React.Fragment>
    );
};

export default Index;
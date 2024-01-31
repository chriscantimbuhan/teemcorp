import React, { useState } from "react";
import MasterPage from "./Components/MasterPage";
import Card from "./Components/Card";
import Form from "./Components/Form/Form";
import Input from "./Components/Form/Input";
import Button from "./Components/Button";

const Login = () => {
    const [formData, setFormData] = useState({
        username: '',
        passowrd: '',
    });

    const handleInputChange = (event) => {
        const { name, value } = event.target;
        setFormData((prevFormData) => ({
            ...prevFormData,
            [name]: value,
        }));
    };
    

    const handleSubmit = (e) => {
        e.preventDefault();

        const xhr = new XMLHttpRequest();

        xhr.open('POST', '/api/user-login', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onload = () => {

             let response = JSON.parse(xhr.responseText);

            if (xhr.status === 200) {

                localStorage.setItem('access_token', response.access_token);

                location.href = '/';

                document.getElementById('generalError').textContent = '';
                manageInvalidFeedbacks();
            } else {
                let generalMessage = response.message ?? '';

                manageInvalidFeedbacks(response.errors);
                document.getElementById('generalError').textContent = generalMessage;
            }
        };

        xhr.send(JSON.stringify(formData));
    };

    return (
        <React.Fragment>
            <MasterPage>
                <div className="grid">
                    <div className="w-1/2 place-self-center mt-6">
                        <Card>
                            <div className="p-4">
                                <div>
                                    <h4 className="text-xl font-semibold tracking-tight text-blue-600">
                                        Login
                                    </h4>
                                </div>
                                    <Form onSubmit={handleSubmit}>
                                    <div id='generalError' className='text-red-500 text-xs mt-1'></div>
                                    <div className="mb-3">
                                        <Input
                                            type='text'
                                            inputLabel='Username'
                                            name='username'
                                            placeholder='Username'
                                            value={formData.username}
                                            onChange={handleInputChange}
                                        />
                                        <Input
                                            type='password'
                                            inputLabel='Password'
                                            name='password'
                                            placeholder='Password'
                                            value={formData.password}
                                            onChange={handleInputChange}
                                        />
                                    </div>

                                    <Button label='Login' type='submit'/>
                                </Form>
                            </div>
                        </Card>
                    </div>
                </div>
            </MasterPage>
        </React.Fragment>

    );
};

export default Login;
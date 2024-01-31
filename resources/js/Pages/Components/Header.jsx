import React, {useState} from "react";
import { Dialog, Popover } from '@headlessui/react'
import {
    Bars3Icon,
    XMarkIcon,
} from '@heroicons/react/24/outline'
import { InertiaLink } from "@inertiajs/inertia-react";

const Header = () => {
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

    const logout = async (e) => {
        e.preventDefault();

        const xhr = new XMLHttpRequest();

        xhr.open('DELETE','api/logout', true);
        xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('access_token'));
        xhr.setRequestHeader('Content-Type', 'application/json');

        console.log(xhr);


        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {    
                if (xhr.status === 204) {
                    localStorage.removeItem('access_token');

                    location.href = '/';
                } else {
                    // Handle other status codes
                    console.error('Logout failed. HTTP error:', xhr.status);
                }
            }
        };


        xhr.send();


        // try {
        //     const response = await fetch('/api/logout', {
        //         method: 'DELETE',
        //         headers: {
        //             'Content-Type': 'application/json',
        //         },
        //     });

        //     console.log(response);
        // } catch (error) {
        //     console.error('An error occurred:', error); 
        // }

        // try {
        //     const response = await fetch('/api/logout', {
        //         method: 'DELETE',
        //         headers: {
        //             'Content-Type': 'application/json',
        //         },
        //     });
    
        //     console.log(response);

        //     if (response.ok) {
        //         localStorage.removeItem('access_token');
        //     } else {
        //         console.error('HTTP error! Status:', response.status);
        //     }
        // } catch (error) {
        //     console.error('An error occurred:', error);
        // }
    };

    return (
        <React.Fragment>
            <header className="bg-white border-solid border-2">
                <nav className="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
                    <div className="flex lg:hidden">
                    <button
                        type="button"
                        className="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                        onClick={() => setMobileMenuOpen(true)}
                    >
                        <span className="sr-only">Open main menu</span>
                        <Bars3Icon className="h-6 w-6" aria-hidden="true" />
                    </button>
                    </div>
                    <Popover.Group className="hidden lg:flex lg:gap-x-12">
                    <a href="/" className="text-sm font-semibold leading-6 text-gray-900">
                        Dashboard
                    </a>
                    </Popover.Group>

                    <div className="hidden lg:flex lg:flex-1 lg:justify-end flex space-x-4">
                        
                        <InertiaLink href="/sign-up">
                            <button className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Sign Up
                            </button>
                        </InertiaLink>
                        {! localStorage.getItem('access_token') ?
                        <InertiaLink href="/login">
                        <button className="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Login
                        </button>
                        </InertiaLink>
                        :

                        <button onClick={logout} className="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Logout
                        </button>
                        }
                    </div>
                </nav>
                <Dialog as="div" className="lg:hidden" open={mobileMenuOpen} onClose={setMobileMenuOpen}>
                    <div className="fixed inset-0 z-10" />
                    <Dialog.Panel className="
                        fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
                    >
                        <div className="flex items-center justify-between">
                            <button
                            type="button"
                            className="-m-2.5 rounded-md p-2.5 text-gray-700"
                            onClick={() => setMobileMenuOpen(false)}
                            >
                            <span className="sr-only">Close menu</span>
                            <XMarkIcon className="h-6 w-6" aria-hidden="true" />
                            </button>
                        </div>
                        <div className="mt-6 flow-root">
                            <div className="-my-6 divide-y divide-gray-500/10">
                            <div className="space-y-2 py-6">
                                <a
                                href="/"
                                className="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                >
                                Dashboard
                                </a>
                            </div>
                            <div className="py-6">
                            <a
                                href="#"
                                className="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                >
                                Sign Up
                                </a>

                                <a
                                href="#"
                                className="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                >
                                Log in
                                </a>
                            </div>
                            </div>
                        </div>
                    </Dialog.Panel>
                </Dialog>
            </header>
        </React.Fragment>
    )
}

export default Header;

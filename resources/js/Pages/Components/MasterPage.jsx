import React, {useState} from "react";
import { Dialog, Popover } from '@headlessui/react'
import {
  Bars3Icon,
  XMarkIcon,
} from '@heroicons/react/24/outline'
import Header from "./Header";
import Card from "./Card";

const MasterPage = ({ children }) => {    
    return (
        <React.Fragment>
            <Header />
            <div className="relative mx-auto lg:max-w-7xl">
                {children}
            </div>
        </React.Fragment>
    );
};

export default MasterPage;
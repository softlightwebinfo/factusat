import React, {Component} from 'react';
import BodyFondo from "../components/BodyFondo";
import {urlPublic} from "../helps/urls";
import Cards from "../components/Cards";
import Avatar from "../components/Avatar";
import Form from "../components/Form";
import FormGroup from "../components/FormGroup";
import Input from "../components/Input";
import Button from "../components/Button";
import LoginCard from "../components/LoginCard";
import Absolute from "../components/Absolute";
import Timer from "../components/Timer";

class LoginPage extends Component {
    constructor() {
        super();
        this.state = {};
    }

    render() {
        let classes = {
            name: 'R-Cards'
        };
        return (
            <BodyFondo fondo={urlPublic('img/login.jpg')}>
                <LoginCard/>
                <Absolute
                    bottom
                    right
                >
                    <Timer/>
                </Absolute>
            </BodyFondo>
        );
    }
}

export default LoginPage;
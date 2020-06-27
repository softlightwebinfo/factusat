import React, {Component} from 'react';
import BodyFondo from "../components/BodyFondo";
import {urlPublic} from "../helps/urls";
import LoginCard from "../components/LoginCard";
import Absolute from "../components/Absolute";
import Timer from "../components/Timer";
import {login} from "../actions/login";
import {connect} from 'react-redux';
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
                <LoginCard
                    submit={(data) => this.props.dispatch(login(data))}
                />
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

export default connect(state => state)(LoginPage);

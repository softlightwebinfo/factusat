import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import Cards from "./Cards";
import Form from "./Form";
import FormGroup from "./FormGroup";
import Input from "./Input";
import Button from "./Button";
import Avatar from "./Avatar";
import {urlPublic} from "../helps/urls";

class LoginCard extends Component {
    constructor(props) {
        super(props);
        this.state = {
            email: "codeunic.system@gmail.com",
            password: "1234",
        };
    }
    
    
    render() {
        var classes = {
            name: 'R-LoginCard',
            modifiers: ['large', 'large-xl', 'circle']
        };
        return (
            <Cards className={cx(classes, this.props, this.props.className)}>
                <Form>
                    <Avatar
                        img={urlPublic('img/avatar_2x.png')}
                        large-xl
                        circle
                        className="R-LoginCard__avatar"
                    />
                    <p className="R-LoginCard__name">
                        {/*Rafa G.*/}
                    </p>
                    <FormGroup>
                        <Input
                            value={this.state.email}
                            onChange={e => this.setState({email: e.target.value})}
                            placeholder="Correo Electronico"
                        />
                    </FormGroup>
                    <FormGroup>
                        <Input
                            onChange={e => this.setState({password: e.target.value})}
                            value={this.state.password}
                            placeholder="Contraseña"
                        />
                    </FormGroup>
                    <Button
                        onClick={e => this.props.submit(this.state)}
                        default
                        block
                    >
                        Iniciar Sesión
                    </Button>
                </Form>
            </Cards>
        
        );
    }
}

LoginCard.propTypes = {
    className: PropTypes.string,
};
export default LoginCard;

import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import Cards from "./Cards";
import Form from "./Form";
import FormGroup from "./FormGroup";
import Input from "./Input";
import Button from "./Button";
import Avatar from "./Avatar";
import {urlPublic} from "../helps/urls";

class LoginCard extends PureComponent {
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
                            placeholder="Correo Electronico"
                        />
                    </FormGroup>
                    <FormGroup>
                        <Input
                            placeholder="Contraseña"
                        />
                    </FormGroup>
                    <Button
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
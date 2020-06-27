import React, {Component} from 'react';
import PropTypes from 'prop-types';
import Icon from "./Icon";
import cx from 'bem-classnames';
import Walkthrough from "./Walkthrough";
import {Link} from "react-router-dom";
import {url} from '../helps/urls';

class Navbar extends Component {
    imprimir() {
        window.print();
    }
    render() {
        let classes = {
            name: 'R-Navbar',
            modifiers: []
        };
        return (
            <header className={cx(classes, this.props, this.props.className)}>
                <Walkthrough
                    button="Imprimir"
                    onClick={e => this.imprimir()}
                >
                    <Link to={url('')}>Pagina Principal</Link>
                    <Link to={url('reparaciones/nueva-reparacion')}>Nueva reparación</Link>
                </Walkthrough>
            </header>
        );
    }
}

Navbar.propTypes = {
    className: PropTypes.string,
    children: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.element
    ]),
};
export default Navbar;
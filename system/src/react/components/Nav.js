import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import {Link} from "react-router-dom";
import {url} from '../helps/urls';
import LanguagesDropdown from "./LanguagesDropdown";
import MenuSlider from "./MenuSlider";

class Nav extends PureComponent {
    render() {
        var classes = {
            header: {
                name: 'R-Nav',
                modifiers: ['fixed']
            },
            nav: {
                name: `R-Nav__nav`,
                modifiers: []
            },

            title: {
                name: `R-Nav__title`,
                modifiers: []
            },
            menu: {
                name: `R-Nav__menu`,
                modifiers: []
            },

        };
        return (
            <header className={cx(classes.header, this.props, this.props.className)}>
                <nav className={cx(classes.nav, this.props, this.props.className, 'container')}>
                    <MenuSlider/>
                    <h2 className={cx(classes.title, this.props, this.props.className)}>
                        <Link to={url('')}>{this.props.aplication.nombre}</Link>
                    </h2>
                    <ul className={cx(classes.menu, this.props, this.props.className)}>
                        {this.props.children}
                    </ul>
                    <LanguagesDropdown/>
                </nav>
            </header>

        );
    }
}

export default Nav;
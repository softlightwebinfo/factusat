import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import classNames from 'classnames';
import {Link} from "react-router-dom";

class Target extends Component {
    render() {
        var classes = {
            name: 'R-Target',
            modifiers: []
        };
        return (
            <Link
                to={this.props.link}
                className={cx(classes, this.props, this.props.className)}
            >
                <i className={classNames(this.props.icon, 'R-Target__icon')}></i>
                <h4 className="R-Target__title">{this.props.title}</h4>
                <div className="R-Target__fondo"></div>
                {this.props.children}
            </Link>
        );
    }
}

Target.propTypes = {
    className: PropTypes.string,
    icon: PropTypes.string,
    title: PropTypes.string,
    link: PropTypes.string,
};
export default Target;
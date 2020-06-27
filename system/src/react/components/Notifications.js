import React, {Component} from 'react';
import PropTypes from 'prop-types';
import Icon from "./Icon";
import cx from 'bem-classnames';

class Notifications extends Component {
    render() {
        let classes = {
            name: 'R-Notifications',
            modifiers: []
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                {this.props.children}
            </div>
        );
    }
}

Notifications.propTypes = {
    className: PropTypes.string,
    children: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.element,
        PropTypes.array,
    ]),
};
export default Notifications;
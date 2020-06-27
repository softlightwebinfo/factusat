import React, {Component} from 'react';
import PropTypes from 'prop-types';
import Icon from "./Icon";
import cx from 'bem-classnames';

class Alert extends Component {
    close() {
        if (!this.props.showClose) return;
        return (
            <Icon icon="close"/>
        );
    }

    iconLeft() {
        if (this.props.iconLeft) return;
        return (
            <Icon icon={this.props.iconLeft}/>
        );
    }

    render() {
        let classes = {
            name: 'Alert',
            modifiers: ['danger', 'warning', 'offline', 'success']
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                {this.iconLeft()}
                <span className="Alert__content">{this.props.children}</span>
                {this.close()}
            </div>
        );
    }
}

Alert.propTypes = {
    className: PropTypes.string,
    children: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.element
    ]),
    danger: PropTypes.bool,
    warning: PropTypes.bool,
    success: PropTypes.bool,
    offline: PropTypes.bool,
    iconLeft: PropTypes.string,
    showClose: PropTypes.bool
};
export default Alert;
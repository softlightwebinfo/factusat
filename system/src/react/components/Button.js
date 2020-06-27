import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class Button extends PureComponent {
    render() {
        var classes = {
            name: 'R-Button',
            modifiers: ['default', 'grande','block','icon']
        };
        return (
            <button
                type={this.props.type}
                onClick={(e) => this.props.onClick(e)}
                className={cx(classes, this.props, this.props.className)}
            >
                {this.props.children}
            </button>
        );
    }
}

Button.defaultProps = {
    type: 'button',
    onClick: () => {
    }
};
Button.propTypes = {
    className: PropTypes.string,
    default: PropTypes.bool,
    children: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.element,
        PropTypes.object,
        PropTypes.array
    ]).isRequired,
    onClick: PropTypes.func,
    type: PropTypes.string,
    grande: PropTypes.bool,
    block: PropTypes.bool,
    icon: PropTypes.bool,
};
export default Button;
import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class Label extends PureComponent {
    render() {
        var classes = {
            name: 'R-Form__label',
            modifiers: []
        };
        return (
            <label
                className={cx(classes, this.props, this.props.className)}
            >
                {this.props.children}
            </label>
        );
    }
}

Label.defaultProps = {};
Label.propTypes = {
    className: PropTypes.string,
};

export default Label;
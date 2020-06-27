import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class Absolute extends Component {
    render() {
        var classes = {
            name: 'R-Absolute',
            modifiers: ['right', 'bottom', 'top', 'left']
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                {this.props.children}
            </div>
        );
    }
}

Absolute.propTypes = {
    className: PropTypes.string,
    right: PropTypes.bool,
    bottom: PropTypes.bool,
};
export default Absolute;
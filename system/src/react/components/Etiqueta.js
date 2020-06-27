import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class Etiqueta extends PureComponent {
    render() {
        var classes = {
            name: 'R-Etiqueta',
            modifiers: ['success', 'danger']
        };
        return (
            <span className={cx(classes, this.props, this.props.className)}>
                {this.props.children}
            </span>
        );
    }
}

Etiqueta.propTypes = {
    img: PropTypes.string,
    className: PropTypes.string,
    success: PropTypes.bool,
    danger: PropTypes.bool,
};
export default Etiqueta;
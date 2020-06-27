import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class Factura extends PureComponent {
    render() {
        var classes = {
            name: 'R-Factura',
            modifiers: []
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                {this.props.children}
            </div>
        );
    }
}

Factura.propTypes = {
    className: PropTypes.string,
};
export default Factura;
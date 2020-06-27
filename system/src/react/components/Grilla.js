import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class Grilla extends PureComponent {
    render() {
        var classes = {
            name: 'Grilla',
            modifiers: []
        };
        return (
            <div
                className={cx(classes, this.props, this.props.className)}
            >
                {this.props.children}
            </div>
        );
    }
}

Grilla.defaultProps = {};
Grilla.propTypes = {
    children: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.object,
        PropTypes.element,
        PropTypes.array
    ]),
    className: PropTypes.string,
};

export default Grilla;
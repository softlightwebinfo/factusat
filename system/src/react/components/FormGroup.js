import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class FormGroup extends PureComponent {
    render() {
        var classes = {
            name: 'R-Form__group',
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

FormGroup.defaultProps = {
};
FormGroup.propTypes = {
    children: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.object,
        PropTypes.element,
        PropTypes.array
    ]),
    className: PropTypes.string,
};

export default FormGroup;
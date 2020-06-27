import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class Form extends PureComponent {
    render() {
        var classes = {
            name: 'R-Form',
            modifiers: []
        };
        return (
            <form
                onSubmit={e => this.props.onSubmit(e)}
                method={this.props.method}
                className={cx(classes, this.props, this.props.className)}
            >
                {this.props.children}
            </form>
        );
    }
}

Form.defaultProps = {
    method: 'POST',
    onSubmit: () => {
    }
};
Form.propTypes = {
    children: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.object,
        PropTypes.element,
        PropTypes.array
    ]),
    className: PropTypes.string,
    method: PropTypes.string,
    onSubmit: PropTypes.func
};

export default Form;
import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class Input extends PureComponent {
    render() {
        var classes = {
            name: 'R-Form__field',
            modifiers: []
        };
        return (
            <input
                placeholder={this.props.placeholder}
                type={this.props.type}
                ref={this.props.refs}
                name={this.props.name}
                className={cx(classes, this.props, this.props.className)}
                onChange={(e) => {
                    this.props.onChange(e)
                }}
                onKeyPress={this.props.onKeyPress}
                onKeyDown={this.props.onKeyDown}
                autoComplete={false}
                checked={this.props.checked}
                onKeyUp={this.props.onKeyUp}
                value={this.props.value}
                readOnly={this.props.readonly}
                defaultValue={this.props.defaultValue}
                disabled={this.props.disable}
                onClick={this.props.onClick}
            />
        );
    }
}

Input.defaultProps = {
    type: 'text',
    placeholder: '',
    name: '',
    onChange: () => {
    },
    onClick: () => {
    }
};
Input.propTypes = {
    type: PropTypes.string,
    value: PropTypes.oneOfType([
        PropTypes.number,
        PropTypes.string,
        PropTypes.bool
    ]),
    defaultValue: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.bool
    ]),
    valor: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.bool
    ]),
    refs: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.func
    ]),
    name: PropTypes.string,
    placeholder: PropTypes.string,
    children: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.object,
        PropTypes.element
    ]),
    className: PropTypes.string,
    onChange: PropTypes.func,
    checked: PropTypes.bool,
    onKeyPress: PropTypes.func,
    onKeyDown: PropTypes.func,
    onKeyUp: PropTypes.func,
    readonly: PropTypes.bool,
    disable: PropTypes.bool,
    onClick: PropTypes.func
};

export default Input;
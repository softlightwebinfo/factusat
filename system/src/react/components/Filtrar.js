import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import Input from "./Input";
import Label from "./Label";
import Button from "./Button";
import Form from "./Form";

class Filtrar extends Component {
    onSubmit(e) {
        e.preventDefault();
        this.props.onChange(this._input.value);
    }

    onChange(e) {
        e.preventDefault();
        this.props.onChange(e.target.value);
    }

    render() {
        var classes = {
            name: 'R-Filtrar',
            modifiers: []
        };
        return (
            <Form onSubmit={e => this.onSubmit(e)} className={cx(classes, this.props, this.props.className)}>
                {this.props.name && <Label className="R-Filtrar__label">{this.props.name}</Label>}
                <Input
                    refs={e => this._input = e}
                    onChange={e => this.onChange(e)}
                    className="R-Filtrar__input"
                    placeholder={this.props.placeholder}
                />
                <Button type="submit" className="R-Filtrar__button">{this.props.button}</Button>
            </Form>
        );
    }
}

Filtrar.propTypes = {
    className: PropTypes.string,
    placeholder: PropTypes.string,
    name: PropTypes.string,
    button: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.array,
        PropTypes.element,
        PropTypes.object
    ]),
    onChange: PropTypes.func
};
export default Filtrar;
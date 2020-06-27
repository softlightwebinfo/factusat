import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import Button from "./Button";
import Etiqueta from "./Etiqueta";
import Input from "./Input";
import FormAgroup from "./FormAgroup";

class TrAddProducto extends Component {
    constructor(props) {
        super(props);
        this.state = {
            cantidad: this.props.th ? 0 : this.props.cantidad
        };
    }

    estado() {
        return (
            <Etiqueta success>{this.props.estado}</Etiqueta>
        );
    }

    onClick(e) {
        let cantidad = this._cantidad.value,
            precio = this._precio.value;

        this.props.onSelectProducto(cantidad, precio);
    }

    render() {
        if (this.props.th) {
            return (
                <tr>
                    <th>{this.props.codigo}</th>
                    <th>{this.props.producto}</th>
                    <th>{this.props.cantidad}</th>
                    <th>{this.props.precio}</th>
                    <th>
                        {this.props.acciones}
                    </th>
                </tr>
            );
        }
        return (
            <tr>
                <td>{this.props.codigo}</td>
                <td>{this.props.producto}</td>
                <td>
                    <Input
                        refs={e => this._cantidad = e}
                        defaultValue={this.props.cantidad}
                    />
                </td>
                <td>
                    <Input
                        refs={e => this._precio = e}
                        defaultValue={this.props.precio}
                    />
                </td>
                <td>
                    <Button onClick={e => this.onClick(e)} default icon><i className="fa fa-plus"></i></Button>
                </td>
            </tr>
        );
    }
}

TrAddProducto.defaultProps = {
    onSelectProducto: () => {
    }
};
TrAddProducto.propTypes = {
    th: PropTypes.bool,
    className: PropTypes.string,
    codigo: PropTypes.string,
    producto: PropTypes.string,
    cantidad: PropTypes.string,
    precio: PropTypes.string,
    acciones: PropTypes.string,
    onSelectProducto: PropTypes.func
};
export default TrAddProducto;
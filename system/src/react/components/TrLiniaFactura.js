import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import Button from "./Button";
import Etiqueta from "./Etiqueta";
import Input from "./Input";
import FormAgroup from "./FormAgroup";

class TrLiniaFactura extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }


    render() {
        if (this.props.th) {
            return (
                <tr>
                    <th>{this.props.codigo}</th>
                    <th>{this.props.cantidad}</th>
                    <th>{this.props.descripcion}</th>
                    <th>{this.props.precioUnidad}</th>
                    <th>{this.props.precioTotal}</th>
                    <th>
                        {this.props.acciones}
                    </th>
                </tr>
            );
        }
        return (
            <tr>
                <td>{this.props.codigo}</td>
                <td>{this.props.cantidad}</td>
                <td>{this.props.descripcion}</td>
                <td>{this.props.precioUnidad}</td>
                <td>{this.props.precioTotal}</td>
                <td>
                    <Button onClick={e => this.props.onClick(e)} default icon><i className="fa fa-trash"></i></Button>
                </td>
            </tr>
        );
    }
}

TrLiniaFactura.defaultProps = {
    onClick: () => {
    }
};
TrLiniaFactura.propTypes = {
    th: PropTypes.bool,
    className: PropTypes.string,
    codigo: PropTypes.string,
    cantidad: PropTypes.string,
    descripcion: PropTypes.string,
    precioUnidad: PropTypes.string,
    precioTotal: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.number
    ]),
    acciones: PropTypes.string,
    onClick: PropTypes.func
};
export default TrLiniaFactura;
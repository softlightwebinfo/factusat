import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import Button from "./Button";
import Etiqueta from "./Etiqueta";
import Input from "./Input";
import FormAgroup from "./FormAgroup";

class TrAddCliente extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    onClick(e) {
        this.props.onSelectCliente(e);
    }

    render() {
        if (this.props.th) {
            return (
                <tr>
                    <th>{this.props.nombre}</th>
                    <th>{this.props.telefono}</th>
                    <th>{this.props.email}</th>
                    <th>{this.props.direccion}</th>
                    <th>
                        {this.props.acciones}
                    </th>
                </tr>
            );
        }
        return (
            <tr>
                <td>{this.props.nombre}</td>
                <td>{this.props.telefono}</td>
                <td>{this.props.email}</td>
                <td>{this.props.direccion}</td>
                <td>
                    <Button onClick={e => this.onClick(e)} default icon><i className="fa fa-plus"></i></Button>
                </td>
            </tr>
        );
    }
}

TrAddCliente.defaultProps = {
    onSelectProducto: () => {
    },
    onClick: () => {
    }
};
TrAddCliente.propTypes = {
    th: PropTypes.bool,
    nombre: PropTypes.string,
    telefono: PropTypes.string,
    email: PropTypes.string,
    direccion: PropTypes.string,
    acciones: PropTypes.string,
    onSelectCliente: PropTypes.func
};
export default TrAddCliente;
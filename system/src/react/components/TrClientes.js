import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import Button from "./Button";
import Etiqueta from "./Etiqueta";
import {openModal_eliminarCliente, openModal_modificarCliente} from '../actions/clientes';
import {connect} from "react-redux";

class TrClientes extends Component {
    constructor() {
        super();
        this.eliminarCliente = this.eliminarCliente.bind(this);
    }

    estado() {
        if (this.props.estado == '1') {
            return (
                <Etiqueta success>Activo</Etiqueta>
            );
        } else {
            return (
                <Etiqueta danger>Inactivo</Etiqueta>
            );
        }
    }

    eliminarCliente(cliente) {
        this.props.openModal_eliminarCliente(cliente);
    }

    editarCliente(cliente) {
        this.props.openModal_modificarCliente(cliente);
    }

    render() {
        if (this.props.th) {
            return (
                <tr>
                    <th>{this.props.nombre}</th>
                    <th>{this.props.telefono}</th>
                    <th>{this.props.email}</th>
                    <th>{this.props.direccion}</th>
                    <th>{this.props.estado}</th>
                    <th>{this.props.agregado}</th>
                    <th style={{width: 124}}>
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
                <td>{this.estado()}</td>
                <td>{this.props.agregado}</td>
                <td>
                    <Button default icon onClick={e => this.editarCliente(this.props.id)}><i className="fa fa-edit"></i></Button>
                    <Button onClick={e => this.eliminarCliente(this.props.id)} default icon><i className="fa fa-trash"></i></Button>
                </td>
            </tr>
        );
    }
}

TrClientes.propTypes = {
    th: PropTypes.bool,
    className: PropTypes.string,
    telefono: PropTypes.string,
    estado: PropTypes.string,
    agregado: PropTypes.string,
    direccion: PropTypes.string,
    acciones: PropTypes.string,
    nombre: PropTypes.string,
    email: PropTypes.string,
    id: PropTypes.string
};
export default connect(null, {openModal_eliminarCliente, openModal_modificarCliente})(TrClientes);
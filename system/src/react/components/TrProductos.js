import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import Button from "./Button";
import Etiqueta from "./Etiqueta";
import {connect} from 'react-redux';
import {openModalEliminarProducto, openModalEditarProducto} from '../actions/productos';

class TrProductos extends Component {
    constructor() {
        super();
        this.eliminar = this.eliminar.bind(this);
        this.editar = this.editar.bind(this);
    }

    estado() {
        if (this.props.estado == '1') {
            return (
                <Etiqueta success>Activo</Etiqueta>
            );
        } else {
            return (
                <Etiqueta danger>No Activo</Etiqueta>
            );
        }
    }

    eliminar(id) {
        this.props.openModalEliminarProducto(id);
    }

    editar() {
        this.props.openModalEditarProducto(this.props.id);
    }

    render() {
        if (this.props.th) {
            return (
                <tr>
                    <th>{this.props.codigo}</th>
                    <th>{this.props.nombre}</th>
                    <th>{this.props.estado}</th>
                    <th>{this.props.agregado}</th>
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
                <td>{this.props.nombre}</td>
                <td>{this.estado()}</td>
                <td>{this.props.agregado}</td>
                <td>{this.props.precio}</td>
                <td>
                    <Button default icon onClick={this.editar}><i className="fa fa-edit"></i></Button>
                    <Button default icon onClick={e => this.eliminar(this.props.id)}><i className="fa fa-trash"></i></Button>
                </td>
            </tr>
        );
    }
}

TrProductos.propTypes = {
    th: PropTypes.bool,
    className: PropTypes.string,
    codigo: PropTypes.string,
    estado: PropTypes.string,
    agregado: PropTypes.string,
    precio: PropTypes.string,
    acciones: PropTypes.string,
    id: PropTypes.string,
    nombre: PropTypes.string,
};
export default connect(null, {openModalEliminarProducto, openModalEditarProducto})(TrProductos);
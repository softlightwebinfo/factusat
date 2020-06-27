import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import Button from "./Button";
import Etiqueta from "./Etiqueta";
import {imprimir_factura} from "../helps/print";
import {openModalEliminarFactura, openModalUpdateFactura} from '../actions/facturas';
import {connect} from "react-redux";

class TrFacturas extends Component {
    constructor() {
        super();
        this.download = this.download.bind(this);
        this.editar = this.editar.bind(this);
    }

    estado() {
        return (
            <Etiqueta success>{this.props.estado}</Etiqueta>
        );
    }

    download() {
        imprimir_factura(this.props.id, true);
    }

    eliminar() {
        this.props.openModalEliminarFactura(this.props.id);
    }

    editar(e) {
        this.props.openModalUpdateFactura(this.props.id);
    }

    render() {
        if (this.props.th) {
            return (
                <tr>
                    <th>{this.props.numero_factura}</th>
                    <th>{this.props.fecha_factura}</th>
                    <th>{this.props.nombre}</th>
                    <th>{this.props.estado}</th>
                    <th>{this.props.total}</th>
                    <th>
                        {this.props.acciones}
                    </th>
                </tr>
            );
        }
        return (
            <tr>
                <td>{this.props.numero_factura}</td>
                <td>{this.props.fecha_factura}</td>
                <td>{this.props.nombre}</td>
                <td>{this.estado()}</td>
                <td style={{textAlign: 'right'}}>{this.props.total} €</td>
                <td style={{width: 200}}>
                    <Button onClick={this.editar} default icon><i className="fa fa-edit"></i></Button>
                    <Button default icon onClick={e => this.download()}><i className="fa fa-download"></i></Button>
                    <Button onClick={e => this.eliminar()} default icon><i className="fa fa-trash"></i></Button>
                </td>
            </tr>
        );
    }
}

TrFacturas.propTypes = {
    th: PropTypes.bool,
    className: PropTypes.string,
    numero_factura: PropTypes.string,
    fecha_factura: PropTypes.string,
    nombre: PropTypes.string,
    total: PropTypes.string,
    acciones: PropTypes.string,
    estado: PropTypes.string,
    id: PropTypes.string
};
export default connect(null, {openModalEliminarFactura, openModalUpdateFactura})(TrFacturas);
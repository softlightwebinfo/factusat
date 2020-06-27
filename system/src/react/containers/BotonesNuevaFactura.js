import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import {connect} from "react-redux";
import Button from "../components/Button";

import {modalOpen_nuevoCliente} from "../actions/clientes";
import {modalOpen_productoNuevo, modalOpen_addProducto} from "../actions/productos";

class BotonesNuevaFactura extends Component {
    constructor() {
        super();
        this.state = {};
    }


    render() {
        let classes = {
            name: 'C-BotonesNuevaFactura'
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                <Button
                    default
                    onClick={e => this.props.modalOpen_productoNuevo()}
                >
                    <i className="fa fa-plus"></i>
                    Nuevo producto
                </Button>
                <Button
                    default
                    onClick={e => this.props.modalOpen_nuevoCliente()}
                >
                    <i className="fa fa-user"></i>
                    Nuevo cliente
                </Button>
                <Button
                    onClick={e => this.props.modalOpen_addProducto()}
                    default
                >
                    <i className="fa fa-search"></i>
                    Agregar productos
                </Button>
                <Button
                    default
                >
                    <i className="fa fa-print"></i>
                    Imprimir
                </Button>
            </div>
        );
    }
}

BotonesNuevaFactura.propTypes = {
    className: PropTypes.string
};
const mapStateToProps = state => {
    return {
        estadosPagos: state.estadosPagos.estadosPagos
    }
};
export default connect(mapStateToProps, {
    modalOpen_productoNuevo,
    modalOpen_nuevoCliente,
    modalOpen_addProducto
})(BotonesNuevaFactura);
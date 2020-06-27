import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {connect} from "react-redux";
import Modal from "../components/Modal";

import {modalOpen_addProducto, modalClose_addProducto} from "../actions/productos";
import {addProductInInvoice} from '../actions/facturas';
import Loader from '../components/Loader';
import Filtrar from "../components/Filtrar";
import Table from "../components/Table";
import TrAddProducto from "../components/TrAddProducto";
import OverflowScroll from "../components/OverflowScroll";

class ModalAddProduct extends Component {
    constructor() {
        super();
        this.state = {
            busqueda: ''
        };
        this.createCliente = this.createCliente.bind(this);
        this.close = this.close.bind(this);
        this._mensajeSuccess = 'Se ha creado el cliente correctamente';
    }

    onChange(e) {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    close() {
        this.props.modalClose_addProducto();
        this.setState({
            mensajeSuccess: ''
        });
    }

    onFilter(e) {
        this.setState({
            busqueda: e
        })
    }

    render() {
        return (
            <Modal
                onClickClose={e => this.close()}
                title={<span><i className="fa fa-edit"></i>Agregar producto a la factura {this.props.loading_nuevo && <Loader/>}</span>}
                show={this.props.modal_add}
                btnCancelar="Cerrar"
                onClickOk={this.createCliente}
            >
                <Filtrar
                    placeholder="Buscar productos"
                    button='Buscar'
                    onChange={e => this.onFilter(e)}
                />
                <OverflowScroll>
                    <Table>
                        <thead>
                        <TrAddProducto
                            th
                            codigo="Código"
                            producto="Producto"
                            precio="Precio"
                            cantidad="Cantidad"
                            acciones="Agregar"
                        />
                        </thead>
                        <tbody>
                        {this.props.productos.map((item, index) => {
                            if (this.state.busqueda.length) {
                                if (item.nombre.toLowerCase().includes(this.state.busqueda.toLowerCase()) <= 0) {
                                    return;
                                }
                            }
                            return (
                                <TrAddProducto
                                    key={item.id}
                                    cantidad='1'
                                    codigo={item.ref_producto}
                                    precio={item.precio}
                                    producto={item.nombre}
                                    onSelectProducto={(cantidad, precio) => this.onSelectProducto(item, cantidad, precio)}
                                />
                            );
                        })}
                        </tbody>
                    </Table>
                </OverflowScroll>
            </Modal>
        );

    }

    onSelectProducto(item, cantidad, precio) {
        this.props.addProductInInvoice(item.id, cantidad, precio);
    }

    createCliente(e) {
        e.preventDefault();
    }
}

ModalAddProduct.propTypes = {};
const mapStateToProps = state => {
    return {
        modal_add: state.productos.modal_add,
        productos: state.productos.productos
    }
};
export default connect(mapStateToProps, {
    modalOpen_addProducto,
    modalClose_addProducto,
    addProductInInvoice
})(ModalAddProduct);
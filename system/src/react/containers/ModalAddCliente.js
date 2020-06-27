import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {connect} from "react-redux";
import Modal from "../components/Modal";

import {modalClose_addCliente, modalOpen_addCliente} from "../actions/clientes";

import {addClienteInFactura} from '../actions/facturas';
import Loader from '../components/Loader';
import Filtrar from "../components/Filtrar";
import Table from "../components/Table";
import OverflowScroll from "../components/OverflowScroll";
import TrAddCliente from "../components/TrAddCliente";

class ModalAddCliente extends Component {
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
        this.props.modalClose_addCliente();
        this.setState({
            mensajeSuccess: ''
        });
    }

    onFilter(e) {
        this.setState({
            busqueda: e
        })
    }

    selected(item) {
        this.props.addClienteInFactura(item.id);
    }

    render() {
        return (
            <Modal
                onClickClose={e => this.close()}
                title={<span><i className="fa fa-edit"></i>Agregar cliente a la factura {this.props.loading_nuevo && <Loader/>}</span>}
                show={this.props.modal_add}
                btnCancelar="Cerrar"
                medium
            >
                <Filtrar
                    placeholder="Buscar cliente"
                    button='Buscar'
                    onChange={e => this.onFilter(e)}
                />
                <OverflowScroll>
                    <Table>
                        <thead>
                        <TrAddCliente
                            th
                            nombre="Nombre"
                            email="Email"
                            telefono="Telefono"
                            direccion="Direccion"
                            acciones="Agregar"
                        />
                        </thead>
                        <tbody>
                        {this.props.clientes.map((item, index) => {
                            if (this.state.busqueda.length) {
                                if (item.nombre.toLowerCase().includes(this.state.busqueda.toLowerCase()) <= 0) {
                                    return;
                                }
                            }
                            return (
                                <TrAddCliente
                                    key={item.id}
                                    direccion={item.direccion}
                                    telefono={item.telefono}
                                    email={item.email}
                                    nombre={item.nombre}
                                    onSelectCliente={e => this.selected(item)}
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

ModalAddCliente.propTypes = {};
const mapStateToProps = state => {
    return {
        modal_add: state.clientes.modal_add,
        clientes: state.clientes.clientes
    }
};
export default connect(mapStateToProps, {
    addClienteInFactura,
    modalOpen_addCliente,
    modalClose_addCliente
})(ModalAddCliente);
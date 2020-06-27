import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {connect} from "react-redux";
import Modal from "../components/Modal";

import {
    modalClose_nuevaFactura,
    modalOpen_nuevaFactura,
    createFactura,
    deleteProductOutInvoice,
    addClienteInFactura,
    addEstadoPagoInInvoice,
    addPagoInInvoice,
    closeModalUpdateFactura,
    addProducts
} from '../actions/facturas';
import Alert from "../components/Alert";
import Loader from '../components/Loader';
import PanelNuevaFactura from "./PanelNuevaFactura";
import Factura from "../components/Factura";
import FacturaDatos from "../components/FacturaDatos";
import OverflowScroll from "../components/OverflowScroll";
import FacturaSubtotales from "../components/FacturaSubtotales";

class ModalNuevaFactura extends Component {
    constructor() {
        super();
        this.state = {
            id: '',
            nombre: '',
            telefono: '',
            direccion: '',
            email: '',
            estado: '1',
            mensajeSuccess: '',
            update: null
        };
        this.guardarLosDatos = this.guardarLosDatos.bind(this);
        this.close = this.close.bind(this);
        this._mensajeSuccess = 'Se ha creado el cliente correctamente';
    }

    onChange(e) {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    close() {
        if (this.props.modal_update_id != null) {
            this.setState({
                update: null
            });
            this.props.closeModalUpdateFactura();
        } else {
            this.props.modalClose_nuevaFactura();
            this.setState({
                mensajeSuccess: ''
            });
        }
    }

    componentWillReceiveProps(next) {
        if (next.modal_update_id != null && this.state.update == null) {
            let factura = next.facturas.filter(i => i.id == next.modal_update_id);
            this.props.addClienteInFactura(factura[0].id_cliente);
            this.props.addEstadoPagoInInvoice(factura[0].estado_pago);
            this.props.addPagoInInvoice(factura[0].pago);
            this.props.addProducts(factura[0].linias);
            this.setState({
                update: true
            });
        }
    }

    loadPanels() {
        if (!this.props.liniaProductos.length) {
            return false;
        }
        return (
            <div>
                <OverflowScroll>
                    <FacturaDatos
                        liniaProductos={this.props.liniaProductos}
                        productos={this.props.productos}
                        delete={key => this.props.deleteProductOutInvoice(key)}
                    />
                </OverflowScroll>
                <FacturaSubtotales
                    liniaProductos={this.props.liniaProductos}
                />
            </div>
        );
    }

    guardarLosDatos() {
        this.props.createFactura({
            productos: this.props.liniaProductos,
            cliente: this.props.cliente,
            pago: this.props.pago,
            estado: this.props.estado,
        });
    }

    title() {
        if (this.props.modal_update_id != null) {
            return (
                <span><i className="fa fa-edit"></i>Editar factura {this.props.loading_nuevo && <Loader/>}</span>
            )
        } else {
            return (
                <span><i className="fa fa-edit"></i>Agregar una nueva factura {this.props.loading_nuevo && <Loader/>}</span>
            );
        }
    }

    render() {
        return (
            <Modal
                onClickClose={e => this.close()}
                title={this.title()}
                show={this.props.modal_nuevo}
                btnCancelar="Cerrar"
                btnAceptar="Guardar datos"
                onClickOk={e => this.guardarLosDatos()}
                full
            >
                {this.state.mensajeSuccess.length > 0 && <Alert success>{this._mensajeSuccess}</Alert>}
                <Factura>
                    <PanelNuevaFactura/>
                    {this.loadPanels()}
                </Factura>
            </Modal>
        );

    }
}

ModalNuevaFactura.propTypes = {};
const mapStateToProps = state => {
    return {
        modal_nuevo: state.facturas.modal_nuevo,
        loading_nuevo: state.facturas.loading_nuevo,
        liniaProductos: state.facturas.productos,
        productos: state.productos.productos,
        cliente: state.facturas.cliente,
        pago: state.facturas.pago,
        estado: state.facturas.estado,
        modal_update_id: state.facturas.modal_update_id,
        facturas: state.facturas.facturas
    }
};
export default connect(mapStateToProps, {
    modalClose_nuevaFactura,
    createFactura,
    deleteProductOutInvoice,
    addClienteInFactura,
    addEstadoPagoInInvoice,
    addPagoInInvoice,
    closeModalUpdateFactura,
    addProducts
})(ModalNuevaFactura);
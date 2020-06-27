import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {connect} from "react-redux";
import Modal from "../components/Modal";
import {closeModalEliminarFactura, eliminarFactura} from "../actions/facturas";
import Loader from '../components/Loader';

class ModalDelFactura extends Component {
    constructor() {
        super();
        this.state = {};
        this.eliminarFactura = this.eliminarFactura.bind(this);
    }

    close() {
        this.props.closeModalEliminarFactura();
    }

    eliminarFactura() {
        this.props.eliminarFactura(this.props.modal_del_id);
    }

    render() {
        return (
            <Modal
                onClickClose={e => this.close()}
                title={<span><i className="fa fa-edit"></i>Eliminar factura {this.props.loading_nuevo && <Loader/>}</span>}
                show={this.props.modal_del}
                btnCancelar="Cerrar"
                btnAceptar="Eliminar factura"
                onClickOk={e => this.eliminarFactura()}
            >
                <p>¿Estás seguro que deseas eliminar está factura?</p>
            </Modal>
        );

    }

}

ModalDelFactura.propTypes = {};
const mapStateToProps = state => {
    return {
        modal_del: state.facturas.modal_del,
        modal_del_id: state.facturas.modal_del_id
    }
};
export default connect(mapStateToProps, {closeModalEliminarFactura, eliminarFactura})(ModalDelFactura);
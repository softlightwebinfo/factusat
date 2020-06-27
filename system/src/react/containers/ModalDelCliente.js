import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {connect} from "react-redux";
import Modal from "../components/Modal";
import {closeModal_eliminarCliente, eliminarCliente} from "../actions/clientes";
import Loader from '../components/Loader';

class ModalDelCliente extends Component {
    constructor() {
        super();
        this.state = {};
        this.eliminarCliente = this.eliminarCliente.bind(this);
    }

    close() {
        this.props.closeModal_eliminarCliente();
    }

    eliminarCliente() {
        this.props.eliminarCliente(this.props.modal_del_id);
    }

    render() {
        return (
            <Modal
                onClickClose={e => this.close()}
                title={<span><i className="fa fa-edit"></i>Eliminar cliente {this.props.loading_nuevo && <Loader/>}</span>}
                show={this.props.modal_del}
                btnCancelar="Cerrar"
                btnAceptar="Eliminar cliente"
                onClickOk={e => this.eliminarCliente()}
            >
                <p>¿Estás seguro que deseas eliminar el cliente?</p>
            </Modal>
        );

    }

}

ModalDelCliente.propTypes = {};
const mapStateToProps = state => {
    return {
        modal_del: state.clientes.modal_del,
        modal_del_id: state.clientes.modal_del_id
    }
};
export default connect(mapStateToProps, {closeModal_eliminarCliente, eliminarCliente})(ModalDelCliente);
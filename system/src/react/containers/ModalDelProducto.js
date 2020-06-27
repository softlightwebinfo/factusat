import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {connect} from "react-redux";
import Modal from "../components/Modal";
import {eliminarProducto, closeModalEliminarProducto} from '../actions/productos';
import Loader from '../components/Loader';

class ModalDelProducto extends Component {
    constructor() {
        super();
        this.state = {};
        this.eliminarProducto = this.eliminarProducto.bind(this);
    }

    close() {
        this.props.closeModal_eliminarCliente();
    }

    eliminarProducto() {
        this.props.eliminarProducto(this.props.modal_del_id);
    }

    render() {
        return (
            <Modal
                onClickClose={e => this.close()}
                title={<span><i className="fa fa-edit"></i>Eliminar producto {this.props.loading_nuevo && <Loader/>}</span>}
                show={this.props.modal_del}
                btnCancelar="Cerrar"
                btnAceptar="Eliminar producto"
                onClickOk={e => this.eliminarProducto()}
            >
                <p>¿Estás seguro que deseas eliminar el producto?</p>
            </Modal>
        );

    }

}

ModalDelProducto.propTypes = {};
const mapStateToProps = state => {
    return {
        modal_del: state.productos.modal_del,
        modal_del_id: state.productos.modal_del_id
    }
};
export default connect(mapStateToProps, {closeModalEliminarProducto, eliminarProducto})(ModalDelProducto);
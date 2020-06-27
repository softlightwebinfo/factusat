import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {connect} from "react-redux";
import Modal from "../components/Modal";

import {modalClose_productoNuevo, createProduct, closeModalEditarProducto, updateProduct} from '../actions/productos';
import Form from "../components/Form";
import Grilla from "../components/Grilla";
import Label from "../components/Label";
import Input from "../components/Input";
import FormAgroup from "../components/FormAgroup";
import FormGroup from "../components/FormGroup";
import Alert from "../components/Alert";
import Loader from '../components/Loader';

class ModalNuevoProducto extends Component {
    constructor() {
        super();
        this.state = {
            codigo: '',
            nombre: '',
            estado: 1,
            precio: '',
            mensajeSuccess: '',
            id: ''
        };
        this.createProduct = this.createProduct.bind(this);
        this.close = this.close.bind(this);
        this._mensajeSuccess = 'Se ha creado el producto correctamente';
        this._mensajeSuccess_editar = 'Se ha modificado el producto correctamente';
    }

    onChange(e) {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    componentWillReceiveProps(next) {
        if (next.modal_editar_id != null) {
            let producto = this.props.productos.filter(i => i.id == next.modal_editar_id);
            if (producto.length) {
                this.setState({
                    id: producto[0].id,
                    codigo: producto[0].ref_producto,
                    nombre: producto[0].nombre,
                    estado: producto[0].estado,
                    precio: producto[0].precio,
                });
            }
        }
    }

    close() {
        if (this.props.modal_editar_id == null) {
            this.props.closeModalEditarProducto();
        } else {
            this.props.modalClose_productoNuevo();
            this.setState({
                mensajeSuccess: ''
            });
        }
    }

    render() {
        return (
            <Modal
                onClickClose={e => this.close()}
                title={<span><i className="fa fa-edit"></i>Agregar nuevo producto {this.props.loading_nuevo && <Loader/>}</span>}
                show={this.props.modal_nuevo}
                btnCancelar="Cerrar"
                btnAceptar="Guardar datos"
                onClickOk={this.createProduct}
            >
                {this.state.mensajeSuccess.length > 0 && <Alert success>{this._mensajeSuccess}</Alert>}
                <FormAgroup>
                    <Form onSubmit={e => this.createProduct(e)}>
                        <FormGroup>
                            <Grilla>
                                <div className="Grilla__xs--12 Grilla__sm--3">
                                    <Label>Código</Label>
                                </div>
                                <div className="Grilla__xs--12 Grilla__sm--9">
                                    <Input
                                        onChange={e => this.onChange(e)}
                                        name="codigo"
                                        placeholder="Código del producto"
                                        value={this.state.codigo}
                                    />
                                </div>
                            </Grilla>
                        </FormGroup>
                        <FormGroup>
                            <Grilla>
                                <div className="Grilla__xs--12 Grilla__sm--3">
                                    <Label>Nombre</Label>
                                </div>
                                <div className="Grilla__xs--12 Grilla__sm--9">
                                    <Input
                                        onChange={e => this.onChange(e)}
                                        name="nombre"
                                        placeholder="Nombre del producto"
                                        value={this.state.nombre}
                                    />
                                </div>
                            </Grilla>
                        </FormGroup>
                        <FormGroup>
                            <Grilla>
                                <div className="Grilla__xs--12 Grilla__sm--3">
                                    <Label>Estado</Label>
                                </div>
                                <div className="Grilla__xs--12 Grilla__sm--9">
                                    <select
                                        onChange={e => this.onChange(e)}
                                        name="estado"
                                        className="R-Form__field"
                                        value={this.state.estado}
                                    >
                                        <option value="1">Activo</option>
                                        <option value="0">No activo</option>
                                    </select>
                                </div>
                            </Grilla>
                        </FormGroup>
                        <Grilla>
                            <div className="Grilla__xs--12 Grilla__sm--3">
                                <Label>Precio</Label>
                            </div>
                            <div className="Grilla__xs--12 Grilla__sm--9">
                                <Input
                                    onChange={e => this.onChange(e)}
                                    name="precio"
                                    placeholder="Precio del producto"
                                    value={this.state.precio}
                                />
                            </div>
                        </Grilla>
                    </Form>
                </FormAgroup>
            </Modal>
        );

    }

    createProduct(e) {
        e.preventDefault();
        if (this.props.modal_editar_id != null) {
            this.props.updateProduct({
                codigo: this.state.codigo,
                nombre: this.state.nombre,
                estado: this.state.estado,
                precio: this.state.precio,
                id: this.state.id
            }, (data) => {
                if (data) {
                    this.setState({
                        codigo: '',
                        nombre: '',
                        estado: 1,
                        precio: '',
                        mensajeSuccess: this._mensajeSuccess
                    })
                } else {
                    this.setState({
                        mensajeSuccess: ''
                    });
                }
            });
        } else {
            this.props.createProduct({
                codigo: this.state.codigo,
                nombre: this.state.nombre,
                estado: this.state.estado,
                precio: this.state.precio
            }, (data) => {
                if (data) {
                    this.setState({
                        codigo: '',
                        nombre: '',
                        estado: 1,
                        precio: '',
                        mensajeSuccess: ''
                    })
                } else {
                    this.setState({
                        mensajeSuccess: ''
                    });
                }
            });
        }
    }
}

ModalNuevoProducto.propTypes = {};
const mapStateToProps = state => {
    return {
        modal_nuevo: state.productos.modal_nuevo,
        loading_nuevo: state.productos.loading_nuevo,
        modal_editar: state.productos.modal_editar,
        modal_editar_id: state.productos.modal_editar_id,
        productos: state.productos.productos
    }
};
export default connect(mapStateToProps, {
    modalClose_productoNuevo,
    createProduct,
    closeModalEditarProducto,
    updateProduct
})(ModalNuevoProducto);
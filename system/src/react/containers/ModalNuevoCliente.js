import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {connect} from "react-redux";
import Modal from "../components/Modal";

import {updateCliente, closeModal_modificarCliente, modalOpen_nuevoCliente, modalClose_nuevoCliente, createCliente} from '../actions/clientes';
import Form from "../components/Form";
import Grilla from "../components/Grilla";
import Label from "../components/Label";
import Input from "../components/Input";
import FormAgroup from "../components/FormAgroup";
import FormGroup from "../components/FormGroup";
import Alert from "../components/Alert";
import Loader from '../components/Loader';

class ModalNuevoCliente extends Component {
    constructor() {
        super();
        this.state = {
            id: '',
            nombre: '',
            telefono: '',
            direccion: '',
            email: '',
            estado: '1',
            mensajeSuccess: ''
        };
        this.createCliente = this.createCliente.bind(this);
        this.close = this.close.bind(this);
        this._mensajeSuccess = 'Se ha creado el cliente correctamente';
        this._mensajeSuccess_edit = 'Se ha modificado el cliente correctamente';
    }

    componentWillReceiveProps(next) {
        if (next.modal_update_id != null) {
            let cliente = this.props.clientes.filter(i => i.id == next.modal_update_id);
            if (cliente.length) {
                this.setState({
                    id: cliente[0].id,
                    nombre: cliente[0].nombre,
                    telefono: cliente[0].telefono,
                    direccion: cliente[0].direccion,
                    email: cliente[0].email,
                    estado: cliente[0].estado,
                });
            }
        } else {
            this.setState({
                id: '',
                nombre: '',
                telefono: '',
                direccion: '',
                email: '',
                estado: '',
            });
        }
    }

    onChange(e) {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    close() {
        if (this.props.modal_update_id == null) {
            this.setState({
                mensajeSuccess: ''
            });
            this.props.modalClose_nuevoCliente();
        } else {
            this.setState({
                mensajeSuccess: ''
            });
            this.props.closeModal_modificarCliente();
        }
    }

    title() {
        if (this.props.modal_update_id) {
            return (
                <span><i className="fa fa-edit"></i>Editar cliente {this.props.loading_nuevo && <Loader/>}</span>
            );
        } else {
            return (
                <span><i className="fa fa-edit"></i>Agregar nuevo cliente {this.props.loading_nuevo && <Loader/>}</span>
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
                onClickOk={this.createCliente}
            >
                {this.state.mensajeSuccess.length > 0 && <Alert success>{this.state.mensajeSuccess}</Alert>}
                <FormAgroup>
                    <Form onSubmit={e => this.createCliente(e)}>
                        <FormGroup>
                            <Grilla>
                                <div className="Grilla__xs--12 Grilla__sm--3">
                                    <Label>Nombre</Label>
                                </div>
                                <div className="Grilla__xs--12 Grilla__sm--9">
                                    <Input
                                        onChange={e => this.onChange(e)}
                                        name="nombre"
                                        placeholder="Nombre"
                                        value={this.state.nombre}
                                    />
                                </div>
                            </Grilla>
                        </FormGroup>
                        <FormGroup>
                            <Grilla>
                                <div className="Grilla__xs--12 Grilla__sm--3">
                                    <Label>Teléfono</Label>
                                </div>
                                <div className="Grilla__xs--12 Grilla__sm--9">
                                    <Input
                                        onChange={e => this.onChange(e)}
                                        name="telefono"
                                        placeholder="Teléfono"
                                        value={this.state.telefono}
                                    />
                                </div>
                            </Grilla>
                        </FormGroup>
                        <FormGroup>
                            <Grilla>
                                <div className="Grilla__xs--12 Grilla__sm--3">
                                    <Label>Correo electrónico</Label>
                                </div>
                                <div className="Grilla__xs--12 Grilla__sm--9">
                                    <Input
                                        onChange={e => this.onChange(e)}
                                        name="email"
                                        placeholder="Correo electrónico"
                                        value={this.state.email}
                                    />
                                </div>
                            </Grilla>
                        </FormGroup>
                        <FormGroup>
                            <Grilla>
                                <div className="Grilla__xs--12 Grilla__sm--3">
                                    <Label>Dirección</Label>
                                </div>
                                <div className="Grilla__xs--12 Grilla__sm--9">
                                    <Input
                                        onChange={e => this.onChange(e)}
                                        name="direccion"
                                        placeholder="Dirección"
                                        value={this.state.direccion}
                                    />
                                </div>
                            </Grilla>
                        </FormGroup>
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
                    </Form>
                </FormAgroup>
            </Modal>
        );

    }

    createCliente(e) {
        e.preventDefault();
        if (this.props.modal_update_id != null) {
            this.props.updateCliente({
                telefono: this.state.telefono,
                nombre: this.state.nombre,
                estado: '' + this.state.estado,
                direccion: this.state.direccion,
                email: this.state.email,
                id: this.state.id
            }, (data) => {

                if (data) {
                    this.setState({
                        nombre: '',
                        estado: 1,
                        telefono: '',
                        email: '',
                        direccion: '',
                        mensajeSuccess: this._mensajeSuccess_edit
                    });
                    this.setState({
                        mensajeSuccess: ''
                    });
                } else {
                    this.setState({
                        mensajeSuccess: ''
                    });
                }
            });
        } else {
            this.props.createCliente({
                telefono: this.state.telefono,
                nombre: this.state.nombre,
                estado: '' + this.state.estado,
                direccion: this.state.direccion,
                email: this.state.email
            }, (data) => {
                if (data) {
                    this.setState({
                        nombre: '',
                        estado: 1,
                        telefono: '',
                        email: '',
                        direccion: '',
                        mensajeSuccess: this._mensajeSuccess
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

ModalNuevoCliente.propTypes = {};
const mapStateToProps = state => {
    return {
        modal_nuevo: state.clientes.modal_nuevo,
        loading_nuevo: state.clientes.loading_nuevo,
        loading_editar: state.clientes.loading_editar,
        modal_update_id: state.clientes.modal_update_id,
        clientes: state.clientes.clientes
    }
};
export default connect(mapStateToProps, {
    modalOpen_nuevoCliente,
    modalClose_nuevoCliente,
    closeModal_modificarCliente,
    createCliente,
    updateCliente
})(ModalNuevoCliente);
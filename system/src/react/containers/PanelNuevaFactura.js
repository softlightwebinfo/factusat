import React, {Component} from 'react';
import {connect} from "react-redux";
import {notificationClose} from '../actions/notifications';
import FormAgroup from "../components/FormAgroup";
import Grilla from "../components/Grilla";
import Label from "../components/Label";
import Input from "../components/Input";
import {fecha} from "../helps/fechas";
import MetodoPago from "./MetodoPago";
import EstadosPagos from "./EstadosPagos";
import Paneliz from "../components/Paneliz";
import BotonesNuevaFactura from "./BotonesNuevaFactura";
import AddClassBody from "../components/AddClassBody";

import {modalOpen_addCliente} from "../actions/clientes";


class PanelNuevaFactura extends Component {
    constructor() {
        super();
        this.state = {
            id: '',
            nombre: '',
            telefono: '',
            email: '',
        };
    }

    openCLiente(e) {
        this.props.modalOpen_addCliente();
    }

    componentDidMount() {
    }


    componentWillReceiveProps(next) {
        if (next.facturaCliente != '') {
            let cliente = next.clientes.filter(i => i.id == next.facturaCliente)[0];
            if (cliente !== undefined) {
                this.setState({
                    id: cliente.id,
                    nombre: cliente.nombre,
                    telefono: cliente.telefono,
                    email: cliente.email
                });
            }
        } else if (next.facturaCliente == '' || next.facturaCliente == null) {
            this.setState({
                id: '',
                nombre: '',
                telefono: '',
                email: ''
            });
        }
    }

    render() {
        return (
            <AddClassBody className="SystemModalesMin">
                <Paneliz title="Datos de la Factura">
                    <FormAgroup>
                        <Grilla>
                            <div className="Grilla__xs--12 Grilla__sm--4">
                                <FormAgroup>
                                    <Grilla>
                                        <div className="Grilla__xs--12 Grilla__sm--3">
                                            <Label>Cliente</Label>
                                        </div>
                                        <div className="Grilla__xs--12 Grilla__sm--9">
                                            <Input
                                                readonly
                                                placeholder="Selecciona un cliente"
                                                onClick={e => this.openCLiente()}
                                                value={this.state.nombre}
                                            />
                                        </div>
                                    </Grilla>
                                </FormAgroup>
                            </div>
                            <div className="Grilla__xs--12 Grilla__sm--4">
                                <FormAgroup>
                                    <Grilla>
                                        <div className="Grilla__xs--12 Grilla__sm--3">
                                            <Label>Telefono</Label>
                                        </div>
                                        <div className="Grilla__xs--12 Grilla__sm--9">
                                            <Input
                                                placeholder="Telefono"
                                                readonly
                                                disable
                                                value={this.state.telefono}
                                            />
                                        </div>
                                    </Grilla>
                                </FormAgroup>
                            </div>
                            <div className="Grilla__xs--12 Grilla__sm--4">
                                <FormAgroup>
                                    <Grilla>
                                        <div className="Grilla__xs--12 Grilla__sm--3">
                                            <Label>Email</Label>
                                        </div>
                                        <div className="Grilla__xs--12 Grilla__sm--9">
                                            <Input
                                                placeholder="Email"
                                                readonly
                                                disable
                                                value={this.state.email}
                                            />
                                        </div>
                                    </Grilla>
                                </FormAgroup>
                            </div>
                        </Grilla>
                        <Grilla>
                            <div className="Grilla__xs--12 Grilla__sm--4">
                                <FormAgroup>
                                    <Grilla>
                                        <div className="Grilla__xs--12 Grilla__sm--3">
                                            <Label>Fecha</Label>
                                        </div>
                                        <div className="Grilla__xs--12 Grilla__sm--9">
                                            <Input
                                                placeholder="Email"
                                                readonly
                                                disable
                                                value={fecha(Date.now())}
                                            />
                                        </div>
                                    </Grilla>
                                </FormAgroup>
                            </div>
                            <div className="Grilla__xs--12 Grilla__sm--4">
                                <FormAgroup>
                                    <Grilla>
                                        <div className="Grilla__xs--12 Grilla__sm--3">
                                            <Label>Pago</Label>
                                        </div>
                                        <div className="Grilla__xs--12 Grilla__sm--9">
                                            <MetodoPago

                                            />
                                        </div>
                                    </Grilla>
                                </FormAgroup>
                            </div>
                            <div className="Grilla__xs--12 Grilla__sm--4">
                                <FormAgroup>
                                    <Grilla>
                                        <div className="Grilla__xs--12 Grilla__sm--3">
                                            <Label>Estado</Label>
                                        </div>
                                        <div className="Grilla__xs--12 Grilla__sm--9">
                                            <EstadosPagos/>
                                        </div>
                                    </Grilla>
                                </FormAgroup>
                            </div>
                        </Grilla>
                        <BotonesNuevaFactura/>
                    </FormAgroup>
                </Paneliz>
            </AddClassBody>
        );
    }
}


const mapStateToProps = state => {
    return {
        metodosPagos: state.metodosPagos.metodosPagos,
        clientes: state.clientes.clientes,
        facturaCliente: state.facturas.cliente
    }
};
export default connect(mapStateToProps, {modalOpen_addCliente})(PanelNuevaFactura);
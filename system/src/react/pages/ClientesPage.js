import React, {Component} from 'react';
import reduxLang from '../middleware/lang';
import {connect} from "react-redux";
import Paneliz from "../components/Paneliz";
import Button from "../components/Button";
import Filtrar from "../components/Filtrar";
import Table from "../components/Table";
import TrProductos from "../components/TrProductos";
import {fecha} from '../helps/fechas';
import {modalOpen_nuevoCliente} from '../actions/clientes';
import TrClientes from "../components/TrClientes";

class ClientesPage extends Component {
    constructor() {
        super();
        this.state = {
            busqueda: ''
        };
    }

    componentDidMount() {

    }

    panelRight() {
        return (
            <Button
                default
                onClick={e => this.props.modalOpen_nuevoCliente()}
            >
                <i className="fa fa-plus"></i>
                <span>Nuevo Cliente</span>
            </Button>
        );
    }

    filtrar(e) {
        this.setState({
            busqueda: e
        })
    }

    render() {
        return (
            <div className="container">
                <Paneliz
                    title="Buscar clientes"
                    icon="fa fa-search"
                    right={this.panelRight()}
                >
                    <Filtrar
                        onChange={e => this.filtrar(e)}
                        placeholder="Nombre del cliente"
                        name="Código o nombre:"
                        button={<span><i className="fa fa-search"></i> Buscar</span>}
                    />

                    <Table>
                        <thead>
                        <TrClientes
                            th
                            nombre="Nombre"
                            estado="Estado"
                            direccion="Direccion"
                            telefono="Telefono"
                            agregado="Agregado"
                            acciones="Acciones"
                            email="Email"
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
                                <TrClientes
                                    id={item.id}
                                    key={item.id}
                                    nombre={item.nombre}
                                    telefono={item.telefono}
                                    email={item.email}
                                    direccion={item.direccion}
                                    agregado={fecha(item.fecha_creacion)}
                                    estado={item.estado}
                                />
                            );
                        })}
                        </tbody>
                    </Table>
                </Paneliz>
            </div>
        );
    }
}

const mapStateToProps = (state) => {
    return {
        clientes: state.clientes.clientes
    };
};

export default reduxLang('home')(connect(mapStateToProps, {
    modalOpen_nuevoCliente
})(ClientesPage));
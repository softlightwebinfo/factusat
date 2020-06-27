import React, {Component} from 'react';
import reduxLang from '../middleware/lang';
import {connect} from "react-redux";
import Paneliz from "../components/Paneliz";
import Button from "../components/Button";
import Filtrar from "../components/Filtrar";
import Table from "../components/Table";
import TrProductos from "../components/TrProductos";
import {fecha} from '../helps/fechas';
import {modalOpen_nuevaFactura} from '../actions/facturas';
import TrFacturas from "../components/TrFacturas";
import {imprimir_factura} from "../helps/print";

class FacturasPage extends Component {
    constructor() {
        super();
        this.state = {
            busqueda: ''
        };
    }

    componentDidMount() {

    }

    componentWillReceiveProps(next) {
        if (next.idPrint !== '') {
            imprimir_factura(next.idPrint);
        }
    }

    panelRight() {
        return (
            <Button
                default
                onClick={e => this.props.modalOpen_nuevaFactura()}
            >
                <i className="fa fa-plus"></i>
                <span>Nueva Factura</span>
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
                    title="Buscar facturas"
                    icon="fa fa-search"
                    right={this.panelRight()}
                >
                    <Filtrar
                        onChange={e => this.filtrar(e)}
                        placeholder="Nombre del cliente"
                        name="Nombre del cliente"
                        button={<span><i className="fa fa-search"></i> Buscar</span>}
                    />

                    <Table>
                        <thead>
                        <TrFacturas
                            th
                            nombre="Cliente"
                            total="Total(S/iva)"
                            fecha_factura="Fecha"
                            numero_factura="#"
                            acciones="Acciones"
                            estado="Estado"
                        />
                        </thead>
                        <tbody>
                        {this.props.facturas.map((item, index) => {
                            if (this.state.busqueda.length) {
                                if (item.nombre.toLowerCase().includes(this.state.busqueda.toLowerCase()) <= 0) {
                                    return;
                                }
                            }
                            return (
                                <TrFacturas
                                    key={item.id}
                                    id={item.id}
                                    numero_factura={item.numero_factura}
                                    fecha_factura={fecha(item.fecha_factura)}
                                    total={item.total}
                                    nombre={item.nombre}
                                    estado={item.pago_estado}
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
        facturas: state.facturas.facturas,
        idPrint: state.facturas.idPrint
    };
};

export default reduxLang('home')(connect(mapStateToProps, {
    modalOpen_nuevaFactura,
})(FacturasPage));
import React, {Component} from 'react';
import reduxLang from '../middleware/lang';
import {connect} from "react-redux";
import Paneliz from "../components/Paneliz";
import Button from "../components/Button";
import Filtrar from "../components/Filtrar";
import Table from "../components/Table";
import TrProductos from "../components/TrProductos";
import {fecha} from '../helps/fechas';
import {modalOpen_productoNuevo} from '../actions/productos';

class ProductosPage extends Component {
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
                onClick={e => this.props.modalOpen_productoNuevo()}
            >
                <i className="fa fa-plus"></i>
                <span>Nuevo producto</span>
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
                    title="Buscar productos"
                    icon="fa fa-search"
                    right={this.panelRight()}
                >
                    <Filtrar
                        onChange={e => this.filtrar(e)}
                        placeholder="Nombre del producto"
                        name="Código o nombre:"
                        button={<span><i className="fa fa-search"></i> Buscar</span>}
                    />

                    <Table>
                        <thead>
                        <TrProductos
                            th
                            precio='Precio'
                            estado='Estado'
                            agregado='Agregado'
                            codigo='Código'
                            acciones="Acciones"
                            nombre='Nombre'
                        />
                        </thead>
                        <tbody>
                        {this.props.productos.map((item, index) => {
                            if (this.state.busqueda.length) {
                                if (item.nombre.toLowerCase().includes(this.state.busqueda.toLowerCase()) <= 0) {
                                    return;
                                }
                            }
                            return (
                                <TrProductos
                                    id={item.id}
                                    key={item.id}
                                    precio={item.precio}
                                    estado={item.estado}
                                    nombre={item.nombre}
                                    agregado={fecha(item.fecha_creacion)}
                                    codigo={item.ref_producto}
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
        productos: state.productos.productos
    };
};

export default reduxLang('home')(connect(mapStateToProps, {modalOpen_productoNuevo})(ProductosPage));
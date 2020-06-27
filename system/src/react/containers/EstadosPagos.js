import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import {connect} from "react-redux";
import {addEstadoPagoInInvoice} from '../actions/facturas';

class EstadosPagos extends Component {
    constructor() {
        super();
        this.state = {};
    }

    change(e) {
        this.props.addEstadoPagoInInvoice(e.target.value);
    }

    render() {
        return (
            <select className="R-Form__field" onChange={e => this.change(e)} value={this.props.estado}>
                <option value="-1">Selecciona un estado</option>
                {this.props.estadosPagos.map((item, index) => {
                    return (
                        <option key={item.id} value={item.id}>{item.nombre}</option>
                    );
                })}
            </select>
        );
    }
}


const mapStateToProps = state => {
    return {
        estadosPagos: state.estadosPagos.estadosPagos,
        estado: state.facturas.estado,
    }
};
export default connect(mapStateToProps, {addEstadoPagoInInvoice})(EstadosPagos);
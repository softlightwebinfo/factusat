import React, {Component} from 'react';
import {connect} from "react-redux";
import {addPagoInInvoice} from "../actions/facturas";

class MetodoPago extends Component {
    constructor(props) {
        super(props);
        this.state = {
            // value: this.props.pago
        };
    }

    change(e) {
        // this.setState({
        //     valor: e.target.value
        // });
        this.props.addPagoInInvoice(e.target.value);
    }

    render() {
        return (
            <select className="R-Form__field" onChange={e => this.change(e)} value={this.props.pago}>
                <option value="-1">Selecciona un metodo de pago</option>
                {this.props.metodosPagos.map((item, index) => {
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
        metodosPagos: state.metodosPagos.metodosPagos,
        pago: state.facturas.pago,
        estado: state.facturas.estado,
    }
};
export default connect(mapStateToProps, {addPagoInInvoice})(MetodoPago);
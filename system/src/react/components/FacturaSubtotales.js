import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import Grilla from "./Grilla";
import {iva} from '../config/config';

class FacturaSubtotales extends Component {
    componentDidMount() {
        this.calculateSubTotal();
    }

    calculateSubTotal() {
        let total = 0;
        this.props.liniaProductos.map((item, index) => {
            total += item.precio * item.cantidad;
        });
        return parseFloat(total).toFixed(2);
    }

    calculateIva() {
        let total = this.calculateSubTotal();

        return parseFloat((total * iva) / 100).toFixed(2);
    }

    calculateTotal() {
        let total = this.calculateSubTotal(),
            iva = this.calculateIva();
        return parseFloat(Number(total) + Number(iva)).toFixed(2);
    }

    render() {
        var classes = {
            name: 'R-Factura__subtotales',
            modifiers: []
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                <div className="R-Factura__grill">
                    <div>
                        <Grilla>
                            <div className="Grilla__xs--12 Grilla__sm--6">
                                Subtotal €
                            </div>
                            <div className="Grilla__xs--12 Grilla__sm--6">
                                {this.calculateSubTotal()}
                            </div>
                        </Grilla>
                    </div>
                    <div>
                        <Grilla>
                            <div className="Grilla__xs--12 Grilla__sm--6">
                                IVA ({iva})%
                            </div>
                            <div className="Grilla__xs--12 Grilla__sm--6">
                                {this.calculateIva()}
                            </div>
                        </Grilla>
                    </div>
                    <div>
                        <Grilla>
                            <div className="Grilla__xs--12 Grilla__sm--6">
                                TOTAL
                            </div>
                            <div className="Grilla__xs--12 Grilla__sm--6">
                                {this.calculateTotal()}
                            </div>
                        </Grilla>
                    </div>
                </div>
            </div>
        );
    }
}

FacturaSubtotales.propTypes = {
    className: PropTypes.string,
    liniaProductos: PropTypes.array,
};
export default FacturaSubtotales;
import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import Table from "./Table";
import TrLiniaFactura from "./TrLiniaFactura";


class FacturaDatos extends Component {
    constructor() {
        super();

    }

    eliminar(key) {
        this.props.delete(key);
    }

    loadTable() {
        return (
            <div>
                <Table
                    linia
                >
                    <thead>
                    <TrLiniaFactura
                        th
                        cantidad="Cantidad"
                        codigo="Código"
                        descripcion="Descripcion"
                        precioTotal="Precio Total"
                        precioUnidad="Precio Unidad"

                    />
                    </thead>
                    <tbody>
                    {this.props.liniaProductos.map((item, index) => {
                        let product = this.props.productos.filter(i => i.id == (item.id || item.id_producto));
                        return (
                            <TrLiniaFactura
                                key={item.ky}
                                cantidad={item.cantidad}
                                codigo={product[0].ref_producto}
                                descripcion={product[0].nombre}
                                precioTotal={parseFloat(item.precio * item.cantidad).toFixed(2)}
                                precioUnidad={item.precio}
                                onClick={e => this.eliminar(item.ky)}
                            />
                        );
                    })}
                    </tbody>
                </Table>

            </div>
        );
    }

    render() {
        var classes = {
            name: 'R-Factura__datos',
            modifiers: []
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                {this.loadTable()}
            </div>
        );
    }
}

FacturaDatos.propTypes = {
    liniaProductos: PropTypes.array,
    productos: PropTypes.array,
    className: PropTypes.string,
    delete: PropTypes.func
};
export default FacturaDatos;
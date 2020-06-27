import * as types from '../actions/actionTypes';
import {url} from "../helps/urls";
import axios from 'axios';
import Api from '../api/api';

export function setFacturas(facturas) {
    return {
        type: types.SET_FACTURAS,
        facturas
    }
}

export function modalOpen_nuevaFactura() {
    return {
        type: types.OPEN_MODAL_FACTURA_NUEVA,
    }
}

export function modalClose_nuevaFactura() {
    return {
        type: types.CLOSE_MODAL_FACTURA_NUEVA,
    }
}

export function setClearNewFactura() {
    return {
        type: types.CLEAR_NEW_FACTURA
    }
}

export function setAddNewFactura(factura) {
    return {
        type: types.ADD_NEW_FACTURA,
        factura
    }
}

export function createFactura(datos) {
    return dispatch => {
        Api.createFactura(datos)
            .then(res => {
                dispatch(setAddNewFactura(res.factura));
                dispatch(setClearNewFactura());
            });
    }
}

export function getFacturas() {
    return dispatch => {
        Api.getFacturas()
            .then(res => {
                dispatch(setFacturas(res.facturas));
            })
    }
}

export function addProductInInvoice(id, cantidad, precio) {
    return {
        type: types.ADD_PRODUCTO_IN_FACTURA,
        id,
        cantidad,
        precio
    }
}

export function addProducts(productos) {
    return {
        type: types.ADD_PRODUCTOS_IN_FACTURA,
        productos
    }
}

export function deleteProductOutInvoice(key) {
    return {
        type: types.DELETE_PRODUCTO_OUT_FACTURA,
        key,
    }
}

export function addClienteInFactura(cliente) {
    return dispatch => {
        dispatch({
            type: types.ADD_CLIENTE_IN_FACTURA,
            cliente
        });
        dispatch({
            type: types.CLOSE_MODAL_ADD_CLIENTE,
        })
    }
}

export function addPagoInInvoice(pago) {
    return {
        type: types.ADD_PAGO_IN_FACTURA,
        pago
    }
}

export function addEstadoPagoInInvoice(estado) {
    return {
        type: types.ADD_ESTADO_PAGO_IN_FACTURA,
        estado
    }
}

export function openModalEliminarFactura(id) {
    return {
        type: types.OPEN_MODAL_DEL_FACTURA,
        id
    }
}

export function closeModalEliminarFactura() {
    return {
        type: types.CLOSE_MODAL_DEL_FACTURA
    }
}

export function openModalUpdateFactura(id) {
    return {
        type: types.OPEN_MODAL_UPDATE_FACTURA,
        id
    }
}

export function closeModalUpdateFactura() {
    return {
        type: types.CLOSE_MODAL_UPDATE_FACTURA
    }
}

export function setEliminarFactura(id) {
    return {
        type: types.SET_ELIMINAR_FACTURA,
        id
    }
}

export function eliminarFactura(id) {
    return dispatch => {
        Api.eliminarFactura(id)
            .then(res => {
                dispatch(setEliminarFactura(id));
            });
    }
}
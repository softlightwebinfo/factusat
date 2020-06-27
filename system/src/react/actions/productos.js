import * as types from '../actions/actionTypes';
import {url} from "../helps/urls";
import axios from 'axios';
import Api from "../api/api";


export function SET_PRODUCTOS(productos) {
    return {
        type: types.SET_PRODUCTOS,
        productos
    }
}

export function fetchNewProduct(show) {
    return {
        type: types.FETCH_NEW_PRODUCT,
        show
    }
}

export function addProduct(producto) {
    return {
        type: types.ADD_PRODUCTO,
        producto
    }
}

export function GET_PRODUCTOS() {
    return dispatch => {
        Api.getProductos()
            .then(resp => {
                dispatch(SET_PRODUCTOS(resp.productos));
            });
    }
}

export function modalClose_productoNuevo() {
    return {
        type: types.CLOSE_MODAL_PRODUCTO_NUEVO
    }
}

export function modalOpen_productoNuevo() {
    return {
        type: types.OPEN_MODAL_PRODUCTO_NUEVO
    }
}

export function modalOpen_addProducto() {
    return {
        type: types.OPEN_MODAL_ADD_PRODUCTO
    };
}

export function modalClose_addProducto() {
    return {
        type: types.CLOSE_MODAL_ADD_PRODUCTO
    };
}


export function createProduct(producto, callback) {
    return dispatch => {
        Api.createProduct(producto)
            .then(rs => {

                callback(true);

                dispatch(addProduct(rs));
            });
    }
}

export function openModalEliminarProducto(id) {
    return {
        type: types.OPEN_MODAL_DEL_PRODUCTO,
        id
    }
}

export function closeModalEliminarProducto() {
    return {
        type: types.CLOSE_MODAL_DEL_PRODUCTO
    }
}

export function setEliminarProducto(id) {
    return {
        type: types.SET_ELIMINAR_PRODUCTO,
        id
    }
}

export function eliminarProducto(id) {
    return dispatch => {
        Api.eliminarProducto(id)
            .then(res => {
                dispatch(setEliminarProducto(id));
            })
    }
}

export function openModalEditarProducto(id) {
    return {
        type: types.OPEN_MODAL_EDITAR_PRODUCTO,
        id
    }
}

export function closeModalEditarProducto() {
    return {
        type: types.CLOSE_MODAL_EDITAR_PRODUCTO
    }
}

export function setUpdateProducto(producto) {
    return {
        type: types.SET_UPDATE_PRODUCTO,
        producto
    }
}

export function updateProduct(datos) {
    return dispatch => {
        Api.updateProducto(datos)
            .then(res => {
                dispatch(setUpdateProducto(res.producto));
            })
    }
}
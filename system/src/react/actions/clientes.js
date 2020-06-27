import * as types from '../actions/actionTypes';
import {url} from "../helps/urls";
import axios from 'axios';
import Api from '../api/api';

export function setClientes(clientes) {
    return {
        type: types.SET_CLIENTES,
        clientes
    }
}

export function fetchNewClient(show) {
    return {
        type: types.FETCH_NEW_CLIENT,
        show
    }
}

export function fetchUpdateClient(show) {
    return {
        type: types.FETCH_UPDATE_CLIENT,
        show
    }
}

export function modalOpen_nuevoCliente() {
    return {
        type: types.OPEN_MODAL_CLIENTE_NUEVO
    }
}

export function modalClose_nuevoCliente() {
    return {
        type: types.CLOSE_MODAL_CLIENTE_NUEVO
    }
}

export function addCliente(cliente) {
    return {
        type: types.ADD_CLIENTE,
        cliente
    }
}

export function getClientes() {
    return dispatch => {
        Api.getClientes()
            .then(res => {
                dispatch(setClientes(res.clientes));
            });
    }
}

export function createCliente(client, callback) {
    return dispatch => {
        dispatch(fetchNewClient(true));
        Api.createClient(client)
            .then(rs => {
                setTimeout(() => {
                    if (callback !== undefined) {
                        callback(true);
                    }
                    dispatch(addCliente(rs.cliente));
                    dispatch(fetchNewClient(false));
                }, 700)
            });
    }
}

export function setUpdateCliente(client) {
    return {
        type: types.SET_UPDATE_CLIENT,
        client
    }
}

export function updateCliente(cliente, callback) {
    return dispatch => {
        // dispatch(fetchUpdateClient(true));
        Api.updateCliente(cliente)
            .then(rs => {

                if (callback !== undefined) {
                    callback(true);
                }
                dispatch(setUpdateCliente(cliente));
                // dispatch(fetchUpdateClient(false));
            });
    }
}

export function modalClose_addCliente() {
    return {
        type: types.CLOSE_MODAL_ADD_CLIENTE
    }
}

export function modalOpen_addCliente() {
    return {
        type: types.OPEN_MODAL_ADD_CLIENTE
    }
}

export function openModal_eliminarCliente(id) {
    return {
        type: types.OPEN_MODAL_DEL_CLIENTE,
        id
    }
}

export function closeModal_eliminarCliente() {
    return {
        type: types.CLOSE_MODAL_DEL_CLIENTE
    }
}

export function setEliminarCliente(id) {
    return {
        type: types.SET_ELIMINAR_CLIENTE,
        id
    }
}

export function eliminarCliente(id) {
    return dispatch => {
        Api.eliminarCliente(id)
            .then(res => {
                dispatch(setEliminarCliente(id));
            });
    }
}

export function openModal_modificarCliente(id) {
    return {
        type: types.OPEN_MODAL_UPDATE_CLIENT,
        id
    }
}

export function closeModal_modificarCliente() {
    return {
        type: types.CLOSE_MODAL_UPDATE_CLIENT
    }
}
import * as types from '../actions/actionTypes';
import io from 'socket.io-client';
import {GET_PRODUCTOS} from "../actions/productos";
import {getClientes} from "../actions/clientes";
import {getFacturas} from "../actions/facturas";
import {getMetodosPagos} from '../actions/metodosPagos';
import {getEstadosPagos} from "../actions/estadosPagos";
import {getEmpresaDatos} from "../actions/empresa";

var socket = null;
export default function (store) {
    socket = io.connect(`:3000`);
}

export function createReparacion(store) {
    return next => action => {
        const result = next(action);
        if (socket && action.type === types.LOGOUT) {

        }

        if (action.type === types.LOGIN_USER) {
            store.dispatch(getMetodosPagos());
            store.dispatch(getEstadosPagos());
            store.dispatch(getEmpresaDatos());
            store.dispatch(GET_PRODUCTOS());
            store.dispatch(getClientes());
            store.dispatch(getFacturas());
        }

        return result;
    };
}
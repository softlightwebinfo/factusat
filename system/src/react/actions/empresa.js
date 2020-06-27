import * as types from '../actions/actionTypes';
import {url} from "../helps/urls";
import axios from 'axios';
import Api from '../api/api';

export function setEmpresaDatos(datos) {
    return {
        type: types.SET_EMPRESA_DATOS,
        datos
    }
}

export function getEmpresaDatos() {
    return dispatch => {
        Api.getEmpresaDatos()
            .then(res => {
                dispatch(setEmpresaDatos(res));
            })
    }
}

export function setModificarEmpresa(datos) {
    return {
        type: types.SET_MODIFICAR_EMPRESA,
        datos
    }
}

export function modificarEmpresa(datos) {
    return dispatch => {
        Api.modificarEmpresa(datos)
            .then(res => {
                dispatch(setModificarEmpresa(res));
            })
    }
}
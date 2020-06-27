import * as types from '../actions/actionTypes';
import {url} from "../helps/urls";
import axios from 'axios';
import Api from '../api/api';

export function setEstadosPagos(estadosPagos) {
    return {
        type: types.SET_ESTADOS_PAGOS,
        estadosPagos
    }
}


export function getEstadosPagos() {
    return dispatch => {
        Api.getEstadosPagos()
            .then(res => {
                dispatch(setEstadosPagos(res.estadosPagos));
            })
    }
}
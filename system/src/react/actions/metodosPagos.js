import * as types from '../actions/actionTypes';
import {url} from "../helps/urls";
import axios from 'axios';
import Api from '../api/api';

export function setMetodosPagos(metodosPagos) {
    return {
        type: types.SET_METODOS_PAGOS,
        metodosPagos
    }
}


export function getMetodosPagos() {
    return dispatch => {
        Api.getMetodosPagos()
            .then(res => {
                dispatch(setMetodosPagos(res.metodosPagos));
            })
    }
}
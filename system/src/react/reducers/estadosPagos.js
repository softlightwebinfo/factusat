import * as types from '../actions/actionTypes';
import {aplication} from "../config/config";

const initialState = {
    estadosPagos: [],
};
export default function reducer(state = initialState, action) {
    switch (action.type) {
        case types.SET_ESTADOS_PAGOS: {
            return {
                ...state,
                estadosPagos: action.estadosPagos
            }
        }
        default:
            return state;
    }
}
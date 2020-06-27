import * as types from '../actions/actionTypes';
import {aplication} from "../config/config";

const initialState = {
    metodosPagos: [],
};
export default function reducer(state = initialState, action) {
    switch (action.type) {
        case types.SET_METODOS_PAGOS: {
            return {
                ...state,
                metodosPagos: action.metodosPagos
            }
        }
        default:
            return state;
    }
}
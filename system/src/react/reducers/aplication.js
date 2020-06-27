import * as types from '../actions/actionTypes';
import {aplication} from "../config/config";

const initialState = {
    nombre: aplication.nombre
};
export default function reducer(state = initialState, action) {
    switch (action.type) {
        default:
            return state;
    }
}
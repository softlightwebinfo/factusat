import * as types from '../actions/actionTypes';
import {aplication} from "../config/config";

const initialState = {
    clientes: [],
    modal_nuevo: false,
    modal_add: false,
    modal_del: false,
    modal_del_id: null,
    loading_nuevo: null,
    modal_update_id: null,
    loading_editar: null
};

export default function reducer(state = initialState, action) {
    switch (action.type) {
        case types.SET_CLIENTES: {
            return {
                ...state,
                clientes: action.clientes
            }
        }
        case types.OPEN_MODAL_CLIENTE_NUEVO: {
            return {
                ...state,
                modal_nuevo: true
            }
        }
        case types.CLOSE_MODAL_CLIENTE_NUEVO: {
            return {
                ...state,
                modal_nuevo: false
            }
        }
        case types.FETCH_NEW_CLIENT: {
            return {
                ...state,
                loading_nuevo: action.show
            }
        }
        case types.ADD_CLIENTE: {

            let client = Array.from(state.clientes);
            client.unshift(action.cliente);

            return {
                ...state,
                clientes: client
            }
        }
        case types.OPEN_MODAL_ADD_CLIENTE: {
            return {
                ...state,
                modal_add: true
            }
        }
        case types.CLOSE_MODAL_ADD_CLIENTE: {
            return {
                ...state,
                modal_add: false
            }
        }
        case types.OPEN_MODAL_DEL_CLIENTE: {
            return {
                ...state,
                modal_del: true,
                modal_del_id: action.id
            }
        }
        case types.CLOSE_MODAL_DEL_CLIENTE: {
            return {
                ...state,
                modal_del: false,
                modal_del_id: null
            }
        }
        case types.SET_ELIMINAR_CLIENTE: {
            let clients = Array.from(state.clientes);
            clients = clients.filter(i => i.id != action.id);
            return {
                ...state,
                modal_del: false,
                modal_del_id: null,
                clientes: clients
            }
        }
        case types.CLOSE_MODAL_UPDATE_CLIENT: {
            return {
                ...state,
                modal_nuevo: false,
                modal_update_id: null
            }
        }
        case types.OPEN_MODAL_UPDATE_CLIENT: {
            return {
                ...state,
                modal_nuevo: true,
                modal_update_id: action.id,
            }
        }
        case types.SET_UPDATE_CLIENT: {
            let clients = Array.from(state.clientes);

            clients = clients.map((item, index) => {
                if (item.id == action.client.id) {
                    let clien = action.client;
                    return {
                        ...item,
                        ...clien
                    }
                }
                return item;
            });
            return {
                ...state,
                modal_update_id: null,
                modal_nuevo: false,
                clientes: clients
            }
        }
        case types.FETCH_UPDATE_CLIENT: {
            return {
                ...state,
                loading_nuevo: action.show
            }
        }
        default:
            return state;
    }
}
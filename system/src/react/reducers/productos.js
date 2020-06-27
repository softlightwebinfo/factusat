import * as types from '../actions/actionTypes';
import {aplication} from "../config/config";

const initialState = {
    productos: [],
    modal_nuevo: false,
    loader_nuevo: null,
    modal_add: false,
    modal_del: false,
    modal_del_id: null,
    modal_editar_id: null
};
export default function reducer(state = initialState, action) {
    switch (action.type) {
        case types.SET_PRODUCTOS: {
            return {
                ...state,
                productos: action.productos
            }
        }
        case types.CLOSE_MODAL_PRODUCTO_NUEVO: {
            return {
                ...state,
                modal_nuevo: false
            }
        }
        case types.OPEN_MODAL_PRODUCTO_NUEVO: {
            return {
                ...state,
                modal_nuevo: true
            }
        }
        case types.OPEN_MODAL_ADD_PRODUCTO: {
            return {
                ...state,
                modal_add: true
            }
        }
        case types.CLOSE_MODAL_ADD_PRODUCTO: {
            return {
                ...state,
                modal_add: false
            }
        }
        case types.ADD_PRODUCTO: {
            let products = Array.from(state.productos);
            products.unshift(action.producto);

            return {
                ...state,
                productos: products,
                modal_nuevo: false
            }
        }
        case types.FETCH_NEW_PRODUCT: {
            return {
                ...state,
                loading_nuevo: action.show
            }
        }
        case types.OPEN_MODAL_DEL_PRODUCTO: {
            return {
                ...state,
                modal_del: true,
                modal_del_id: action.id
            }
        }
        case types.CLOSE_MODAL_DEL_PRODUCTO: {
            return {
                ...state,
                modal_del: false,
                modal_del_id: null
            }
        }
        case types.SET_ELIMINAR_PRODUCTO: {
            let products = Array.from(state.productos);
            products = products.filter(e => e.id != action.id);

            return {
                ...state,
                modal_del: false,
                modal_del_id: null,
                productos: products
            }
        }
        case types.CLOSE_MODAL_EDITAR_PRODUCTO: {
            return {
                ...state,
                modal_nuevo: false,
                modal_editar_id: null
            }
        }
        case types.OPEN_MODAL_EDITAR_PRODUCTO: {
            return {
                ...state,
                modal_nuevo: true,
                modal_editar_id: action.id
            }
        }
        case types.SET_UPDATE_PRODUCTO: {
            let products = Array.from(state.productos);

            products = products.map((item, index) => {
                if (item.id == action.producto.id) {
                    return {
                        ...item,
                        ...action.producto
                    }
                } else {
                    return item;
                }
            });

            return {
                ...state,
                modal_nuevo: false,
                modal_editar_id: null,
                productos: products
            }
        }
        default:
            return state;
    }
}
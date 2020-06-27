import * as types from '../actions/actionTypes';
import {aplication} from "../config/config";

const initialState = {
    facturas: [],
    modal_nuevo: false,
    loading_nuevo: null,
    productos: [],
    cliente: null,
    pago: '',
    estado: '',
    idPrint: '',
    modal_del: false,
    modal_del_id: null,
    modal_update_id: null
};
export default function reducer(state = initialState, action) {
    switch (action.type) {
        case types.SET_FACTURAS: {
            return {
                ...state,
                facturas: action.facturas
            }
        }
        case types.OPEN_MODAL_FACTURA_NUEVA: {
            return {
                ...state,
                modal_nuevo: true
            }
        }
        case types.CLOSE_MODAL_FACTURA_NUEVA: {
            return {
                ...state,
                modal_nuevo: false
            }
        }
        case types.ADD_PRODUCTO_IN_FACTURA: {
            let product = Array.from(state.productos);

            product.push({
                id: action.id,
                cantidad: action.cantidad,
                precio: action.precio,
                ky: Date.now()
            });

            return {
                ...state,
                productos: product
            }
        }
        case types.DELETE_PRODUCTO_OUT_FACTURA: {
            let producto = Array.from(state.productos);

            producto = producto.filter(i => i.ky != action.key);

            return {
                ...state,
                productos: producto
            }
        }
        case types.ADD_CLIENTE_IN_FACTURA: {
            return {
                ...state,
                cliente: action.cliente,
            }
        }
        case types.ADD_PAGO_IN_FACTURA: {
            return {
                ...state,
                pago: action.pago
            }
        }
        case types.ADD_ESTADO_PAGO_IN_FACTURA: {
            return {
                ...state,
                estado: action.estado
            }
        }
        case types.CLEAR_NEW_FACTURA: {
            return {
                ...state,
                modal_nuevo: false,
                cliente: null,
                productos: [],
                estado: '',
                pago: '',
                idPrint: ''
            };
        }
        case types.ADD_NEW_FACTURA: {
            let factu = Array.from(state.facturas);
            factu.unshift(action.factura);

            return {
                ...state,
                idPrint: action.factura.id,
                facturas: factu
            }
        }
        case types.OPEN_MODAL_DEL_FACTURA: {
            return {
                ...state,
                modal_del: true,
                modal_del_id: action.id
            }
        }
        case types.CLOSE_MODAL_DEL_FACTURA: {
            return {
                ...state,
                modal_del: false,
                modal_del_id: null
            }
        }
        case types.SET_ELIMINAR_FACTURA: {
            let facturs = Array.from(state.facturas);
            facturs = facturs.filter(i => i.id != action.id);

            return {
                ...state,
                facturas: facturs,
                modal_del: false,
                modal_del_id: null
            }
        }
        case types.CLOSE_MODAL_UPDATE_FACTURA: {
            return {
                ...state,
                modal_nuevo: false,
                modal_update_id: null,
                cliente: null,
                pago: '',
                estado: '',
                productos: [],
            }
        }
        case types.OPEN_MODAL_UPDATE_FACTURA: {
            return {
                ...state,
                modal_nuevo: true,
                modal_update_id: action.id
            }
        }
        case types.ADD_PRODUCTOS_IN_FACTURA: {
            return {
                ...state,
                productos: action.productos
            }
        }
        default:
            return state;
    }
}
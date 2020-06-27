import * as types from '../actions/actionTypes';

const initialState = {
    empresa_datos_direccion: "",
    empresa_datos_email: "",
    empresa_datos_logo: "",
    empresa_datos_telefono: "",
    empresa_email_login: "",
    empresa_id: "",
    empresa_nombre: "",
    empresa_registro: "",
    empresa_role: "",
};
export default function reducer(state = initialState, action) {
    switch (action.type) {
        case types.SET_EMPRESA_DATOS: {
            return {
                ...state,
                ...action.datos
            }
        }
        case types.SET_MODIFICAR_EMPRESA: {

            return {
                ...state,
                ...action.datos
            }
        }
        default:
            return state;
    }
}
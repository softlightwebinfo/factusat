import axios from 'axios';

export function obtenerReparacion(id) {
    return axios
        .post(siteUrl('reparaciones/obtenerReparacion/'), {id})
        .then((response) => {
            return response;
        });
}

export function desplegableCliente(nombre) {
    return axios
        .post(siteUrl('reparaciones/desplegableCliente/'), {nombre})
        .then((response) => {
            return response;
        });
}

export function cortar_cadena(cadena, caracteres) {
    if (cadena.length > caracteres) {
        return cadena.substr(0, caracteres) + '...';
    } else {
        return cadena;
    }
}
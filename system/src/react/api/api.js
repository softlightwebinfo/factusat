import axios from 'axios';
import {url} from '../helps/urls';

class Api {
    static getUser() {
        return localStorage.getItem('user');
    }

    static getProductos() {
        return axios
            .get(url(`productos/getProductos/${Api.getUser()}`))
            .then(resp => resp.data);
    }

    static createProduct(producto) {
        return axios
            .post(url(`productos/createProduct/${Api.getUser()}`), producto)
            .then(resp => resp.data);
    }

    static getClientes() {
        return axios
            .get(url(`clientes/getClientes/${Api.getUser()}`))
            .then(resp => resp.data);
    }

    static createClient(cliente) {
        return axios
            .post(url(`clientes/createClient/${Api.getUser()}`), cliente)
            .then(resp => resp.data);
    }

    static getFacturas() {
        return axios
            .get(url(`facturas/getFacturas/${Api.getUser()}`))
            .then(resp => resp.data);
    }

    static getMetodosPagos() {
        return axios
            .get(url(`facturas/get-metodos-pagos/${Api.getUser()}`))
            .then(resp => resp.data);
    }

    static getEstadosPagos() {
        return axios
            .get(url(`facturas/get-estados-pagos/${Api.getUser()}`))
            .then(resp => resp.data);
    }

    static createFactura(factura) {
        return axios
            .post(url(`facturas/create-factura/${Api.getUser()}`), factura)
            .then(resp => resp.data);
    }

    static eliminarCliente(id) {
        return axios
            .post(url(`clientes/eliminar-cliente/${Api.getUser()}`), {id})
            .then(resp => resp.data);
    }

    static eliminarProducto(id) {
        return axios
            .post(url(`productos/eliminar-producto/${Api.getUser()}`), {id})
            .then(resp => resp.data);
    }

    static eliminarFactura(id) {
        return axios
            .post(url(`facturas/eliminar-factura/${Api.getUser()}`), {id})
            .then(resp => resp.data);
    }

    static updateCliente(datos) {
        return axios
            .post(url(`clientes/atualizar-cliente/${Api.getUser()}`), datos)
            .then(resp => resp.data);
    }

    static updateProducto(datos) {
        return axios
            .post(url(`productos/actualizar-producto/${Api.getUser()}`), datos)
            .then(resp => resp.data);
    }

    static getEmpresaDatos() {
        return axios
            .get(url(`empresa/getDatos/${Api.getUser()}`))
            .then(resp => resp.data);
    }

    static modificarEmpresa(datos) {
        return axios
            .post(url(`empresa/actualizar-empresa/${Api.getUser()}`), datos, {
                    headers: {'content-type': 'multipart/form-data'}
                }
            )
            .then(resp => resp.data);
    }

}

export default Api
var url = '';
var produccion = null;
if (window.location.hostname == 'localhost') {
    url = 'factusat';
    produccion = false;
} else {
    produccion = true;
}
export const conf = {
    url: url
};
export const production = produccion;
export const menu = [
    {img: 'buttons/1.jpg', name: 'facturas', icon: 'fa fa-user', url: 'facturas', description: 'Nueva reparción sirve para crear una nueva reparación', abbr: 'NU'},
    {img: 'buttons/1.jpg', name: 'productos', icon: 'fa fa-user', url: 'productos', description: 'Nueva reparción sirve para crear una nueva reparación', abbr: 'NU'},
    {img: 'buttons/1.jpg', name: 'clientes', icon: 'fa fa-user', url: 'clientes', description: 'Nueva reparción sirve para crear una nueva reparación', abbr: 'NU'},
    // {img: 'buttons/1.jpg', name: 'proveedores', icon: 'fa fa-user', url: 'proveedores', description: 'Nueva reparción sirve para crear una nueva reparación', abbr: 'NU'},
    // {img: 'buttons/1.jpg', name: 'usuarios', icon: 'fa fa-user', url: 'usuarios', description: 'Nueva reparción sirve para crear una nueva reparación', abbr: 'NU'},
    // {img: 'buttons/7.jpg', name: 'panel', icon: 'fa fa-user', url: 'panel', description: 'Nueva reparción sirve para crear una nueva reparación', abbr: 'PA'},
];
export const idiomas = [
    {name: 'ES', value: 'es'},
    {name: 'CAT', value: 'cat'},
    {name: 'EN', value: 'en'},
];
export const notificationTimer = 5000;
export const notificationMax = 3;
export const aplication = {
    nombre: 'FactuSat 0.1'
};
export const iva = 21;
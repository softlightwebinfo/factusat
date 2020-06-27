import {combineReducers} from 'redux';
import {routerReducer} from 'react-router-redux';
import {langReducer} from 'redux-lang';

import login from './login';
import notification from './notification';
import aplication from './aplication';
import productos from './productos';
import clientes from './clientes';
import facturas from './facturas';
import metodosPagos from './metodosPagos';
import estadosPagos from './estadosPagos';
import empresa from './empresa';


export default combineReducers({
    locale: langReducer('es'),
    login,
    notification,
    aplication,
    productos,
    clientes,
    facturas,
    metodosPagos,
    estadosPagos,
    empresa,
});
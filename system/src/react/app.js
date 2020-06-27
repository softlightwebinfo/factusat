// import libraries
import React from 'react';
import {render} from 'react-dom';
import {
    BrowserRouter as Router,
    Route,
    Link,
    Redirect,
    withRouter,
    Switch
} from 'react-router-dom';
import {Provider} from 'react-redux';
import {syncHistoryWithStore} from 'react-router-redux';
/* Components */
import HomePage from './pages/HomePage';
import LoginPage from './pages/LoginPage';
import ProductosPage from './pages/ProductosPage';
import ClientesPage from './pages/ClientesPage';
import FacturasPage from './pages/FacturasPage';


import Template from './components/Template';
import configStore from './store/configStore';
import {url} from "./helps/urls";

import createSockets from './sockets';

const store = configStore();
createSockets(store);

import createBrowserHistory from 'history/createBrowserHistory';
import {setUser} from "./actions/login";

const newHistory = createBrowserHistory();
if (localStorage.getItem("user")) {
    store.dispatch(setUser(localStorage.getItem("user")));
}
const UserIsLogged = (nextState, replace) => {
    if (store.getState().login.isLogged) {
        return false;
    }
    return true;
};

const UserNotIsLogged = () => {
    if (!store.getState().login.isLogged) {
        if (window.location.pathname != "/login/") {
            return -1;
        }
        return true;
    }
    return false;
};
const PrivateRoute = ({component: Component, ...rest}) => (
    <Route {...rest} render={props => {
        if (UserNotIsLogged() == -1) {
            return (<Redirect
                to={url('login')}
            />);
        }
        return (
            <Component {...props}/>
        );
    }}/>
);
const NormalRoute = ({component: Component, ...rest}) => (
    <Route {...rest} render={props => {
        if (!UserNotIsLogged()) {
            return (<Redirect
                to={url('')}
            />);
        }
        return (
            <Component {...props}/>
        );
    }}/>
);
const Auth = () => (
    <Provider store={store}>
        <Router>
            <Switch>
                <Template>
                    <NormalRoute exact path={url('login')} component={LoginPage}/>
                    <PrivateRoute exact path={url('')} component={HomePage}/>
                    <PrivateRoute exact path={url('productos')} component={ProductosPage}/>
                    <PrivateRoute exact path={url('clientes')} component={ClientesPage}/>
                    <PrivateRoute exact path={url('facturas')} component={FacturasPage}/>
                </Template>
            </Switch>
        </Router>
    </Provider>
);
render(
    <Auth/>,
    document.getElementById('app')
);
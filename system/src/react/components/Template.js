import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {
    Link, NavLink
} from 'react-router-dom';
import {url} from '../helps/urls';
import {connect} from 'react-redux';
import {menu} from '../config/config';
import Nav from "./Nav";
import reduxLang from '../middleware/lang';
import SystemNotification from "../containers/SystemNotification";
import Modal from "./Modal";
import ModalNuevoProducto from "../containers/ModalNuevoProducto";
import ModalNuevoCliente from "../containers/ModalNuevoCliente";
import ModalNuevaFactura from "../containers/ModalNuevaFactura";
import ModalAddProduct from "../containers/ModalAddProduct";
import ModalAddCliente from "../containers/ModalAddCliente";
import ModalDelCliente from "../containers/ModalDelCliente";
import ModalDelProducto from "../containers/ModalDelProducto";
import ModalDelFactura from "../containers/ModalDelFactura";

class Template extends Component {
    constructor() {
        super();
        this.state = {
            menu: menu
        }
        this.datos = this.datos.bind(this);
    }

    visibility() {
        let ok = ['login'];
        var url = this.props.location.pathname;
        var urlExplode = url.split('/');
        var okData = true;
        var datos = [];
        for (var i = 0; i < urlExplode.length; i++) {
            var data = urlExplode[i];
            if (data != "" && data != 'cibersat3.0') {
                datos.push(data);
                if (ok.indexOf(data) > -1) {
                    okData = false;
                    return;
                }
            }
        }
        if (datos.length == 0) {
            return false;
        }

        if (this.props.login.isLogged && okData) {
            return true;
        }
        return false;
    }

    render() {
        if (this.visibility()) {
            return (
                <div>
                    <Nav fixed aplication={this.props.aplication}>
                        {this.state.menu.map((item, index) => {
                            return (
                                <li key={index}>
                                    <NavLink className="is-active" exact to={url(item.url)}><i className={item.icon}></i> {this.props.t(item.name)}</NavLink>
                                </li>
                            );
                        })}
                    </Nav>
                    <section className="main">
                        {this.props.children}
                    </section>
                    <SystemNotification/>
                    {this.datos()}
                </div>
            );
        } else {
            return (
                <div>
                    <section>
                        {this.props.children}
                    </section>
                    <SystemNotification/>
                    {this.datos()}
                </div>
            );
        }
    }

    datos() {
        return (
            <div>
                <ModalNuevoProducto/>
                <ModalNuevoCliente/>
                <ModalNuevaFactura/>
                <ModalAddProduct/>
                <ModalAddCliente/>
                <ModalDelCliente/>
                <ModalDelProducto/>
                <ModalDelFactura/>
            </div>
        );
    }
}

const mapStateToProps = state => {
    return {
        login: state.login,
        aplication: state.aplication,
    }
};

const mapDispatchToProps = dispatch => {
    return {};
};
export default reduxLang('home')(connect(mapStateToProps, mapDispatchToProps)(Template));
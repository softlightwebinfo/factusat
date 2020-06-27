import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import {connect} from "react-redux";
import Image from "../components/Image";
import {url, urlPublic} from '../helps/urls';
import {fecha} from "../helps/fechas";
import Button from "../components/Button";
import Input from "../components/Input";
import {modificarEmpresa} from '../actions/empresa';

class User extends Component {
    constructor() {
        super();
        this.state = {
            modificar: false
        };
        this.guardarDatos = this.guardarDatos.bind(this);
        this.modificarDatos = this.modificarDatos.bind(this);
        this.datos = this.datos.bind(this);
    }

    change(e) {
        this.props.addEstadoPagoInInvoice(e.target.value);
    }

    modificarDatos(e) {
        this.setState({
            modificar: !this.state.modificar
        });
    }

    guardarDatos(e) {
        this.setState({
            modificar: false
        });
        console.log(this);
        let dato = {
            empresa_datos_email: this._empresa_datos_email.value,
            empresa_datos_telefono: this._empresa_datos_telefono.value,
            empresa_datos_direccion: this._empresa_datos_direccion.value,
            empresa_nombre: this._empresa_nombre.value,
            empresa_datos_logo: this._empresa_datos_logo
        };
        let data = new FormData();
        data.append('empresa_datos_email', this._empresa_datos_email.value);
        data.append('empresa_datos_telefono', this._empresa_datos_telefono.value);
        data.append('empresa_datos_direccion', this._empresa_datos_direccion.value);
        data.append('empresa_nombre', this._empresa_nombre.value);
        data.append('empresa_datos_logo', this._empresa_datos_logo.files[0]);
        this.props.modificarEmpresa(data);
    }

    datos() {
        if (this.state.modificar) {
            return (
                <div>
                    <Image
                        className="C-User__avatar"
                        img={urlPublic(`usuario/${this.props.empresa.empresa_id}/${this.props.empresa.empresa_datos_logo}`, false)}
                    />
                    <input className="C-User__file" type="file" ref={e => this._empresa_datos_logo = e}/>
                    <h3
                        className="C-User__nombre"
                    >
                        <i className="fa fa-user"></i>
                        <Input
                            refs={e => this._empresa_nombre = e}
                            defaultValue={this.props.empresa.empresa_nombre}/>
                    </h3>
                    <ul className="R-ListaDatos">
                        <li className="R-ListaDatos__item--update">
                            <i className="fa fa-envelope"></i>
                            <Input
                                refs={e => this._empresa_datos_email = e}
                                defaultValue={this.props.empresa.empresa_datos_email}/>
                        </li>
                        <li className="R-ListaDatos__item--update">
                            <i className="fa fa-phone"></i>
                            <Input
                                refs={e => this._empresa_datos_telefono = e}
                                defaultValue={this.props.empresa.empresa_datos_telefono}/>
                        </li>
                        <li className="R-ListaDatos__item--update">
                            <i className="fa fa-map-marker"></i>
                            <Input
                                refs={e => this._empresa_datos_direccion = e}
                                defaultValue={this.props.empresa.empresa_datos_direccion}/>
                        </li>
                        <li style={{marginTop: 10, marginBottom: 10}} className="R-ListaDatos__item--update">
                            <i className="fa fa-clock-o"></i>
                            {fecha(this.props.empresa.empresa_registro)}
                        </li>
                    </ul>

                    <Button default className="C-User__button" onClick={this.guardarDatos}>Guardar los datos</Button>
                </div>
            );
        } else {
            return (
                <div>
                    <Image
                        className="C-User__avatar"
                        img={urlPublic(`usuario/${this.props.empresa.empresa_id}/${this.props.empresa.empresa_datos_logo}`, false)}
                    />
                    <h3
                        className="C-User__nombre"
                    >
                        {this.props.empresa.empresa_nombre}
                    </h3>
                    <ul className="R-ListaDatos">
                        <li className="R-ListaDatos__item"><i className="fa fa-envelope"></i> {this.props.empresa.empresa_datos_email}</li>
                        <li className="R-ListaDatos__item"><i className="fa fa-phone"></i> {this.props.empresa.empresa_datos_telefono}</li>
                        <li className="R-ListaDatos__item"><i className="fa fa-map-marker"></i>{this.props.empresa.empresa_datos_direccion}</li>
                        <li className="R-ListaDatos__item"><i className="fa fa-clock-o"></i> {fecha(this.props.empresa.empresa_registro)}</li>
                    </ul>

                    <Button default className="C-User__button" onClick={this.modificarDatos}>Modificar datos</Button>
                </div>
            );
        }
    }

    render() {
        let classes = {
            name: 'C-User'
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                {this.datos()}
            </div>
        );
    }
}


const mapStateToProps = state => {
    return {
        empresa: state.empresa
    }
};
export default connect(mapStateToProps, {modificarEmpresa})(User);
import React, {Component} from 'react';
import cx from 'bem-classnames';
import ModalDialog from "./ModalDialog";
import PropTypes from 'prop-types';

class Modal extends Component {
    constructor() {
        super();
    }

    cerrar(e) {
        if (e.target !== e.currentTarget) {
            return;
        }
        this.props.onClickClose(e)
    }

    render() {
        var classes = {
            name: 'R-Modal',
            modifiers: ['show', 'alerta', 'full', 'medium'],
            states: []
        };
        return (
            <section className={cx(classes, this.props, this.props.className)} onClick={e => this.cerrar(e)}>
                <ModalDialog
                    btnAceptar={this.props.btnAceptar}
                    btnCancelar={this.props.btnCancelar}
                    title={this.props.title}
                    onClickClose={e => this.props.onClickClose(e)}
                    onClickOk={e => this.props.onClickOk(e)}
                >
                    {this.props.children}
                </ModalDialog>
            </section>
        );
    }
}

Modal.propTypes = {
    show: PropTypes.bool,
    onClickClose: PropTypes.func,
    onClickOk: PropTypes.func,
    title: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.element,
        PropTypes.object
    ]),
    alerta: PropTypes.bool,
    full: PropTypes.bool,
    medium: PropTypes.bool,
    btnAceptar: PropTypes.string,
    btnCancelar: PropTypes.string
};
export default Modal;
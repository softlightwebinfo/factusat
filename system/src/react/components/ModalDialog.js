import React, {Component} from 'react';
import cx from 'bem-classnames';
import PropTypes from 'prop-types';

class ModalDialog extends Component {
    constructor() {
        super();
    }

    render() {
        var classes = {
            name: 'R-Modal-dialog',
            modifiers: [],
            states: []
        };
        return (
            <article className={cx(classes, this.props, this.props.className)}>
                <header className="R-Modal-dialog__header">
                    <h3 className="R-Modal-dialog__title">{this.props.title}</h3>
                    <button className="Button--icon Button R-Modal-dialog__close" onClick={e => this.props.onClickClose(e)}><i className="fa fa-close"></i></button>
                </header>
                <section className="R-Modal-dialog__body">
                    {this.props.children}
                </section>
                {this.loadFooter()}
            </article>
        );
    }

    loadFooter() {
        if (this.props.btnAceptar || this.props.btnCancelar) {

            return (
                <footer className="R-Modal-dialog__footer">
                    {this.props.btnAceptar && <button className="Button Button--neutral" onClick={e => this.props.onClickOk(e)}>{this.props.btnAceptar}</button>}
                    {this.props.btnCancelar && <button className="Button Button--neutral" onClick={e => this.props.onClickClose(e)}>{this.props.btnCancelar}</button>}
                </footer>
            );
        }
    }
}

ModalDialog.propTypes = {
    onClickClose: PropTypes.func.isRequired,
    onClickOk: PropTypes.func,
    title: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.element,
        PropTypes.object
    ]),
    btnAceptar: PropTypes.string,
    btnCancelar: PropTypes.string
};

export default ModalDialog;
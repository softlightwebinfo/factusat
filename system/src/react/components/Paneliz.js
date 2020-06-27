import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class Paneliz extends Component {
    render() {
        var classes = {
            name: 'R-Paneliz',
            modifiers: []
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                <header className="R-Paneliz__header">
                    <h3 className="R-Paneliz__title">
                        <i className={this.props.icon}></i>
                        <span>{this.props.title}</span>
                    </h3>
                    <div className="R-Paneliz__right">{this.props.right}</div>
                </header>
                <section className="R-Paneliz__body">
                    {this.props.children}
                </section>
            </div>
        );
    }
}

Paneliz.propTypes = {
    className: PropTypes.string,
    right: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.element,
        PropTypes.array,
        PropTypes.object
    ]),
    title: PropTypes.string.isRequired,
    icon: PropTypes.string
};
export default Paneliz;
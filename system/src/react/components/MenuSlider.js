import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import classNames from 'classnames';
import User from "../containers/User";

class MenuSlider extends Component {
    constructor() {
        super();
        this.state = {
            estado: false
        };
    }

    toogle() {
        this.setState({
            estado: !this.state.estado
        })
    }

    button() {
        if (!this.state.estado) {
            return (
                <i className="fa fa-bars"></i>
            );
        } else {
            return (
                <i className="fa fa-arrow-left"></i>
            );
        }
    }

    render() {
        var classes = {
            panel: {
                name: 'R-MenuSlider',
                modifiers: ['open', 'close']
            },
            bar: {
                name: `R-Nav__bar`,
                modifiers: []
            },
        };
        return (
            <div className={cx(classes.panel, this.props, this.props.className, classNames({'R-MenuSlider--open': this.state.estado}, {'R-MenuSlider--close': !this.state.estado}))}>
                <button onClick={e => this.toogle()} className={cx(classes.bar, this.props, this.props.className, 'R-MenuSlider__trigger')}>
                    {this.button()}
                </button>
                <div className="R-MenuSlider__menu">
                    <User/>
                </div>
            </div>
        );
    }
}

MenuSlider.propTypes = {
    className: PropTypes.string,
    children: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.array,
        PropTypes.element,
        PropTypes.object
    ])
};
export default MenuSlider;
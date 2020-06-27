import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class Loader extends PureComponent {
    render() {
        var classes = {
            name: 'R-Loader',
            modifiers: []
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                <svg className="R-Loader__circular" viewBox="25 25 50 50">
                    <circle className="path" cx="50" cy="50" r="20" fill="none" strokeWidth="2" strokeMiterlimit="10"/>
                </svg>
            </div>
        );
    }
}

export default Loader;
import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class OverflowScroll extends PureComponent {
    render() {
        var classes = {
            name: 'R-OverflowScroll',
            modifiers: []
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                {this.props.children}
            </div>
        );
    }
}

OverflowScroll.propTypes = {
    className: PropTypes.string,
};
export default OverflowScroll;
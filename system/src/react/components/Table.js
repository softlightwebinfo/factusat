import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class Table extends PureComponent {
    render() {
        var classes = {
            name: 'R-Table',
            modifiers: ['linia']
        };
        return (
            <table className={cx(classes, this.props, this.props.className, 'table table-striped table-hover')}>
                {this.props.children}
            </table>
        );
    }
}

Table.propTypes = {
    className: PropTypes.string,
    linia: PropTypes.bool,
};
export default Table;
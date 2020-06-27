import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class Cards extends Component {
    constructor() {
        super();
    }

    render() {
        let classes = {
            name: 'R-Cards'
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                {this.props.children}
            </div>
        );
    }
}

Cards.propTypes = {
    className: PropTypes.string,
    children: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.element,
        PropTypes.array,
        PropTypes.object
    ])
};
export default Cards;
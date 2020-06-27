import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class Avatar extends PureComponent {
    render() {
        var classes = {
            name: 'R-Avatar',
            modifiers: ['large', 'large-xl', 'circle']
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                <img src={this.props.img} className={`${classes.name}__image`} alt=""/>
            </div>
        );
    }
}

Avatar.propTypes = {
    img: PropTypes.string,
    className: PropTypes.string,
    large: PropTypes.bool,
    'large-xl': PropTypes.bool,
    circle: PropTypes.bool
};
export default Avatar;
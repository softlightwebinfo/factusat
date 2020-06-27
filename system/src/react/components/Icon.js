import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class AvatarAbbr extends PureComponent {
    render() {
        var classes = {
            name: 'Icon',
            modifiers: ['x-small', 'text-default', 'large']
        };
        return (
            <svg className={cx(classes, this.props, this.props.className)}>
                <use xlinkHref={siteUrl(`system/src/libs/codeunic/assets/icons/${this.props.type}.svg#${this.props.icon}`)}></use>
            </svg>
        );
    }
}

AvatarAbbr.defaultProps = {
    type: 'symbols'
};
AvatarAbbr.propTypes = {
    className: PropTypes.string,
    type: PropTypes.string,
    'x-small': PropTypes.bool,
    'text-default': PropTypes.bool,
    'icon': PropTypes.string,
    large: PropTypes.bool,
};
export default AvatarAbbr;
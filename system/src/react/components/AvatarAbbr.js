import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class AvatarAbbr extends PureComponent {
    render() {
        var classes = {
            name: 'Avatar',
            modifiers: []
        };
        return (
            <span className={cx(classes, this.props, this.props.className)}>
                <abbr className="Avatar__abbr" title={this.props.abbr}>{this.props.abbr}</abbr>
            </span>
        );
    }
}

AvatarAbbr.propTypes = {
    abbr: PropTypes.string.isRequired,
    className: PropTypes.string,
};
export default AvatarAbbr;
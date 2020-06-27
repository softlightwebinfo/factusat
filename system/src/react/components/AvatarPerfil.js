import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class AvatarPerfil extends PureComponent {
    render() {
        var classes = {
            name: 'R-AvatarPerfil',
            modifiers: []
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                <img src={this.props.img} className={`${classes.name}__image`} alt=""/>
            </div>
        );
    }
}

AvatarPerfil.propTypes = {
    img: PropTypes.string,
    className: PropTypes.string,
};
export default AvatarPerfil;
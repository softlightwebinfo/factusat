import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class Image extends PureComponent {
    render() {
        var classes = {
            name: 'R-Image',
            modifiers: ['large', 'logo', 'mobil', 'circle']
        };
        return (
            <img src={this.props.img} className={cx(classes, this.props, this.props.className)} alt=""/>
        );
    }
}

Image.propTypes = {
    img: PropTypes.string,
    logo: PropTypes.bool,
    mobil: PropTypes.bool,
    className: PropTypes.string,
};
export default Image;
import React, {Component} from 'react';
import PropTypes from 'prop-types';
import Icon from "./Icon";
import cx from 'bem-classnames';
import {url} from '../helps/urls';

class Sound extends Component {
    constructor() {
        super();
        this._dir = url('public/sound');
    }

    componentDidMount() {
        var audio = new Audio(this._dir + this.props.sound);
        audio.play();
    }

    render() {
        let classes = {
            name: 'Sound',
            modifiers: []
        };
        return (
            <span className={cx(classes, this.props, this.props.className)}></span>
        );
    }
}

Sound.propTypes = {
    className: PropTypes.string,
    children: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.element
    ]),
    sound: PropTypes.string
};
export default Sound;
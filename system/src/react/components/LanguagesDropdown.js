import React, {PureComponent} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import reduxLang from '../middleware/lang'
import {idiomas} from '../config/config';

class LanguagesDropdown extends PureComponent {
    render() {
        var classes = {
            name: '',
            modifiers: []
        };
        return (
            <select
                className=''
                value={this.props.locale}
                onChange={(event) => this.props.setLocale(event.target.value)}
            >
                {idiomas.map((item) => {
                    return (
                        <option key={item.value} value={item.value}>{item.name}</option>
                    );
                })}
            </select>
        );
    }
}

export default reduxLang('home')(LanguagesDropdown);
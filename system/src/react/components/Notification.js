import React, {Component} from 'react';
import PropTypes from 'prop-types';
import Icon from "./Icon";
import cx from 'bem-classnames';
import Sound from "./Sound";

class Notification extends Component {
    constructor(props) {
        super(props);
        this.state = {
            timer: null
        };
    }

    componentDidMount() {
        if (this.props.timer !== 0) {
            this.state.timer = setTimeout(() => {
                this.props.onTimer();
            }, this.props.timer);
        }
    }

    timer() {

    }

    render() {
        let classes = {
            name: 'R-Notification',
            modifiers: []
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                <Sound sound="1.mp3"/>
                <div className="R-Notification__close" onClick={this.props.onClose}><Icon icon='close'/></div>
                <div className="R-Notification__Icon"><Icon icon={this.props.icon}/></div>
                <div className="R-Notification__body">
                    <b className="R-Notification__title">{this.props.title}</b>
                    <span className="R-Notification__subtitle">{this.props.subtitle}</span>
                    <div className="R-Notification__content">{this.props.children}</div>
                </div>
            </div>
        );
    }
}

Notification.defaultProps = {
    onClose: () => {
    },
    onTimer: () => {
    },
    timer: 0
};
Notification.propTypes = {
    className: PropTypes.string,
    children: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.element
    ]),
    icon: PropTypes.string,
    title: PropTypes.string,
    subtitle: PropTypes.string,
    onClose: PropTypes.func,
    timer: PropTypes.number,
    onTimer: PropTypes.func
};
export default Notification;
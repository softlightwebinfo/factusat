import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';
import Notifications from "../components/Notifications";
import {connect} from "react-redux";
import Notification from "../components/Notification";
import {notificationTimer, notificationMax} from '../config/config';
import {notificationClose} from '../actions/notifications';

class SystemNotification extends Component {
    constructor() {
        super();
        this.state = {};
        this._maxNot = notificationMax;
        this._timer = notificationTimer;
    }

    componentDidMount() {

    }

    timer(item) {
        this.props.notificationClose(item)
    }

    close(e, item) {
        this.props.notificationClose(item)
    }

    render() {
        return (
            <Notifications>
                {this.props.notifications.map((item, index) => {
                    if (index > (this._maxNot - 1)) {
                        return;
                    }
                    return (
                        <Notification
                            key={item.id}
                            icon={item.icon}
                            title={item.title}
                            subtitle={item.subtitle}
                            onClose={e => this.close(e, item.id)}
                            onTimer={e => this.timer(item.id)}
                            timer={this._timer}
                        >
                            {item.content}
                        </Notification>
                    );
                })}
            </Notifications>
        );
    }
}


const mapStateToProps = state => {
    return {
        notifications: state.notification.notifications
    }
};
export default connect(mapStateToProps, {notificationClose})(SystemNotification);
import React, {Component} from 'react';
import PropTypes from 'prop-types';
import cx from 'bem-classnames';

class Timer extends Component {
    constructor() {
        super();
        this.state = {
            interval: null,
            hour: 0,
            min: 0,
            sec: 0
        };
        this._timer = 1000;
    }

    componentDidMount() {
        this.state.interval = setInterval(() => {
            let ahora = new Date(),
                hora_actual = ahora.getHours(),
                min_actual = ahora.getMinutes(),
                sec_actual = ahora.getSeconds(),
                hora = (hora_actual < 10) ? '0' + hora_actual : hora_actual,
                min = (min_actual < 10) ? '0' + min_actual : min_actual,
                sec = (sec_actual < 10) ? '0' + sec_actual : sec_actual;

            this.setState({
                hour: hora,
                min: min,
                sec: sec
            })
        }, this._timer)
    }

    componentWillUnmount() {
        clearInterval(this._timer);
    }

    render() {
        var classes = {
            name: 'R-Timer',
            modifiers: []
        };
        return (
            <div className={cx(classes, this.props, this.props.className)}>
                <span className="R-Timer__hour">{this.state.hour}</span>
                <span className="R-Timer__separate">:</span>
                <span className="R-Timer__min">{this.state.min}</span>
                <span className="R-Timer__separate">:</span>
                <span className="R-Timer__sec">{this.state.sec}</span>
            </div>
        );
    }
}

Timer.propTypes = {
    className: PropTypes.string,
};
export default Timer;
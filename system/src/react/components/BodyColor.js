import React from 'react'
import PropTypes from 'prop-types';

class BodyColor extends React.Component {

    componentDidMount() {
        document.body.classList.toggle('darkClass', this.props.isDark)
    }

    componentWillReceiveProps(nextProps) {
        document.body.classList.toggle('darkClass', nextProps.isDark)
    }

    componentWillUnmount() {
        document.body.classList.remove('darkClass')
    }

    render() {
        return this.props.children
    }
}

BodyColor.propTypes = {
    isDark: PropTypes.bool
};
BodyColor.defaultProps = {
    isDark: false
};

export default BodyColor;
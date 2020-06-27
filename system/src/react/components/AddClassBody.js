import React from 'react'
import PropTypes from 'prop-types';

class AddClassBody extends React.Component {

    componentDidMount() {
        document.body.classList.toggle(this.props.className, true)
    }

    componentWillReceiveProps(nextProps) {
        document.body.classList.toggle(this.props.className, true);
    }

    componentWillUnmount() {
        document.body.classList.remove(this.props.className);
    }

    render() {
        return this.props.children
    }
}

AddClassBody.propTypes = {
    className: PropTypes.string
};

export default AddClassBody;
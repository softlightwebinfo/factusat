import React from 'react'
import PropTypes from 'prop-types';

class BodyFondo extends React.Component {

    componentDidMount() {
        document.body.classList.toggle('darkClass', this.props.isDark);
        if (this.props.fondo !== '') {
            document.body.classList.add('fondo');
            document.body.style.backgroundImage = `url(${this.props.fondo})`;
        }
    }

    componentWillReceiveProps(nextProps) {
        document.body.classList.toggle('darkClass', nextProps.isDark);
        if (nextProps.fondo !== '') {
            document.body.classList.add('fondo');
            document.body.style.backgroundImage = `url(${nextProps.fondo})`;
        }
    }

    componentWillUnmount() {
        document.body.classList.remove('darkClass');
        document.body.classList.remove('fondo');
        document.body.style = '';
    }

    render() {
        return (
            <div>
                {this.props.children}
            </div>
        )
    }
}

BodyFondo.propTypes = {
    isDark: PropTypes.bool,
    fondo: PropTypes.string,
    children: PropTypes.oneOfType([
        PropTypes.element,
        PropTypes.object,
        PropTypes.array
    ])
};
BodyFondo.defaultProps = {
    isDark: false,
    fondo: ''
};

export default BodyFondo;
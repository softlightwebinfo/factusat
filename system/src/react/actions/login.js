import * as types from './actionTypes';
import axios from 'axios';
import {url} from '../helps/urls';

export function setUser(user) {
    return {
        type: types.LOGIN_USER,
        user
    }
}

export function badUser(data) {
    return {
        type: types.BAD_USER,
        data
    }
}

export function logout() {
    return {
        type: types.LOGOUT
    }
}

export function login(data) {
    return dispatch => {
        axios
            .post(url('login/iniciar-session'), {
                email: data.email,
                password: data.password
            })
            .then((response) => {
                if (response.data.error == false) {
                    localStorage.setItem('user', response.data.user._token);
                    dispatch(setUser({
                        _id: response.data.user._token,
                        errors: ''
                    }));
                } else {
                    dispatch(badUser({
                        _id: '',
                        errors: response.data.errorMensaje
                    }));
                }
            });
    }
}

export function cerrarSession() {
    localStorage.removeItem('user');
    return {
        type: types.LOGOUT
    };
}
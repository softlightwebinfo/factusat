import * as types from '../actions/actionTypes';
const initialState = {
    isLogged: false,
    user: {},
    errors: ''
};
export default function reducer(state = initialState, action) {
    switch (action.type) {
        case types.LOGIN_USER: {
            return {
                isLogged: true,
                user: action.user
            }
        }
        case types.BAD_USER: {
            return {
                isLogged: false,
                user: {},
                errors: action.data.errors
            }
        }
        case types.LOGOUT: {
            return {
                isLogged: false,
                user: {}
            };
        }
        default:
            return state;
    }
}
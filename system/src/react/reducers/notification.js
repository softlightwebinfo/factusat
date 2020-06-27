import * as types from '../actions/actionTypes';

const initialState = {
    notifications: [
        // {id: 12354, icon: 'settings', title: 'Rafa Gonzalez Muñoz', subtitle: 'Urgente', content: 'Esto es una averia de prueba, aver que pasa'},
        // {id: 12355, icon: 'settings', title: 'Rafa Gonzalez Muñoz', subtitle: 'Urgente', content: 'Esto es una averia de prueba, aver que pasa'},
        // {id: 12356, icon: 'settings', title: 'Rafa Gonzalez Muñoz', subtitle: 'Urgente', content: 'Esto es una averia de prueba, aver que pasa'},
    ]
};
export default function reducer(state = initialState, action) {
    switch (action.type) {
        case types.ADD_NOTIFICATION: {
            let not = action.notification;
            let notifications = Array.from(state.notifications);
            notifications.unshift(not);
            return {
                ...state,
                notifications: notifications
            }
        }
        case types.SET_NOTIFICATION: {
            return {
                ...state,
                notifications: action.notifications
            }
        }
        case types.DELETE_NOTIFICATION: {
            let notifications = Array.from(state.notifications);

            notifications = notifications.filter(i => i.id !== action.id);

            return {
                ...state,
                notifications: notifications
            }
        }
        case types.CLEAR_NOTIFICATION:{
            return {
                ...initialState
            }
        }
        default:
            return state;
    }
}
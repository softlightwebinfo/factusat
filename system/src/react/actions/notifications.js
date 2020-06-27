import * as types from '../actions/actionTypes';
import {url} from "../helps/urls";
import axios from 'axios';
import Api from '../api/api';

export function notificationClose(id) {
    return {
        type: types.DELETE_NOTIFICATION,
        id
    }
}

export function addNotification(notification) {
    return {
        type: types.ADD_NOTIFICATION,
        notification
    }
}
export function clear_notifications() {
    return{
        type:types.CLEAR_NOTIFICATION
    }
}
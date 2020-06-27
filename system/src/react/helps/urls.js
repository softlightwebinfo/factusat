import {conf, production} from '../config/config';

function url(url, final = true) {
    if (url == '') {
        if (production) {
            return (`/`);
        } else {
            if (final) {
                return `/${conf.url}/`;
            } else {
                return `/${conf.url}`;
            }
        }
    }
    if (production) {
        if (final) {
            return `/${url}/`;
        } else {
            return `/${url}`;
        }
    } else {
        if (final) {
            return `/${conf.url}/${url}/`;
        } else {
            return `/${conf.url}/${url}`;
        }
    }
}

function urlPublic(string) {
    let u = url('public/' + string, false);


    return u;
}

export {
    url,
    urlPublic
}
import createLogger from 'redux-logger';
import {createStore, applyMiddleware, compose} from 'redux';
import reducers from '../reducers';
import thunk from 'redux-thunk';

// const logger = createLogger();
import {createReparacion} from '../sockets';

const middleware = [thunk, createReparacion];

export default function configStore(initialState) {
    return createStore(
        reducers,
        initialState,
        compose(
            applyMiddleware(...middleware),
            window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__()
        )
    );
};
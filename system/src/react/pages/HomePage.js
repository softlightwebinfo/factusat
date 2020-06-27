import React, {Component} from 'react';
import {menu} from '../config/config';
import reduxLang from '../middleware/lang';
import Target from "../components/Target";
import Grilla from "../components/Grilla";
import {url} from "../helps/urls";

class HomePage extends Component {
    constructor() {
        super();
        this.state = {};
    }

    render() {
        return (
            <div>
                <Grilla>
                    {menu.map((item, index) => {
                        return (
                            <div
                                key={index}
                                className="Grilla__xs--12 Grilla__sm--6 Grilla__md--4 Grilla__xl--4 Grilla__xxl--4"
                            >
                                <Target
                                    link={url(item.url)}
                                    icon={item.icon}
                                    title={this.props.t(item.name)}
                                />
                            </div>
                        );
                    })}
                </Grilla>
            </div>
        );
    }
}

export default reduxLang('home')(HomePage);
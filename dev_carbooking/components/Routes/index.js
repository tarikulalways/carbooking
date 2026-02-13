import Bookings from "./../../containers/pages/Bookings";
import Dashboard from "./../../containers/pages/Dashboard";
import Service from "./../../containers/pages/Service";
import Shortcode from './../../containers/pages/Shortcode';
import Settings from "./../../containers/pages/Settings";

export const routes = {
    'carbooking': {
        title: 'Dashboard',
        component: Dashboard
    },
    'carbooking-service': {
        title: 'Service',
        component: Service
    },
    'carbooking-bookings': {
        title: 'Bookings',
        component: Bookings
    },
    'carbooking-shortcode': {
        title: 'Shortcode',
        component: Shortcode
    },
    'carbooking-settings': {
        title: 'Settings',
        component: Settings
    }
};

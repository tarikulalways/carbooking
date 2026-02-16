import Bookings from "./../../containers/pages/Bookings";
import Dashboard from "./../../containers/pages/Dashboard";
import Service from "./../../containers/pages/Service";
import Shortcode from './../../containers/pages/Shortcode';
import Settings from "./../../containers/pages/Settings";
import General from "../../containers/pages/Settings/Tabs/General";
import Payment from "../../containers/pages/Settings/Tabs/Payment";
import Emails from "../../containers/pages/Settings/Tabs/Emails";

export const routes = {
    'easybooking': {
        title: 'Dashboard',
        component: Dashboard
    },
    'easybooking-service': {
        title: 'Service',
        component: Service
    },
    'easybooking-bookings': {
        title: 'Bookings',
        component: Bookings
    },
    'easybooking-shortcode': {
        title: 'Shortcode',
        component: Shortcode
    },
    'easybooking-settings': {
        title: 'Settings',
        component: Settings
    },
    'general': {
        title: 'general',
        component: General
    },
    'payment': {
        title: 'Payment',
        component: Payment
    },
    'emails': {
        title: 'Emails',
        component: Emails
    }
};

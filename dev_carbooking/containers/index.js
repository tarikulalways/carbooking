import Bookings from "./pages/Bookings";
import Dashboard from "./pages/Dashboard";
import Service from "./pages/Service";
import Shortcode from "./pages/Shortcode";
import Settings from "./pages/Settings";
import { useLocationQuery } from '../helper';

const BackendDashboard = () => {
    const query = useLocationQuery();

    const randerSwitch = (page, id) => {
        switch(page){
            case 'carbooking':
                return <Dashboard/>;
            case 'carbooking-service':
                return <Service/>;
            case 'carbooking-bookings':
                return <Bookings/>;
            case 'carbooking-shortcode':
                return <Shortcode/>;
            case 'carbooking-settings':
                return <Settings/>;
            default:
                return 'no route found';
        }
    }

    return(
        <>
            {
                randerSwitch(
                    query.getValue('page')
                )
            }
        </>
    )
}
export default BackendDashboard;
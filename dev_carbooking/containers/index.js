import Bookings from "./pages/Bookings";
import Dashboard from "./pages/Dashboard";
import Service from "./pages/Service";
import Shortcode from "./pages/Shortcode";
import Settings from "./pages/Settings";

const BackendDashboard = () => {
    return(
        <>
            <Dashboard/>
            <Service/>
            <Bookings/>
            <Shortcode/>
            <Settings/>
        </>
    )
}
export default BackendDashboard;
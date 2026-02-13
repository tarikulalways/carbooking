import { routes } from '../components/Routes';
import { useLocationQuery } from '../helper';

const BackendDashboard = () => {
    const query = useLocationQuery();
    const page = query.getValue('page');
    const CurrentComponent = routes[page]?.component;
    return(
        <>
            {CurrentComponent ? <CurrentComponent /> : 'No route found'}
        </>
    )
}
export default BackendDashboard;
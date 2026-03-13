import { routes } from '../components/Routes';
import { useLocationQuery } from '../helper';

const BackendDashboard = () => {
    const query = useLocationQuery();
    const page = query.getValue('page');
    const tab = query.getValue('tab');

    let CurrentComponent = null;

 if (page && routes[page]) {
        CurrentComponent = routes[page].component;
    }
    
    return(
        <>
            {CurrentComponent ? <CurrentComponent /> : 'No route found'}
        </>
    )
}
export default BackendDashboard;
import { routes } from '../Routes';
import { Link } from 'react-router-dom';

const AdminMenu = () => {
    return (
        <ul>
            {Object.entries(routes).map(([key, item]) => (
                <li key={key}>
                    <Link to={`wp-admin/admin.php?page=${key}`}>
                        {item.title}
                    </Link>
                </li>
            ))}
        </ul>
    );
};

export default AdminMenu;

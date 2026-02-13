import { Link } from "react-router-dom";
const Settings = () => {
    const tabs = [
        {
            title: "General",
            icon: <span class="dashicons dashicons-admin-generic"></span>,
            slug: 'general'
        },
        {
            title: "Payment",
            icon: <span class="dashicons dashicons-cart"></span>,
            slug: 'payment'
        },
        {
            title: "Emails",
            icon: <span class="dashicons dashicons-email"></span>,
            slug: 'emails'
        }
    ];
    return(
        <>
            <div className="carbk-setting-container">
                <div className="carbk-setting-sidebar">
                    <ul>
                        {tabs.map((item)=>(
                            <li>
                                {item.icon}
                                <Link to={`wp-admin/admin.php?page=carbooking&tab=${item.slug}`}>
                                    {item.title}
                                </Link>
                            </li>
                        ))}
                    </ul>
                </div>
                <div className="carbk-setting-content">

                </div>
            </div>
        </>
    )
}

export default Settings;
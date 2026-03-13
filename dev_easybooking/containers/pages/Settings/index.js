import { useSearchParams } from "react-router-dom";
import { useEffect } from "react";
import General from "./Tabs/General";
import Payment from "./Tabs/Payment";
import Emails from "./Tabs/Emails";
import './style.css';

const Settings = () => {

    const [searchParams, setSearchParams] = useSearchParams();

    const currentTab = searchParams.get('tab');

    useEffect(() => {
        if (!searchParams.get('tab')) {
            searchParams.set('tab', 'general'); // set default tab
            setSearchParams(searchParams);      // update URL
        }
    }, []);
    
    const changeTab = (slug) => {
        searchParams.set("tab", slug);
        setSearchParams(searchParams);
    };

    const randerTab = () => {
        switch(currentTab){
            case 'general':
                return <General/>
            case 'payment':
                return <Payment/>
            case 'emails':
                return <Emails/>
            default:
                return <General/>
        }
    }

    const tabs = [
        {
            title: "General",
            icon: <span className="dashicons dashicons-admin-generic"></span>,
            slug: "general",
        },
        {
            title: "Payment",
            icon: <span className="dashicons dashicons-cart"></span>,
            slug: "payment"
        },
        {
            title: "Emails",
            icon: <span className="dashicons dashicons-email"></span>,
            slug: "emails"
        }
    ];

    return (
        <div className="carbk-setting-container">

            <div className="carbk-setting-sidebar">
                <ul>
                    {tabs.map((item)=>(
                        <li key={item.slug}>
                            <button
                                onClick={() =>changeTab(item.slug)}
                            >
                                {item.icon} {item.title}
                            </button>
                        </li>
                    ))}
                </ul>
            </div>

            <div className="carbk-setting-content">
                {randerTab()}
            </div>

        </div>
    )
}

export default Settings;
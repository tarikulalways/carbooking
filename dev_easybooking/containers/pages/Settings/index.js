import { useSearchParams } from "react-router-dom";
import General from "./Tabs/General";
import Payment from "./Tabs/Payment";
import Emails from "./Tabs/Emails";

const Settings = () => {

    const [searchParams, setSearchParams] = useSearchParams();
    const currentTab = searchParams.get("tab") || "general";

    const tabs = [
        {
            title: "General",
            icon: <span className="dashicons dashicons-admin-generic"></span>,
            slug: "general"
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

    const changeTab = (slug) => {

        const params = new URLSearchParams(window.location.search);

        params.set("tab", slug);

        setSearchParams(params);
    };

    const renderContent = () => {
        switch(currentTab){
            case "payment":
                return <Payment />;
            case "emails":
                return <Emails />;
            default:
                return <General />;
        }
    };

    return (
        <div className="carbk-setting-container">

            <div className="carbk-setting-sidebar">
                <ul>
                    {tabs.map((item)=>(
                        <li key={item.slug}>
                            <button onClick={()=>changeTab(item.slug)}>
                                {item.icon} {item.title}
                            </button>
                        </li>
                    ))}
                </ul>
            </div>

            <div className="carbk-setting-content">
                {renderContent()}
            </div>

        </div>
    )
}

export default Settings;
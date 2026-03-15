import { useSearchParams } from "react-router-dom";
import { useEffect } from "react";
import General from "./Tabs/General";
import Payment from "./Tabs/Payment";
import Emails from "./Tabs/Emails";
import { FaLock } from "react-icons/fa";
import Dashboard from "../../../components/Dashboard";
import './style.css';


const Settings = () => {
    return(
        <>
            <div className="carbk-topbar">
                <div className="carbk-tobar-content-area">
                    <div className="carbk-logo-content">
                        <span className="carbk-header-topicon"><FaLock/></span>
                        <h2>Smart Password Protect</h2>
                    </div>
                    <div className="carbk-tab-lists">
                        <button>Dashboard</button>
                        <button>Password Protection</button>
                        <button>Temporary Login</button>
                        <a href="#">Request Feature</a>
                    </div>
                </div>
            </div>
            <Dashboard/>
        </>
    )
}

export default Settings;
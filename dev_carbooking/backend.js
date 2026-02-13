import { createRoot } from "react-dom/client";
import BackendDashboard from "./containers";
import {BrowserRouter as Router} from "react-router-dom";
import TopBar from "./components/TopBar";

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('carbooking');
    if(container){
        const root = createRoot(container);
        root.render(
            <Router>
                <TopBar/>
                <BackendDashboard/>
            </Router>
        );
    }
});
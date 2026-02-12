import { createRoot } from "react-dom/client";
import BackendDashboard from "./containers";
import {BrowserRouter as Router} from "react-router-dom";

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('carbooking');
    if(container){
        const root = createRoot(container);
        root.render(
            <Router>
                <BackendDashboard/>
            </Router>
        );
    }
});